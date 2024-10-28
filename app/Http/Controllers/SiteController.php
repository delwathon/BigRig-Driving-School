<?php

namespace App\Http\Controllers;
use App\Constants\Status;
use App\Models\AdminNotification;
use App\Models\Frontend;
use App\Models\Game;
use App\Models\Language;
use App\Models\Page;
use App\Models\Subscriber;
use App\Models\SupportMessage;
use App\Models\SupportTicket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller {

    public function index() {
        // return activeTemplate();
        // return $this->activeTemplate;
        $reference = @$_GET['reference'];

        if ($reference) {
            session()->put('reference', $reference);
        }

        $pageTitle = 'Home';
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', '/')->first();
        // return $sections;
        return view($this->activeTemplate . 'home', compact('pageTitle', 'sections'));
    }

    public function pages($slug) {
        $page      = Page::where('tempname', $this->activeTemplate)->where('slug', $slug)->firstOrFail();
        $pageTitle = $page->name;
        $sections  = $page->secs;
        return view($this->activeTemplate . 'pages', compact('pageTitle', 'sections'));
    }

    public function contact() {
        $pageTitle = "Contact Us";
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', 'contact')->first();
        return view($this->activeTemplate . 'contact', compact('pageTitle', 'sections'));
    }

    public function games()
    {
        $pageTitle = "Games";
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', 'games')->first();
        $games = Game::active()->get();
        return view($this->activeTemplate . 'games', compact('pageTitle', 'sections','games'));
    }

    public function contactSubmit(Request $request) {
        $this->validate($request, [
            'name'    => 'required',
            'email'   => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'required',
        ]);

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $request->session()->regenerateToken();

        $random = getNumber();

        $ticket           = new SupportTicket();
        $ticket->user_id  = auth()->id() ?? 0;
        $ticket->name     = $request->name;
        $ticket->email    = $request->email;
        $ticket->priority = 2;

        $ticket->ticket     = $random;
        $ticket->subject    = $request->subject;
        $ticket->last_reply = Carbon::now();
        $ticket->status     = Status::TICKET_OPEN;
        $ticket->save();

        $adminNotification            = new AdminNotification();
        $adminNotification->user_id   = auth()->user() ? auth()->user()->id : 0;
        $adminNotification->title     = 'A new support ticket has opened ';
        $adminNotification->click_url = urlPath('admin.ticket.view', $ticket->id);
        $adminNotification->save();

        $message                    = new SupportMessage();
        $message->support_ticket_id = $ticket->id;
        $message->message           = $request->message;
        $message->save();

        $notify[] = ['success', 'Ticket created successfully!'];

        return to_route('ticket.view', [$ticket->ticket])->withNotify($notify);
    }

    public function policyPages($slug, $id) {
        $policy    = Frontend::where('id', $id)->where('data_keys', 'policy_pages.element')->firstOrFail();
        $pageTitle = $policy->data_values->title;
        return view($this->activeTemplate . 'policy', compact('policy', 'pageTitle'));
    }

    public function changeLanguage($lang = null) {
        $language = Language::where('code', $lang)->first();

        if (!$language) {
            $lang = 'en';
        }

        session()->put('lang', $lang);
        return back();
    }

    public function blog() {
        $blogs     = Frontend::where('data_keys', 'blog.element')->latest()->paginate(getPaginate(15));
        $pageTitle = 'Blog';
        $sections  = Page::where('tempname', $this->activeTemplate)->where('slug', 'blog')->first();
        return view($this->activeTemplate . 'blog', compact('blogs', 'pageTitle', 'sections'));
    }

    public function blogDetails($slug, $id) {

        $blog = Frontend::where('id', $id)->firstOrFail();
        $blog->views += 1;
        $blog->save();
        $pageTitle   = 'Blog Detail';
        $latestBlogs = Frontend::where('id', '!=', $id)->where('data_keys', 'blog.element')->orderBy('id', 'desc')->limit(5)->get();
        $mostViews   = Frontend::where('id', '!=', $id)->where('data_keys', 'blog.element')->orderBy('views', 'desc')->limit(5)->get();

        $seoContents['keywords']           =  [];
        $seoContents['social_title']       = $blog->data_values->title;
        $seoContents['description']        = strLimit(strip_tags($blog->data_values->description), 150);
        $seoContents['social_description'] = strLimit(strip_tags($blog->data_values->description), 150);
        $seoContents['image']              = getImage('assets/images/frontend/blog/' . @$blog->data_values->image, '700x500');
        $seoContents['image_size']         = '700x500';

        return view($this->activeTemplate . 'blog_details', compact('blog', 'pageTitle', 'seoContents', 'latestBlogs', 'mostViews'));
    }

    public function cookieAccept() {
        $general = gs();
        Cookie::queue('gdpr_cookie', $general->site_name, 43200);
    }

    public function cookiePolicy() {
        $pageTitle = 'Cookie Policy';
        $cookie    = Frontend::where('data_keys', 'cookie.data')->first();
        return view($this->activeTemplate . 'cookie', compact('pageTitle', 'cookie'));
    }

    public function placeholderImage($size = null) {
        $imgWidth  = explode('x', $size)[0];
        $imgHeight = explode('x', $size)[1];
        $text      = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('assets/font/RobotoMono-Regular.ttf');
        $fontSize  = round(($imgWidth - 50) / 8);

        if ($fontSize <= 9) {
            $fontSize = 9;
        }

        if ($imgHeight < 100 && $fontSize > 30) {
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox    = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

    public function maintenance() {
        $pageTitle = 'Maintenance Mode';
        $general   = gs();

        if ($general->maintenance_mode == Status::DISABLE) {
            return to_route('home');
        }

        $maintenance = Frontend::where('data_keys', 'maintenance.data')->first();
        return view($this->activeTemplate . 'maintenance', compact('pageTitle', 'maintenance'));
    }

    public function subscribe(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $emailExist = Subscriber::where('email', $request->email)->first();

        if (!$emailExist) {
            $subscribe        = new Subscriber();
            $subscribe->email = $request->email;
            $subscribe->save();
            return response()->json(['success' => 'Subscribed successfully']);
        } else {
            return response()->json(['error' => 'Already subscribed']);
        }

    }







    public function webhook(Request $request){


        // return $request->header('api-key');
        $apiKey = $request->header('api_key');
        // if ($apiKey !== env('WEBHOOK_API_KEY')){
        //     info(['request'=>$request, 'response'=>'Invalid API KEY']);
        //     // return response()->json(['status' => 'failed', 'message' => 'Invalid API KEY detected'], 422);
        // }

        $validator = Validator::make($request->all(), [
            'account_number' => 'required|digits:10',
            'amount'=>'required|numeric',
            'transaction_reference'=>'required|string|min:10|unique:transaction_histories,reference',
            'narration'=>'required|string',
            'status'=>'required|string',
            'transaction_date'=>'required|string'

        ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 406);
        // }
        if ($validator->fails()) {
            $errorMessages = [];
            foreach ($validator->errors()->getMessages() as $field => $errors) {
                foreach ($errors as $error) {
                    $errorMessages = [
                        'status' => 'failed',
                        'error' =>  $error
                    ];
                }
            }
            return response()->json($errorMessages, 406);
        }

        // info(['request'=>$request->all()]);

        // $webhook = new Webhook();
        

        // $webhook->body = json_encode($request->all());
        // $webhook->reference = $request->transaction_reference;
        // // $webhook->transaction_date= date('d-m-Y H:i:s'); //Carbon::createFromFormat('d-m-Y H:i:s', $request->transaction_date)->format('Y-m-d H:i:s');
        // $webhook->account_number = $request->account_number;
        // $webhook->amount = $request->amount;
        // $webhook->status = $request->status;
        // $webhook->naration = "Bank Inflow from/".$request->narration;
        // $webhook->save();

        // check if the transaction id exist
        $transactionHistory =  TransactionHistory::where('reference', $webhook->reference)->first();
        if(!$transactionHistory ==null){
            return response()->json(['status' => 'failed', 'message' => 'Transaction Reference Already Existed'], 406);

        }


        $accountWallet = Account::where('account_number', $webhook->account_number)->with(['tie'])->first();

        if($accountWallet==null){

            $res = ['status' => 'failed', 'message' => 'Account Number Not found on our system'];
            // info(['request'=>$request, 'response'=>$res]);
            return response()->json($res, 406);
        }

        $tranType = TransactionType::where('id', 1)->first();
        $charges =  (float) $request->amount * $tranType->charge/100;
        if ($charges > $tranType->capped && $tranType->capped > 0){
            $charges = $tranType->capped;
        }

        if (($request->amount + $accountWallet->balance) > $accountWallet->tie->maximum_hold_balance) {
            $accountWallet->status_id = 23;
        }

        $amount = $request->amount - $charges;
        $transaction = new TransactionHistory();
        $transaction->user_id = $accountWallet->user_id;
        $transaction->account_id = $accountWallet->id;
        $transaction->reference = $webhook->reference;
        $transaction->amount = $webhook->amount;
        $transaction->naration = $webhook->naration;
        $transaction->status_id = 11;
        $transaction->credit_debit_type =1;
        $transaction->transaction_type_id = 1;
        $transaction->balance_before = $accountWallet->available_balance;
        $transaction->charge=$charges;
        $transaction->final_amount=$amount;
        $transaction->balance_after = $accountWallet->available_balance + $amount;
        $transaction->save();

        $accountWallet->balance += $transaction->final_amount;
        $accountWallet->update();

        $response = ['status' => 'success', 'message' => 'Account Credit successfully', 'account'=>$accountWallet];
        info(['request'=>$request->all(), 'response'=>$response]);
        // return $accountWallet;
        return response()->json($response, 200);

    }

}

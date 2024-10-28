<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\GameLog;
use App\Models\GuessBonus;
use App\Models\Service;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class GameController extends Controller {
    public function index() {
        $pageTitle = "Offering Services";
        $games     = Service::latest()->get();
        return view('admin.game.index', compact('pageTitle', 'games'));
    }

    public function edit($id) {
        $game      = Service::findOrFail($id);
        $pageTitle = "Update " . $game->name;
        $view      = 'game_edit';
        $bonuses   = null;
     
        return view('admin.game.' . $view, compact('pageTitle', 'game', 'bonuses'));
    }

    public function update(Request $request, $id) {
        // return $request;
        $request->validate([
            'name'        => 'required',
            'min'         => 'required|numeric',
            'markup_price'         => 'required|numeric',
            'max'         => 'required|numeric',
            'instruction' => 'required',
            'image'       => ['nullable', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
        ]);
  
        $game = Service::findOrFail($id);

        $game->name         = $request->name;
        $game->min_limit    = $request->min;
        $game->max_limit    = $request->max;
        $game->markup_price =  $request->markup_price;
        $game->invest_back  = $request->invest_back ? Status::YES : Status::NO;
        $game->instruction  = $request->instruction;
        $game->level        = $request->level;
        $game->win          = $request->win;

        $oldImage = $game->image;

        if ($request->hasFile('image')) {
            try {
                $game->image = fileUploader($request->image, getFilePath('game'), getFileSize('game'), $oldImage);
            } catch (\Exception$e) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        }

        $game->save();

        $notify[] = ['success', 'Service updated successfully'];
        return back()->withNotify($notify);
    }

    public function gameLog(Request $request) {

        $pageTitle = "Purchasing Logs";
        $logs      = GameLog::where('status', Status::ENABLE)->searchable(['user:username'])->filter(['win_status'])->with('user', 'service')->latest('id')->paginate(getPaginate());
        return view('admin.game.log', compact('pageTitle', 'logs'));
    }

    public function chanceCreate(Request $request) {

        $request->validate([
            'chance'    => 'required|array|min:1',
            'chance.*'  => 'required|integer|min:1',
            'percent'   => 'required|array',
            'percent.*' => 'required|numeric',
        ]);

        GuessBonus::truncate();

        $data = [];
        for ($a = 0; $a < count($request->chance); $a++) {
            $data[] = [
                'chance'  => $request->chance[$a],
                'percent' => $request->percent[$a],
                'status'  => Status::ENABLE,
            ];
        }

        GuessBonus::insert($data);

        $notify[] = ['success', 'Chance bonus Create Successfully'];
        return back()->withNotify($notify);
    }

    public function status($id) {
        $game = Service::findOrFail($id);

        if ($game->status == Status::ENABLE) {
            $game->status = Status::DISABLE;
            $notify[]     = ['success', $game->name . ' disabled successfully'];
        } else {
            $game->status = Status::ENABLE;
            $notify[]     = ['success', $game->name . ' enabled successfully'];
        }

        $game->save();
        return back()->withNotify($notify);
    }
}

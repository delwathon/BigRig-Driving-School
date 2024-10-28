<?php

namespace App\Http\Livewire\Child;

use App\Models\User;
use App\Models\UserType as ModelsUserType;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserType extends Component
{
    use WithFileUploads;
    
    public $key;
    //    public $section= null;
    public $editId;
    public $category = [];
    public $name;
    public $discount;
    public $logo;
    public $image;


    protected $listeners = ['edit'];

    public function edit($id)
    {

        $this->editId = $id;
        $category = ModelsUserType::where('id', $id)->first();
        $this->name = $category->name;
        $this->discount =  $category->discount;
        $this->image = $category->logo;
        
        $this->logo =null;

        // dd($this->image);

    }

    public function updatedLogo(){
        $this->image = $this->logo->temporaryUrl();
    }

    public function submit()
    {

        // dd($this->category);
        $this->validate([
            'name' => 'required|string',
            'discount' => 'required|numeric',
            'logo' => $this->editId ? 'sometimes|nullable|image' : 'required|image'
        ]);
        // $this->category['created_by'] =  auth('admin')->user()->id;

        // dd($this->category);
        $oldImage = $this->image;

        if ($this->logo) {
            try {
                $this->image = fileUploader($this->logo, getFilePath('user_type'), getFileSize('user_type'), $oldImage);
            } catch (\Exception$e) {
                $notify[] = ['error', 'Could not upload the Image.'];
                return back()->withNotify($notify);
            }
        }


        $category = ModelsUserType::updateOrCreate(
            [
                'id' => $this->editId
            ],
            [
                'name'=>$this->name,
                'discount'=>$this->discount,
                'logo'=>$this->image
            ]
        );



        // $this->emit('closeModal');
        $notify[] = ['success', 'Content updated successfully'];
        $this->emit('closeModal');
        session()->flash('notify', ['success', 'Content updated successfully']);


        return redirect()->back()->withNotify($notify);





    }

    public function mount()
    {
        $this->key = "user-type";

        if($this->editId){
            $type =  UserType::where('id', $this->editId)->first();
            $this->image =  $type->logo;
            $this->name=$type->name;
            $this->discount =  $type->discount;
        }
        // info(auth('admin')->user());
    }





    public function render()
    {
        $section = getPageSections()->{$this->key};

        return view('livewire.child.user-type', compact(['section']));
    }
}

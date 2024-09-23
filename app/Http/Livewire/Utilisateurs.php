<?php

namespace App\Http\Livewire;

use App\Models\users_model;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Utilisateurs extends Component
{

    public $updateBtn = false;

    public $state = [ ];

    public $user;

    public function mount()
    {
       $this->user = users_model::all();
    }

    private function resetInputFields()
    {
        $this->reset('state');
        //$this->reset('successMessage');
    }

    public function create()
    {
        $validator = Validator::make($this->state,[
            'user'=>'required',
            'email'=>'required|email',
            'tel'=>'required',
            'sexe'=>'required',
        ])->valid();
        users_model::create($this->state);
        $this->reset('state');
        $this->user = users_model::all();
    }
    public function cancel()
    {
        $this->updateBtn = false;
        $this->reset('state');
    }
    public function Edite($id)
    {
        if($id)
        {
            $user = users_model::find($id);
            if($user)
            {
                $this->updateBtn = true;
                $this->state = [
                    'id'=>$user->id,
                    'user'=>$user->user,
                    'email'=>$user->email,
                    'tel'=>$user->tel,
                    'sexe'=>$user->sexe,
                ];
            }
            else
            {
                return  "Erreur 404"; 
            }
        }
        else
        {
            return "Erreur 404";
        }
    }

    public function Update()
    {
        $validator = Validator::make($this->state,[
            'user'=>'required',
            'email'=>'required|email',
            'tel'=>'required',
            'sexe'=>'required',
        ])->validate();

        if($this->state['id'])
        {
            $user = users_model::find($this->state['id']);

            $user->update([
                'user'=>$this->state['user'],
                'email'=>$this->state['email'],
                'sexe'=>$this->state['sexe'],
                'tel'=>$this->state['tel'],
            ]);

            $this->reset('state');
            $this->user = users_model::all();
            $this->updateBtn = true; 
               }
        else
        {
            return "Erreur de traitement!! Veuillez ressayez ";
        }
    }

    public function Supprimer ($id)
    {
        if($id)
        {
            $user = users_model::where('id',$id)->delete();

            $this->user = users_model::all();
        }
        else
        {
            return "Erreur de serveur! Veuillez ressayer plus tard";
        }
    }
    public function render()
    {
        return view('livewire.utilisateurs');
    }
}

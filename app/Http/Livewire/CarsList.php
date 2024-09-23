<?php

namespace App\Http\Livewire;

use App\Models\cars;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CarsList extends Component
{
    public $cars;
    public $state = [];
    public $updateMode  = false;
    public $successMessage =' ';

    public function mount() 
    {
        $this->cars = cars::all();
        
    }

    private function resetInputFields()
    {
        $this->reset('state');
        //$this->reset('successMessage');
    }

    public function store()
    {
        $validator = Validator::make($this->state,[
            'marque'=>'required',
            'prix'=>'required',
            'couleur'=>'required',
        ])->validate();

        cars::create($this->state);
        $this->successMessage = "Enregistrement effectué avec succès";
        $this->reset('state');
        $this->cars = cars::all();
    }

    public function edit($id)
    {
        $this->updateMode = true;
        
        $cars = cars::find($id);

        $this->state = [
            'id'=>$cars->id,
            'marque'=>$cars->marque,
            'couleur'=>$cars->couleur,
            'prix'=>$cars->prix,
        ];
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset('state');
    }

    public function update()
    {
        $validator = Validator::make($this->state,[
            'prix'=>'required',
            'marque'=>'required',
            'couleur'=>'required',
        ])->validate();

        if($this->state['id'])
        {
            $cars = cars::find($this->state['id']);
            $cars->update([
                'marque'=>$this->state['marque'],
                'prix'=>$this->state['prix'],
                'couleur'=>$this->state['couleur'],
            ]);

            $this->successMessage="Mise à jour réussie";

            $this->updateMode = false;

            $this->reset('state');

            $this->cars = cars::all();
        }
        else
        {

        }
    }

    public function delete($id)
    {
        if($id)
        {
            cars::where('id',$id)->delete();
            $this->cars = cars::all();

            $this->successMessage = "Suppression réussie";
        }
    }


    public function render()
    {
        return view('livewire.cars-list');
    }
}

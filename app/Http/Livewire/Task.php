<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Task extends Component
{
    public $task = [];

    public function increment()
    {
        $this->task []=count($this->task); //+1;
    }

    public function decrement($index)
    {
        unset($this->task[$index]);
    }

    public function render()
    {
        return view('livewire.task');
    }
}

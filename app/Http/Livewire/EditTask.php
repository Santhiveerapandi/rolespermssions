<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Task;

class EditTask extends Component
{
    public $task = [];

    public function mount($task)
    {
        $this->task = $task->toArray();//Elequent collection convert into array
    }

    public function increment()
    {
        $this->task [] = count($this->task); //+1;
    }
    
    public function decrement($index)
    {
        $task = $this->task[$index];
        
        if (isset($task['id'])) {
            Task::find($task['id'])->delete();
        }
        unset($this->task[$index]);
    }

    public function render()
    {
        return view('livewire.edit-task');
    }
}

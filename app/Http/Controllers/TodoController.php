<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use App\Task;
use Validator;
use App\Http\Requests\TodoCreateRequest;
use App\Http\Requests\TodoUpdateRequest;

class TodoController extends Controller
{
    public function completeTodo(Todo $todo)
    {
        $todo->update(['completed'=>true]);
        return redirect()->back()->with('status', "Todo id: $todo->id : Title: ".
        ucfirst($todo->title)." Completed Successfully.");
    }

    public function incompleteTodo(Todo $todo)
    {
        $todo->update(['completed'=>false]);
        return redirect()->back()->with('status', "Todo id: $todo->id : Title: ".
        ucfirst($todo->title)." InCompleted.");
    }

    public function index()
    {
        // dd($todolist=auth()->user()->todos()->orderBy('completed')->get()); //Note: orderBy is a sql method

        // $todolist = Todo::orderBy('completed')->get();  //Note: sortBy is a collection method
        $todolist=auth()->user()->todos->sortBy('completed');
        return view('todo.index')->with(["Todo"=>$todolist]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(TodoCreateRequest $request)
    {
        //Check every relation with this model
        // dd($request->all(), auth()->user()->id);
        //validation move to TodoCreateRequest class
        // $todo = Todo::create($input);
        // auth()->user() === new User(); | auth()->user()->todos() === Relationship of Todo Class called
        $todois=auth()->user()->todos()->create($request->all());
        if ($request->task && count($request->task) > 0) {
            foreach ($request->task as $tk) {
                $todois->tasks()->create(["name"=> $tk, "user_id"=> auth()->user()->id]);
            }
        }
        
        return redirect(route('todo.index'))->with('status', 'Todo List Created Successfully.');
    }

    public function edit(Todo $todo)
    {
        // dd($todo->title); This is Route Model binding & always find from id of the model $todo
        return view('todo.edit')->with(['todo'=> $todo]);
    }

    public function update(TodoUpdateRequest $request, Todo $todo)
    {
        $todo->update(['title'=>$request->title, 'description'=>$request->description]);
        if ($request->taskName) {
            foreach ($request->taskName as $key => $value) {
                $id=$request->taskId[$key];
                if (!$id) {
                    $todo->tasks()->create(["name"=> $value, "user_id"=> auth()->user()->id]);
                    //Task::create(["name"=> $value, "todo_id"=>$todo->id, "user_id"=> auth()->user()->id]);
                } else {
                    $task=Task::find($id);
                    $task->update(["name"=> $value, "user_id"=> auth()->user()->id]);
                }
            }
        }
        return redirect(route('todo.index'))->with('status', 'Todo List Updated Successfully.');
    }

    public function show(Todo $todo)
    {
        return view('todo.show', compact('todo'));
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect(route('todo.index'))->with('status', 'Todo List Deleted Successfully.');
    }
}

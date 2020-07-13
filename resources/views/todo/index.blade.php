@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('Todo List') }}</div>
                    <div class="float-right">
                        <a class="btn btn-primary" 
                        href="{{ route('todo.create') }}"> {{ __('Todo create') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <x-alert>
                        <strong>Todo </strong>
                    </x-alert>
                    <table class="table table-bordered">
           
                        <thead>
                            <tr><th>S.No.</th><th>Todo</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @forelse($Todo as $v)
                                <tr><td>{{$i++}}</td><td>
                                @if($v->completed)
                                    <p class="line-through"> {{$v->title}} </p>
                                @else
                                    <p><a href={{ route('todo.show', $v->id) }}>{{$v->title}}</a></p>
                                @endif
                                </td><td>
                                <span class="btn btn-sm btn-success text-white btn-edit">
                                <a class="text-white" href="{{url('todo/'.$v->id.'/edit')}}">Edit</a></span>
                                @if($v->completed)
                                    <span class="btn btn-sm btn-success complete" onclick="event.preventDefault();
                                    document.getElementById('incomplete_form-{{$v->id}}').submit();">Complete</span>
                                    <form style="display:none" 
                                        id={{'incomplete_form-'. $v->id}}
                                        action={{route('todo.incomplete', $v->id)}}
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                @else
                                    <span class="btn btn-sm btn-warning complete" 
                                    onclick="event.preventDefault();
                                    document.getElementById('complete_form-{{$v->id}}').submit();">
                                        Complete
                                    </span>
                                    <form style="display:none" 
                                        id={{'complete_form-'. $v->id}}
                                        class="complete_form"
                                        action={{route('todo.complete', $v->id)}}
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                    </form>
                                @endif

                                <span class="btn btn-sm btn-danger complete" onclick="event.preventDefault();
                                if(confirm('Are you really want to delete {{$v->title}} ?')){
                                    document.getElementById('delete_form-{{$v->id}}').submit();
                                }
                                ">Delete</span>
                                    <form style="display:none" 
                                        id={{'delete_form-'. $v->id}}
                                        action={{route('todo.destroy', $v->id)}}
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td></tr>
                            @empty
                                <tr><td colspan="3" align="center"> No Task Available, Create One. </td></tr>
                            @endforelse
                        </tbody>
           
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
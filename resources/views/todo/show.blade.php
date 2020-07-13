@extends('layouts.app') 
@section('content') 
<div class="container">
    <div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="float-left">{{__('Todo Details')}}</div> 
				<div class="text-md-right">
					<a class="btn btn-primary" 
					href="{{ route('todo.index') }}"> {{__('Back')}}</a>
				</div>
			</div>
			<div class="card-body">	
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong><label for="todo_title">What next you need To-Do:</label></strong>
							{{$todo->title}}
						</div>
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>
							<label for="todo_description">{{ __('Description:') }}</label>
							</strong>
							<p>{{$todo->description}}</p>
						</div>
					</div>

					@forelse($todo->tasks as $task)
					<div class="col-xs-12 col-sm-12 col-md-12">
						<p class="font-weight-bold btn-link focus">Task {{ ($loop->index+1) }}: </p>
						<div class="form-group">
							<p>{{$task->name}}</p>
						</div>
					</div>
					@empty
						<div class="form-group">
							<p>No task for this Todo.</p>
						</div>
					@endforelse
					
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
@endsection

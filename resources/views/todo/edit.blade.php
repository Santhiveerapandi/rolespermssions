@extends('layouts.app') 
@section('content') 
<div class="container">
    <div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="float-left">{{__('Edit Todo')}}</div> 
				<div class="text-md-right">
					<a class="btn btn-primary" 
					href="{{ route('todo.index') }}"> {{__('Back')}}</a>
				</div>
			</div>
			<div class="card-body">	
				<x-validation-errors>
                    {{__('Todo Updation: ')}}
                </x-validation-errors>
				{!! Form::open(array('route' => ['todo.update', $todo->id],'method'=>'POST')) !!}
                @csrf
                @method('PUT')
                
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong><label for="todo_title">What next you need To-Do:</label></strong>
							{!! Form::text('title', $todo->title,
                            array(
                                'placeholder' => 'Todo Title',
                                'id' => 'todo_title',
                                'class' => "form-control py-3 px-2 border"
                                )
                            ) !!}
						</div>
						@error('title')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>
							<label for="todo_description">{{ __('Description:') }}</label>
							</strong>
							<div class="input-group">
							{!! Form::textarea('description', $todo->description, 
							array('placeholder' => 'Todo Description', 'id' => 'todo_description', 
							'class' => "form-control py-3 px-2 border")) !!}
                            </div>
						</div>
						@error('description')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12">
						@livewire('edit-task', ["task"=> $todo->tasks])
					</div>

					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group float-right">
							<button type="submit" class="btn btn-primary rounded-lg">Save</button>
						</div>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	</div>
</div>
@endsection

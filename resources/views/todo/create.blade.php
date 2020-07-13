@extends('layouts.app') 
@section('content') 
<div class="container">
    <div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="float-left">{{ __('Create Todo') }}</div> 
				<div class="text-md-right">
					<a class="btn btn-primary" 
					href="{{ route('todo.index') }}"> {{ __('Back') }}</a>
				</div>
			</div>
			<div class="card-body">	
				<x-validation-errors>
                    {{ __('Todo Creation: ') }}
                </x-validation-errors>
				{!! Form::open(array('route' => 'todo.store','method'=>'POST')) !!}
                @csrf
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>
							<label for="todo_title">{{ __('What next you need To-Do:') }}</label>
							</strong>
							{!! Form::text('title', null, 
							array('placeholder' => 'Todo Title', 'id' => 'todo_title',
							'class' => "form-control py-3 px-2 border")) !!}
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
							<div class="input-group">{!! Form::textarea('description', null, 
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
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					@livewire('task')
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group float-right">
						<button type="submit" class="btn btn-primary rounded-lg">Create</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			
		</div>
	</div>
	</div>
</div>
@endsection

@extends('layouts.app') 
@section('content') 
<div class="container">
    <div class="row justify-content-center">
	<div class="col-md-8">
		<div class="card">
			<div class="card-header">
				<div class="float-left">Create New User</div> 
				<div class="text-md-right">
					<a class="btn btn-primary" 
					href="{{ route('admin.index') }}"> Back</a>
				</div>
			</div>
			<div class="card-body">	
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				{!! Form::open(array('route' => 'admin.store','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Name:</strong>
							{!! Form::text('name', null, 
							array('placeholder' => 'Name','class' => "form-control")) !!}
						</div>
						@error('name')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Email:</strong>
							{!! Form::text('email', null, 
							array('placeholder' => 'Email','class' => "form-control")) !!}
						</div>
						@error('email')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Photo: </strong>
							{!! Form::file('avatar', null, 
							array('placeholder' => 'Avatar','class' => "form-control", "accept"=>"images/*")) !!}
						</div>
						@error('avatar')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group">
							<strong>Password:</strong>
							{!! Form::password('password', 
							array('placeholder' => 'Password','class' => "form-control")) !!}
						</div>
						@error('password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group"><strong>Confirm Password:</strong>
							{!! Form::password('confirm-password', 
							array('placeholder' => 'Confirm Password',
							'class' => "form-control")) !!}
						</div>
						@error('confirm-password')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12">
						<div class="form-group"><strong>Role:</strong>
							{!! Form::select('role_id', $roles,[], 
							array('class' => "form-control",'single')) !!}
						</div>
						@error('role_id')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
					<div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	</div>
</div>
@endsection

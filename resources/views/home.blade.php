@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('Dashboard') }}</div>
                    <div class="float-right">
                        <a class="btn btn-primary" 
                        href="{{ route('admin.create') }}"> {{ __('Create User') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <x-alert>
                        <strong>User Avater Upload </strong>
                    </x-alert>

                    Accessor & Mutator Example: {{$user->name}}<br/>
                    {{ __('You are logged in!') }}
                

                {!! Form::open(array('route' => 'uploadavatar','method'=>'POST', 'enctype'=>'multipart/form-data')) !!}
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
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

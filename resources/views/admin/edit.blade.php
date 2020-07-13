@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Role</div>

                <div class="card-body">
                    <form method="POST" action="{{url('admin/'.$request)}}" id="editRole" class="form">
                    @csrf
                    <input type="hidden" name="_method" value="PUT" />
                    <input type="hidden" id="userid" name="id" value={{$request}} />
                        <div class="form-group">
                            <label for="name">UserName :</label>
                            <span id="name" class="form-control">{{$user->name}}</span>
                        </div>
                        <div class="form-group">
                        <label for="role_id">RoleName :</label>
                        <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="submit" value="Save">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
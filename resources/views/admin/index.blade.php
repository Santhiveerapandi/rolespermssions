@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">{{ __('User List') }}</div>
                    <div class="float-right">
                        <a class="btn btn-primary" 
                        href="{{ route('admin.create') }}"> {{ __('Create User') }}</a>
                    </div>
                </div>

                <div class="card-body">
                    <x-alert>
                        <strong>User </strong>
                    </x-alert>
                    <table class="table table-bordered">
                        <thead>
                            <tr><th>S.No.</th><th>Photo</th><th>Name</th><th>Role</th><th>Action</th></tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @if(!is_null($users))
                            @foreach($users as $user)
                                <tr><td>{{$i++}}</td>
                                <td>
                                    @if($user->avatar)
                                    <img src={{asset('/storage/images/'.$user->avatar)}} width="50"  height="auto"/>
                                    @else
                                    {{ "--" }}
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{is_object($roles[$user->id])? $roles[$user->id]->name: '--'}}</td>
                                <td><a class="btn btn-success" href={{route("admin.edit", $user->id)}}>Update Role</a>
                                <span class="btn btn-danger cursor-pointer"
                                onclick="event.preventDefault();
                                if(confirm('Are you really want to delete {{$user->name}} ?')){
                                    document.getElementById('delete_form-{{$user->id}}').submit();
                                }">Delete</span>
                                    <form style="display:none" 
                                        id={{'delete_form-'. $user->id}}
                                        action={{route('admin.destroy', $user->id)}}
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                            </td></tr>
                            @endforeach
                            @else
                                <tr><td colspan='4'>No Records Found</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<div>
@if (session('status') || session('error'))
    <div class="alert @if(session('error')) alert-danger @else alert-success @endif alert-dismissable fade show" 
    role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @if(session('status'))
        <div class="bg-green-300"> <h5><i class="icon fas fa-check"></i>{{$slot}} Success!</h5>
        {{ session('status') }}</div>
        @else
        <div class="bg-red-300"><h5><i class="icon fas fa-check"></i>{{$slot}} Error!</h5>
        {{ session('error') }} </div>
        @endif 
    </div>
@endif
</div>
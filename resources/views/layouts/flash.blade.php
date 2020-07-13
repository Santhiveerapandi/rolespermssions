@if (session('status') || session('error'))
    <div class="alert @if(session('error')) alert-danger @else alert-success @endif alert-dismissable fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @if(session('status'))
        <h5><i class="icon fas fa-check"></i> Success!</h5>
        {{ session('status') }}
        @else
        <h5><i class="icon fas fa-check"></i> Error!</h5>
        {{ session('error') }}
        @endif 
    </div>
@endif
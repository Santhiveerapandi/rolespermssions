<div class="form-group">
    <label for="task[]" >{{ __('Add Task if required: ') }}</label>
    <span wire:click="increment" class="badge badge-danger cursor-pointer"> + </span>
    @foreach($task as $tk)
        <div wire:key="{{ $tk }}" class="input-group py-2">
            <input type="text" name='task[]' id ="todo_task_{{$loop->index+1}}"
                placeholder="Step {{$tk+1}}"
                class= "form-control py-2 px-2 border" />
            <span wire:click="decrement({{$tk}})" class="btn btn-danger cursor-pointer"> X </span>
        </div>
    @endforeach
</div>
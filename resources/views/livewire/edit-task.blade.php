<div class="form-group">
    <label for="task[]" >{{ __('Add Task if required: ') }}</label>
    <span wire:click="increment" class="badge badge-danger cursor-pointer"> + </span>
    @foreach($task as $tk)
        <div wire:key="{{ $loop->index }}" class="input-group py-2">
            <input type="text" name='taskName[]' 
                placeholder="{{ ($loop->index+1) }}" value="{{isset($tk['name'])?$tk['name']:''}}"
                class= "form-control py-2 px-2 border" />
            <input type="hidden" name='taskId[]' value="{{isset($tk['id'])? $tk['id']:''}}" />
            <span wire:click="decrement({{$loop->index}})" class="btn btn-danger cursor-pointer"> X </span>
        </div>
    @endforeach
</div>

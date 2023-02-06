<div class="">

    <div class="row">
        <div class="col-12 mb-3">
            <form action="">
                <div class="form-floating">
                    <input 
                        type="text" 
                        class="form-control"
                        placeholder="new task here"
                        wire:blur='addNewTask'
                        wire:model="task">
                    <label for="floatingInput">Add New Task</label>
                </div>
                @error('task')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </form>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p class="h4 mb-2">Pending Tasks</p>
                    <ul class="list-group list-group-flush">
                        @if (count($pendingTasks))    
                            @foreach ($pendingTasks as $task)
                                <li class="list-group-item px-0">
                                    <div class="form-check mb-0">
                                        <input 
                                            type="checkbox" 
                                            class="form-check-input"
                                            {{ $task['done'] ? 'checked' : '' }}
                                            id="taskCheckbox{{ $loop->iteration }}"
                                            wire:change="updateTask({{ $task['id'] }})">
                                        <label 
                                            class="form-check-label" 
                                            for="taskCheckbox{{ $loop->iteration }}">
                                            {{ $task['body'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="small-text">{{ $task['added'] }}</div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">No Pending Task</li>        
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <p class="h4 mb-2">Completed Tasks</p>
                    <ul class="list-group list-group-flush">
                        @if (count($doneTasks))    
                            @foreach ($doneTasks as $task)
                                <li class="list-group-item px-0">
                                    <div class="form-check">
                                        <input 
                                            type="checkbox" 
                                            class="form-check-input"
                                            {{ $task['done'] ? 'checked' : '' }}
                                            id="taskCheckbox{{ $loop->iteration }}"
                                            wire:change="updateTask({{ $task['id'] }})">
                                        <label 
                                            class="form-check-label" 
                                            for="taskCheckbox{{ $loop->iteration }}">
                                            {{ $task['body'] }}
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="small-text">{{ $task['updated'] }}</div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item">No Completed Task</li>        
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>    
</div>


<style>
    .small-text {
        color: darkgrey;
        font-size: 0.75em;
        line-height: 0.75em;
    }
</style>
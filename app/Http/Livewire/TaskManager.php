<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Events\TaskAdded;
use App\Events\TaskUpdated;
use App\Http\Resources\TaskResource;

class TaskManager extends Component
{
    public $task;
    public $tasks;
    public $pendingTasks;
    public $doneTasks;

    protected $listeners = ['onTaskAdded', 'onTaskUpdated'];
 
    public function onTaskAdded($task)
    {
        // array_push($this->newTasks, $task);
        $this->reloadTasks();
        $this->task = '';                                                                      
    }

    public function onTaskUpdated()
    {
        $this->reloadTasks();
    }

    public function mount()
    {
        $this->reloadTasks();
    }

    public function reloadTasks() {
        $this->doneTasks = TaskResource::collection(Task::done()->get());
        $this->pendingTasks = TaskResource::collection(Task::pending()->get());
        $this->doneTasks = $this->doneTasks->toArray($this->doneTasks);
        $this->pendingTasks = $this->pendingTasks->toArray($this->pendingTasks);
    }

    public function addNewTask()
    {
        $this->validate([
            'task' => 'required|string|min:4|max:255'
        ]);

        $newTask = Task::create([
            'body' => $this->task,
            'user' => 1
        ]);

        TaskAdded::dispatch(new TaskResource($newTask));
    }

    public function updateTask($value)
    {
        $clickedTask = Task::find($value);
        $clickedTask->updateStatus();
        TaskUpdated::dispatch();
    }

    public function removeTask($value)
    {
        $clickedTask = Task::find($value);
        $clickedTask->delete();
        TaskUpdated::dispatch();
    }
    
    public function render()
    {
        return view('livewire.task-manager');
    }
}

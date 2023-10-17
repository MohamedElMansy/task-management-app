<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;

class TasksComponent extends Component
{
    public $task_id, $title, $status, $description,$due_date, $task_edit_id, $task_delete_id;

    public $view_task_id, $view_task_title, $view_task_status, $view_task_description,$view_task_due_date;

    public $searchTerm;

    //Input fields on update validation
    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'task_id' => 'required|unique:tasks,task_id,'.$this->task_edit_id.'', //Validation with ignoring own data
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);
    }

    public function storeTask()
    {
        //on form submit validation
        $this->validate([
            'task_id' => 'required|unique:tasks',
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        //Add Data into task table Data
        $task = new Task();
        $task->task_id = $this->task_id;
        $task->title = $this->title;
        $task->status = $this->status;
        $task->description = $this->description;
        $task->due_date = $this->due_date;
        $task->user_id = 1;        //Auth::id(); until apply auth
        $task->save();

        session()->flash('message', 'New task addedd Successfully.');

        $this->task_id = '';
        $this->title = '';
        $this->status = '';
        $this->description = '';
        $this->due_date = '';

        //For hide modal after add tasks success
        $this->dispatchBrowserEvent('close-modal');
    }


    public function resetInputs()
    {
        $this->task_id = '';
        $this->title = '';
        $this->status = '';
        $this->description = '';
        $this->task_edit_id = '';
        $this->due_date = '';
    }


    public function close()
    {
        $this->resetInputs();
    }

    public function editTask($id)
    {
        $task = Task::find($id);

        $this->task_edit_id = $task->id;
        $this->task_id = $task->task_id;
        $this->title = $task->title;
        $this->status = $task->status;
        $this->description = $task->description;
        $date = Carbon::parse($task->due_date);
        $this->due_date = $date->format('Y-m-d');
            
           

        $this->dispatchBrowserEvent('show-edit-task-modal');
    }
    
    public function editTaskData()
    {
        //on form submit validation
        $this->validate([
            'task_id' => 'required|unique:tasks,task_id,'.$this->task_edit_id.'', //Validation with ignoring own data
            'title' => 'required',
            'status' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
        ]);

        $task = Task::find($this->task_edit_id);

        $task->task_id = $this->task_id;
        $task->title = $this->title;
        $task->status = $this->status;
        $task->description = $this->description;
        $task->due_date = $this->due_date;

        $task->save();

        session()->flash('message', 'task has been updated successfully');

        //For hide modal after add task added successfully
        $this->dispatchBrowserEvent('close-modal');
    }

    //Delete Confirmation
    public function deleteConfirmation($id)
    {
        $this->task_delete_id = $id; //task id

        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }


    public function deleteTaskData()
    {
        Task::destroy($this->task_delete_id);

        session()->flash('message', 'task has been deleted successfully');

        $this->dispatchBrowserEvent('close-modal');

        $this->task_delete_id = '';
    }

    public function cancel()
    {
        $this->task_delete_id = '';
    }

    public function viewTaskDetails($id)
    {
        
        $task = Task::find($id);
        
        $this->view_task_id = $task->task_id;
        $this->view_task_title = $task->title;
        $this->view_task_status = $task->status;
        $this->view_task_description = $task->description;
        $date = Carbon::parse($task->due_date);
        $this->view_task_due_date = $date->format('Y-m-d');

        $this->dispatchBrowserEvent('show-view-task-modal');
    }


    public function closeViewTaskModal()
    {
        $this->view_task_id = '';
        $this->view_task_title = '';
        $this->view_task_status = '';
        $this->view_task_description = '';
        $this->view_task_due_date = '';
    }

    public function render()
    {
        //Get all task
        $tasks = Task::where('title', 'like', '%'.$this->searchTerm.'%')
        ->orWhere('status', 'like', $this->searchTerm.'%')
        ->orWhere('task_id', 'like', '%'.$this->searchTerm.'%')
        ->orWhere('description', 'like', '%'.$this->searchTerm.'%')
        ->get();

        return view('livewire.tasks-component', ['tasks'=>$tasks])->layout('livewire.layouts.base');
    }
}
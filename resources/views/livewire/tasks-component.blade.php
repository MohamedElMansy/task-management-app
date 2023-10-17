<div>
    <div class="container mt-5">
        <div class="row mb-5">
            <div class="col-md-12 text-center">
                <h3><strong>Task Management</strong></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 style="float: left;"><strong>All tasks</strong></h5>
                        <button class="btn btn-sm btn-primary" style="float: right;" data-toggle="modal" data-target="#addTasktModal">Add New Task</button>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success text-center">{{ session('message') }}</div>
                        @endif


                        <div class="row mb-3">
                            <div class="col-md-12">
                                <input type="search" class="form-control w-25" placeholder="search" wire:model="searchTerm" style="float: right;" />
                            </div>
                        </div>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th style="text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($tasks->count() > 0)
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ $task->task_id }}</td>
                                            <td>{{ $task->title }}</td>
                                            <td>{{ $task->status }}</td>
                                            <td>{{ $task->description }}</td>
                                            <td style="text-align: center;">
                                                <button class="btn btn-sm btn-secondary" wire:click="viewTaskDetails({{ $task->id }})">View</button>
                                                <button class="btn btn-sm btn-primary" wire:click="editTask({{ $task->id }})">Edit</button>
                                                <button class="btn btn-sm btn-danger" wire:click="deleteConfirmation({{ $task->id }})">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" style="text-align: center;"><small>No task Found</small></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="addTasktModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form wire:submit.prevent="storeTask">
                        <div class="form-group row">
                            <label for="task_id" class="col-3">task ID</label>
                            <div class="col-9">
                                <input type="number" id="task_id" class="form-control" wire:model="task_id">
                                @error('task_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="title" class="col-3">Title</label>
                            <div class="col-9">
                                <input type="text" id="title" class="form-control" wire:model="title">
                                @error('title')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-3">status</label>
                            <div class="col-9">
                                <textarea type="number" id="status" class="form-control" wire:model="status"></textarea>
                                @error('status')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-3">Description</label>
                            <div class="col-9">
                                <textarea type="number" id="description" class="form-control" wire:model="description"></textarea>
                                @error('description')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due_date" class="col-3">Due Date</label>
                            <div class="col-9">
                                <input type="date" id="due_date" class="form-control" wire:model="due_date">
                                @error('due_date')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Save task</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="editTaskModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form wire:submit.prevent="editTaskData">
                        <div class="form-group row">
                            <label for="task_id" class="col-3">task ID</label>
                            <div class="col-9">
                                <input type="number" id="task_id" class="form-control" wire:model="task_id">
                                @error('task_id')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="title" class="col-3">Title</label>
                            <div class="col-9">
                                <input type="text" id="title" class="form-control" wire:model="title">
                                @error('title')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="status" class="col-3">status</label>
                            <div class="col-9">
                                <textarea type="number" id="status" class="form-control" wire:model="status"></textarea>
                                @error('status')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-3">Description</label>
                            <div class="col-9">
                                <textarea type="number" id="description" class="form-control" wire:model="description"></textarea>
                                @error('description')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="due_date" class="col-3">Due Date</label>
                            <div class="col-9">
                                <input type="date" id="due_date" class="form-control" wire:model="due_date" >
                                @error('due_date')
                                    <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-3"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-sm btn-primary">Edit task</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="deleteTaskModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-4 pb-4">
                    <h6>Are you sure? You want to delete this Task!</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-primary" wire:click="cancel()" data-dismiss="modal" aria-label="Close">Cancel</button>
                    <button class="btn btn-sm btn-danger" wire:click="deleteTaskData()">Yes! Delete</button>
                </div>
            </div>
        </div>
    </div>


    <div wire:ignore.self class="modal fade" id="viewTaskModal" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Task In Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="closeViewTaskModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>ID: </th>
                                <td>{{ $view_task_id }}</td>
                            </tr>

                            <tr>
                                <th>Title: </th>
                                <td>{{ $view_task_title }}</td>
                            </tr>

                            <tr>
                                <th>Status: </th>
                                <td>{{ $view_task_status }}</td>
                            </tr>

                            <tr>
                                <th>Description: </th>
                                <td>{{ $view_task_description }}</td>
                            </tr>
                            <tr>
                                <th>Due Date: </th>
                                <td>{{ $view_task_due_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#addTasktModal').modal('hide');
            $('#editTaskModal').modal('hide');
            $('#deleteTaskModal').modal('hide');
        });


        window.addEventListener('show-edit-task-modal', event =>{
            $('#editTaskModal').modal('show');
        });


        window.addEventListener('show-delete-confirmation-modal', event =>{
            $('#deleteTaskModal').modal('show');
        });


        window.addEventListener('show-view-task-modal', event =>{
            $('#viewTaskModal').modal('show');
        });
    </script>
@endpush
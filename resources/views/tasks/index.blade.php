@extends('layouts.app')

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="container">
        <h1 class="my-4">My Tasks</h1>

        <form action="{{ route('tasks.create') }}" method="get" style="display: inline;">
            <button type="submit" class="btn btn-primary mb-3">Create Task</button>
        </form>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="taskTableBody">
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            @if ($task->status == 0)
                                <span class="badge text-bg-warning col-md-6">pending</span>
                            @else
                                <span class="badge text-bg-success col-md-6">completed</span>
                            @endif
                        </td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <form action="{{ route('task_manage', $task->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit"
                                    class="btn {{ $task->status == 0 ? 'btn-success' : 'btn-warning' }} col-md-3">
                                    {{ $task->status == 0 ? 'Complete' : 'Incomplete' }}
                                </button>

                            </form>
                            <a href="{{ route('tasks.update', $task->id) }}" class="btn btn-info ms-2">
                                Edit
                            </a>
                            <button class="btn btn-danger ms-2 delete-btn" data-task-id="{{ $task->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this task? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="confirmDeleteButton" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                const taskId = $(this).data('task-id');
                const deleteUrl = "{{ url('/tasks-delete') }}/" + taskId;
                $('#confirmDeleteButton').attr('href', deleteUrl);
                $('#deleteConfirmationModal').modal('show');
            });
        });
    </script>
@endsection

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
                                <span class="badge text-bg-primary">pending</span>
                            @else
                                <span class="badge text-bg-success">completed</span>
                            @endif
                        </td>
                        <td>{{ $task->due_date }}</td>
                        <td>
                            <form action="{{ route('task_manage', $task->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn {{ $task->status == 0 ? 'btn-warning' : 'btn-danger' }}">
                                    {{ $task->status == 0 ? 'Complete' : 'Incomplete' }}
                                </button>

                            </form>
                            <a href="{{ route('tasks.update', $task->id) }}" class="btn btn-info ms-2">
                                Edit
                            </a>
                            <a href="{{ route('tasks.destroy', $task->id) }}" class="btn btn-danger ms-2">
                                delete
                            </a>




                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush

@extends('layouts.app')

@section('content')
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
                        <td>{{ $task->status }}</td>
                        <td>{{ $task->due_date }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@push('scripts')
    <script>
    </script>
@endpush

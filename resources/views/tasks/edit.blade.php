@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm" style="background: rgb(203, 177, 177)">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Update Task</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                            @csrf
                            <div class="mb-3 col-md-9 mx-auto">
                                <label for="title" class="form-label">Task Title</label>
                                <input type="text" name="title" id="title" value="{{ $task->title }}"
                                    class="form-control" placeholder="Enter task title" required>
                            </div>
                            <div class="mb-3 col-md-9 mx-auto">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Add a brief description">{{ $task->description }}</textarea>
                            </div>
                            <div class="mb-3 col-md-9 mx-auto">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control"
                                    value="{{ $task->due_date }}">
                            </div>
                            <div class="d-flex justify-content-end col-md-9 mx-auto">
                                <button type="submit" class="btn btn-success btn-lg">Save Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

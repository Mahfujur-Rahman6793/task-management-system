@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm" style="background: rgb(203, 177, 177)">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Create a New Task</h4>
                    </div>
                    <div class="card-body">
                        <form id="task-form">
                            @csrf
                            <div class="mb-3 col-md-9 mx-auto">
                                <label for="title" class="form-label">Task Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    placeholder="Enter task title" required>
                            </div>
                            <div class="mb-3 col-md-9 mx-auto">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" placeholder="Add a brief description"></textarea>
                            </div>
                            <div class="mb-3 col-md-9 mx-auto">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control">
                            </div>
                            <div class="d-flex justify-content-end col-md-9 mx-auto">
                                <button type="submit" class="btn btn-success btn-lg" id="save-button">Save Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#task-form').on('submit', function(event) {
                event.preventDefault();
                $('#save-button').prop('disabled', true);

                $.ajax({
                    type: "POST",
                    url: "{{ route('tasks.create') }}",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#save-button').prop('disabled', false);
                        Swal.fire({
                            title: 'Success!',
                            text: response.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = "{{ route('tasks.index') }}";
                        });
                    },
                    error: function(xhr) {
                        $('#save-button').prop('disabled', false);
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection

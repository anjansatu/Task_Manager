@extends('user.layouts.master')


@section('user-content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @auth()
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <h2 class="mb-4">Your Tasks</h2>
                            <div class="container">
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h1 class="card-title">Task Details</h1>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="title" class="font-weight-bold">Title:</label>
                                            <p id="title">{{ $task->title }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="font-weight-bold">Description:</label>
                                            <p id="description">{{ $task->description }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label for="status" class="font-weight-bold">Status:</label>
                                            <p id="status">{{ $task->status }}</p>
                                        </div>
                                        <!-- Add more task details as needed -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
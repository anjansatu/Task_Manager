@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">

                        <h2>All Tasks</h2>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                    <th>Notify by mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->status }}</td>
                                        <td>{{ $task->user->name }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#taskModal{{ $task->id }}" onclick="window.location='{{ route('admin.tasks.showtask', ['taskId' => $task->id]) }}'">
                                                View Details
                                            </button>

                                            <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                               class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="post"
                                                  style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this task?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.notify.user', ['taskId' => $task->id]) }}" class="btn btn-primary">
                                                Notify User
                                            </a>
                                    </tr>

                                    <div class="modal fade" id="taskModal{{ $task->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="taskModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="taskModalLabel">{{ $task->title }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Title:</strong> {{ $task->title }}</p>
                                                    <p><strong>Description:</strong> {{ $task->description }}</p>
                                                    <p><strong>Status:</strong> {{ $task->status }}</p>
                                                    <p><strong>User:</strong> {{ $task->user->name }}</p>
                                                    <p><strong>Feedback:</strong> {{ $task->feedback}}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('admin.layouts.master')

@section('admin-content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    <div class="card-body">
                        <ul id="taskList" class="list-group">
                            @foreach($tasks as $task)
                                <li class="list-group-item">
                                    <h5>{{ $task->title }}</h5>
                                    <p>{{ $task->description }}</p>
                                    <small class="text-muted">Due date: {{ $task->due_date }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

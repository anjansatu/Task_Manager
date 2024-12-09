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
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $task->name }}</h5>
                                        <p class="mb-1 text-muted">{{ $task->description }}</p>
                                    </div>
                                    <small>{{ $task->due_date }}</small>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

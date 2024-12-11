@extends('user.layouts.master')

@section('user-content')
<style>

</style>
<div class="container">
    <ul class="task-list">
        @foreach($tasks as $task)
            <li class="task-item">
                <div>
                    <h5 class="task-title">{{ $task->title }}</h5>
                    <p class="task-description">{{ $task->description }}</p>
                    <small class="task-timestamp">Created: {{ $task->created_at->format('d  Y') }}</small>
                </div>
                <span class="badge task-badge {{ $task->status == 'To Do' ? 'badge-todo' : 'badge-secondary' }}">
                    {{ $task->status }}
                </span>

            </li>
        @endforeach
    </ul>
</div>
@endsection


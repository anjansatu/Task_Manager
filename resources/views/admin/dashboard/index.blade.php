@extends('admin.layouts.master')

@section('admin-content')

<div class="container mt-4">
    <h2>Welcome, Admin!</h2>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Summary Statistics</div>
                <div class="card-body">
                    <ul>
                        {{-- <li>Total Tasks: {{ $totalTasks }}</li> --}}
                        <li>Total Users: {{ $totalUsers }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Recent Activity</div>
                <div class="card-body">
                    <ul>
                        {{-- <li>Recent Task: {{ $recentTasks ? $recentTasks->title : 'No recent tasks' }}</li> --}}
                        <li>Recent User: {{ $recentUsers ? $recentUsers->name : 'No recent users' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Quick Links</div>
                <div class="card-body">
                    <ul>
                        {{-- <li><a href="{{ route('admin.task.index') }}">All Tasks</a></li> --}}
                        <li><a href="{{ route('admin.users.index') }}">All Users</a></li>
                        <!-- Add more quick links as needed -->
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Actionable Items</div>
                <div class="card-body">
                    <ul>
                        {{-- <li><a href="{{ route('admin.tasks.pending', ['status' => TASK_STATUS_TO_DO]) }}">To Do tasks: {{ $pendingTasksCount ?? 0 }}</a></li> --}}
                        {{-- <li><a href="{{ route('admin.tasks.completed', ['status' => TASK_STATUS_COMPLETE]) }}">Completed tasks: {{ $completedTasksCount ?? 0 }}</a></li> --}}
                        <li>Users awaiting approval: {{ $pendingUsersCount ?? 0 }}</li>
                        <!-- Add more actionable items as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


   @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.clear.cash') }}" method="GET">
        <button type="submit" style="padding: 10px 20px; background-color: red; color: white; border: none; cursor: pointer;">
            Clear Cache
        </button>
    </form>
@endsection

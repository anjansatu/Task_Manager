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
                        <li>Total Tasks: {{ $totalTasks }}</li>
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
                        <li>Recent Tasks: {{ $recentTasks }}</li>
                        <li>Recent Users: {{ $recentUsers }}</li>
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
                        <li><a href="">All Tasks</a></li>
                        <li><a href="">All Users</a></li>
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
                        <li><a href="">To Do tasks: {{ $pendingTasksCount ?? 0 }}</a></li>
                        <li><a href="">Completed tasks: {{ $completedTasksCount ?? 0 }}</a></li>
                        <li>Users awaiting approval: {{ $pendingUsersCount ?? 0 }}</li>
                        <!-- Add more actionable items as needed -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

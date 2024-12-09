<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data['totalTasks'] = Task::count();
        $data['totalUsers'] = User::count();

        $data['recentTasks'] = Task::latest()->first();
        $data['recentUsers'] = User::latest()->first();
        $data['pendingTasksCount'] = Task::where('status', 'To Do')->count();
        $data['pendingTasksCount'] = Task::where('status', 'Completed')->count();
        $data['pendingUsersCount'] = User::where('email_verified_at', 'null')->count();


        return view('admin.dashboard.index',$data);
    }
}

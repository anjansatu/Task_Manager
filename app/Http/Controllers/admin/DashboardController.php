<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function index()
    {
        // $data['totalTasks'] = Task::count();
        $data['totalUsers'] = User::count();

        // $data['recentTasks'] = Task::latest()->first();
        $data['recentUsers'] = User::latest()->first();

        // $data['pendingTasksCount'] = Task::where('status', TASK_STATUS_TO_DO)->count();
        // $data['completedTasksCount'] = Task::where('status', TASK_STATUS_COMPLETE)->count();

        $data['pendingUsersCount'] = User::whereNull('email_verified_at')->count();


        return view('admin.dashboard.index', $data);
    }
    
     public function clearCash()
    {
   
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return redirect()->back()->with('success', 'System cache cleared successfully!');
    }

}

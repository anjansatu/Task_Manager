<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
   public function index()
    {
        $userTasks = auth()->user()->tasks();

        // Retrieve only tasks with status 'To Do' or 'In Progress'
        $data['tasks'] = $userTasks->whereIn('status', [TASK_STATUS_TO_DO, TASK_STATUS_IN_PROGRESS,\TASK_STATUS_COMPLETE])->get();

        return view('user.dashboard.index', $data);
    }

}

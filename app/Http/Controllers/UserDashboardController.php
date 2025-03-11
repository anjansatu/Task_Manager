<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BaseController as Controller;


use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        try {
            $userTasks = auth()->user()->tasks();
            $data['user'] = auth()->user();
            $data['tasks'] = $userTasks->whereIn('status', [TASK_STATUS_TO_DO, TASK_STATUS_IN_PROGRESS, TASK_STATUS_COMPLETE])->get();

            return view('user.dashboard.index', $data);
        } catch (\Exception $e) {
            \Log::error('Error fetching user tasks: ' . $e->getMessage());

            return $this->sessionError("Oops! An error occurred while fetching tasks.'.");
        }
    }

}

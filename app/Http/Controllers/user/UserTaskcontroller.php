<?php

namespace App\Http\Controllers\user;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTaskcontroller extends Controller
{
    public function pendingTasks()
    {
        $data['tasks'] = Task::where('user_id',auth()->user()->id)->where('status',TASK_STATUS_TO_DO)->get();
        return view('user.tasks.pending', $data);
    }

    public function inProgressTasks()
    {
        $data['tasks'] = Task::where('user_id',auth()->user()->id)->where('status',TASK_STATUS_IN_PROGRESS)->get();
        return view('user.tasks.in-progress', $data);
    }

    public function completedTasks()
    {
        $data['tasks'] = Task::where('user_id',auth()->user()->id)->where('status',TASK_STATUS_COMPLETE)->get();
        return view('user.tasks.completed', $data);
    }
}

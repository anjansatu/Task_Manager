<?php

namespace App\Http\Controllers\user;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;


class UserTaskcontroller extends Controller
{
    public function pendingTasks()
    {
        try {
            $data['tasks'] = Task::where('user_id', auth()->user()->id)
                ->where('status', TASK_STATUS_TO_DO)
                ->get();
            return view('user.tasks.pending', $data);
        } catch (\Exception $e) {
            \Log::error('Error fetching pending tasks: ' . $e->getMessage());
            return $this->sessionError("Oops! 'Failed to load pending tasks'");
        }
    }

    public function inProgressTasks()
    {
        try {
            $data['tasks'] = Task::where('user_id', auth()->user()->id)
                ->where('status', TASK_STATUS_IN_PROGRESS)
                ->get();
            return view('user.tasks.in-progress', $data);
        } catch (\Exception $e) {
            \Log::error('Error fetching in-progress tasks: ' . $e->getMessage());
            return $this->sessionError("Oops! 'Failed to load in-progress tasks'.");

        }
    }

    public function completedTasks()
    {
        try {
            $data['tasks'] = Task::where('user_id', auth()->user()->id)
                ->where('status', TASK_STATUS_COMPLETE)
                ->get();
            return view('user.tasks.completed', $data);
        } catch (\Exception $e) {
            \Log::error('Error fetching completed tasks: ' . $e->getMessage());
            return $this->sessionError("Oops! 'Failed to load completed tasks'.");

        }
    }

}

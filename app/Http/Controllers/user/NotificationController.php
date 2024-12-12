<?php

namespace App\Http\Controllers\user;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskStatusNotification;
use App\Http\Controllers\BaseController as Controller;

class NotificationController extends Controller
{
    public function notifyUser($taskId)
    {
        try {
            $task = Task::findOrFail($taskId);
            $user = User::findOrFail($task->user_id);

            $user->notify(new TaskStatusNotification($task));
            return $this->sessionSuccess('Notification sent successfully', 'admin.tasks.index');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sessionError("Task or User not found","admin.tasks.index");
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred.","admin.tasks.index");
        }
    }

    public function showtask($taskId)
    {
        try {
            $data['task'] = Task::findOrFail($taskId);
            return view('user.tasks.task-details', $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.tasks.index')->with('error', 'Task not found');
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred.","admin.tasks.index");

        }
    }

}

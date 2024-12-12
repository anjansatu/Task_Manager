<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
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
            return $this->sessionError("Task or User not found","admin.task.index");
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred.","admin.task.index");
        }
    }


    public function showtask($taskId)
    {
        try {
            $data['task'] = Task::findOrFail($taskId);
            return view('admin.tasks.showtask', $data);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->sessionError("Oops! An error occurred.","tasks.index");

        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred.","tasks.index");

        }
    }

}

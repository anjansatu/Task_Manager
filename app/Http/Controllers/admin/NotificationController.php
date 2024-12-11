<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TaskStatusNotification;

class NotificationController extends Controller
{
    public function notifyUser($taskId)
    {
        $task = Task::findOrFail($taskId);
        $user = User::findOrFail($task->user_id);

        // Notify the user
        $user->notify(new TaskStatusNotification($task));

        return redirect()->route('admin.task.index')->with('success', 'Notification sent successfully');
    }

    // show notified task

    public function showtask($taskId)
    {
        $data['task'] = Task::findOrFail($taskId);
        return view('admin.tasks.showtask', $data);
    }
}

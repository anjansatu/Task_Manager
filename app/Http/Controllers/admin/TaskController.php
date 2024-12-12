<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\TaskAssigned;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as Controller;

class TaskController extends Controller
{
    public function index()
    {
        try {
            if (auth('admin')->user()->id) {
                $tasks = Task::all();
            }
            $data['tasks'] = $tasks ?? [];
            return view('admin.tasks.index', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred while fetching the profile.","admin.task.index");
        }
    }

    public function create()
    {
        try {
            $data['users'] = User::all();
            return view('admin.tasks.create', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred while fetching the profile.","admin.task.index");
        }
    }

    public function postCreate(Request $request)
    {
        try {
            $task = new Task;
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->status = $request->input('status');
            $task->user_id = $request->input('user_id');
            $task->created_at = now();

            $user = User::find($request->input('user_id'));

            if ($user) {
                $task->save();
                $user->notify(new TaskAssigned($task));
                return $this->sessionSuccess("Task created successfully","admin.task.index");
            } else {
             return $this->sessionError("Oops! An error occurred .","admin.task.index");
            }
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.task.index");
        }
    }

    public function edit($id)
    {
        try {
            $data['task'] = Task::findOrFail($id);
            $data['users'] = User::all();
            return view('admin.tasks.edit', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred.","admin.task.index");
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->status = $request->input('status');
            $task->user_id = $request->input('user_id');
            $task->save();

            return $this->sessionError("Task updated successfully","admin.task.index");
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.task.index");
        }
    }

    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->delete();

            return $this->sessionSuccess("Task deleted successfully.","admin.task.index");
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.task.index");
        }
    }

    public function pendingTasks()
    {
        try {
            if (auth('admin')->user()->id) {
                $data['tasks'] = Task::where('status', TASK_STATUS_TO_DO)->get();
            }
            return view('admin.tasks.index', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.task.index");
        }
    }

    public function inProgressTasks()
    {
        try {
            if (auth('admin')->user()->id) {
                $data['tasks'] = Task::where('status', TASK_STATUS_IN_PROGRESS)->get();
            }
            return view('admin.tasks.index', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred.","admin.task.index");
        }
    }

    public function completedTasks()
    {
        try {
            if (auth('admin')->user()->id) {
                $data['tasks'] = Task::where('status', TASK_STATUS_COMPLETE)->get();
            }
            return view('admin.tasks.index', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred.","admin.task.index");
        }
    }

    public function showtask($taskId)
    {
        try {
            $data['task'] = Task::findOrFail($taskId);
            return view('admin.tasks.task-details', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.task.index");
        }
    }

}

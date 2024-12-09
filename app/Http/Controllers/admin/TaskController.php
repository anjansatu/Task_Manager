<?php

namespace App\Http\Controllers\admin;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\TaskAssigned;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {

            $tasks = Task::all();
       
        return view('admin.tasks.index', compact('tasks'));
    }


    public function create()
    {
        $data['users'] = User::all();
        return view('admin.tasks.create', $data);
    }

    public function postCreate(Request $request)
    {
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
        } else {
            return redirect()->route('admin.tasks.index')->with('error', 'User not found.');
        }

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully');
    }

    public function edit($id)
    {
        $data['task'] = Task::findOrFail($id);
        $data['users'] = User::all();
        return view('admin.tasks.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->user_id = $request->input('user_id');
        $task->save();

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully');
    }


    public function pendingTasks()
    {
        $utype = auth()->user()->type;
        if ($utype == 'admin' || $utype == 'manager') {
            $data['tasks'] = Task::pending()->get();
        } else {
            $data['tasks'] = auth()->user()->tasks()->pending()->get();
        }
        return view('admin.tasks.pending', $data);
    }

    public function inProgressTasks()
    {
        $utype = auth()->user()->type;
        if ($utype == 'admin' || $utype == 'manager') {
            $tasks = Task::inProgress()->get();
        } else {
            $tasks = auth()->user()->tasks()->inProgress()->get();
        }

        return view('admin.tasks.in-progress', compact('tasks'));
    }

    public function completedTasks()
    {
        $utype = auth()->user()->type;
        if ($utype == 'admin' || $utype == 'manager') {
            $tasks = Task::completed()->get();
        } else {
            $tasks = auth()->user()->tasks()->completed()->get();
        }

        return view('admin.tasks.completed', compact('tasks'));
    }

    public function updateStatus(Task $task, Request $request)
    {
        $request->validate([
            'status' => 'required|in:To Do,In Progress,Completed',
            'feedback' => 'nullable|string|max:255',
        ]);

        $task->status = $request->input('status');
        $task->feedback = $request->input('feedback');
        $task->save();

        $redirectTo = $this->getRedirectRoute(Auth::user()->type);

        return redirect()->route($redirectTo)->with('status', 'Task status updated successfully.');
    }
    private function getRedirectRoute($userType)
    {
        switch ($userType) {
            case 'admin':
                return 'admin.home';
            case 'manager':
                return 'manager.home';
            default:
                return 'home';
        }
    }
}

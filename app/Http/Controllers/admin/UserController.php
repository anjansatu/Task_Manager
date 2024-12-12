<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;

class UserController extends Controller
{
    public function index()
    {
        try {
            $data['users'] = User::all();
            return view('admin.user.index', $data);
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.user.index");

        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->sessionSuccess("'User deleted successfully .","admin.user.index");

        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.user.index");

        }
    }

    public function showTasks($id)
    {
        try {
            $user = User::findOrFail($id);
            $tasks = $user->tasks;
            return view('admin.user.show-task', compact('user', 'tasks'));
        } catch (\Exception $e) {
            return $this->sessionError("Oops! An error occurred .","admin.user.index");
        }
    }


}

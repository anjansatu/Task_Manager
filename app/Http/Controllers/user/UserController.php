<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as Controller;

class UserController extends Controller
{


    public function showTasks($id)
    {
        try {
            $data['user'] = User::findOrFail($id);
            $data['tasks'] =  $data['user']->tasks;
            return view('users.show-tasks', compact('user', 'tasks'));
        } catch (\Exception $e) {
        return $this->sessionError("Oops!User not found or an error occurred.");

        }
    }


    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return $this->sessionSuccess("User deleted successfully " , 'admin.user.index');

        } catch (\Exception $e) {
        return $this->sessionError("Oops!Failed to delete user or an error occurred.");

        }
    }


}

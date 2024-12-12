<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\BaseController as Controller;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   public function getLogin()
   {
    return view('admin.auth.login');
   }

   public function postLogin(Request $request)
    {
        $admin = Admin::where('email', '=', $request->get("email"))->where('status', '!=', 5)->first();
        if ($admin) {
            if (Auth::guard('admin')->attempt(['email' => $request->get("email"), 'password' => $request->get('password')])) {
            return $this->sessionSuccess(Null,'admin.getDashboard');

            } else {
                return $this->sessionError('Login Field!');
            }
        } else {
            return $this->sessionError('Login Field!');

        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.getLogin')->with('message', 'You have been logged out successfully.');
    }
}

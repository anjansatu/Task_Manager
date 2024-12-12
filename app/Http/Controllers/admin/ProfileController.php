<?php

namespace App\Http\Controllers\admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangeAdminPasswordRequest;
use App\Http\Controllers\BaseController as Controller;


class ProfileController extends Controller
{
    public function profile()
    {
        try {
            if (auth('admin')->check()) {
                $admin = Admin::where('id', '=', auth('admin')->id())->first();
                $data = [
                    "adminInfo" => $admin
                ];
                return view('admin.profile.index', $data);
            } else {
                return $this->sessionSuccess('admin.getLogin');
            }
        } catch (\Exception $e) {
            Log::error('Error in profile method: ' . $e->getMessage());

            return $this->sessionError("Oops! 'Something went wrong. Please try again later.","admin.profile");

        }
    }

    public function changePassword(ChangeAdminPasswordRequest $request)
    {
        try {
            $admin = Admin::find(auth('admin')->id());

            if (!$admin) {
                return $this->sessionError("Oops! 'Invalid User!","admin.profile");
            }

            if (!Hash::check($request->old_password, $admin->password)) {
                return $this->sessionError("Oops! 'Old password is incorrect.","admin.profile");
            }

            $admin->password = bcrypt($request->password);

            if ($admin->save()) {
                return $this->sessionSuccess('Password updated successfully!','admin.profile');
            }

            return $this->sessionError("Oops! 'Failed to update password.","admin.profile");
        } catch (\Exception $e) {
            Log::error('Error in changePassword method: ' . $e->getMessage());

            return $this->sessionError("Oops! An error occurred while updating the password. Please try again later.","admin.profile");
        }
    }

}

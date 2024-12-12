<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\ProfileService;
use App\Http\Controllers\BaseController as Controller;

class ProfileController extends Controller
{
    public function profile()
    {
        try {
            if (auth()->check()) {
                $user = User::where('id', auth()->id())->first();

                if ($user) {
                    $data = [
                        "user" => $user
                    ];
                    return view('user.profile.index', $data);
                } else {
                    return $this->sessionError('User not found.');
                }
            } else {
                return $this->sessionError('signin');
            }
        } catch (\Exception $e) {
            \Log::error('Error fetching user profile: ' . $e->getMessage());

            return $this->sessionError("Oops! An error occurred while fetching the profile.");
        }
    }


    public function changePassword(Request $request)
    {
        try {
            $user = User::find(auth()->id());

            if (!$user) {
                return $this->sessionError('Invalid User!', 'user.profile');
            }

            if (!Hash::check($request->old_password, $user->password)) {
                return $this->sessionError('Old password is incorrect', 'user.profile');
            }

            $request->validate([
                'password' => 'required|min:8|confirmed', // Enforce password confirmation and length
            ]);

            $user->password = bcrypt($request->password);

            if ($user->save()) {
                return $this->sessionSuccess('Password updated successfully!', 'user.profile');
            }
            return $this->sessionError('Unable to update password, please try again.', 'user.profile');
        } catch (\Exception $e) {
            return $this->sessionError('An error occurred, please try again later.', 'user.profile');
        }
    }



}

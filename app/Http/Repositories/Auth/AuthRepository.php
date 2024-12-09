<?php

namespace App\Http\Repositories\Auth;


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    /**
     * Instantiate repository
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserByToken($remember_token){
        return $this->model::where(['remember_token' => $remember_token])->first();
    }
    public function changePassword($user,$new_password){
        $update_password['remember_token'] = md5($user->email . uniqid() . randomNumber(5));
        $update_password['password'] = Hash::make($new_password);
        return $this->model::where(['id' => $user->id, 'remember_token' => $user->remember_token])->update($update_password);
    }
}

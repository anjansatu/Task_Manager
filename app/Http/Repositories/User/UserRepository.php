<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
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

    public function updateUser($id,$user){
        return User::where('id',$id)->update($user);
    }
}

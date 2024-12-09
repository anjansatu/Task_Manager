<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;

class UserProfileRepository
{
    public function getUserInfo($user_id){
        return DB::table('users')
            ->select('users.*','user_details.*')
            ->leftjoin('user_details','user_details.user_id','=','users.id')
            ->where('users.id','=',$user_id);
    }

    public function updateUserData($id,$data){
        return DB::table('users')->where('id','=',$id)->update($data);
    }
}

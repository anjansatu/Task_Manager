<?php

namespace App\Http\Services;

use App\Http\Repositories\ProfileRepository;
use App\Http\Repositories\UserProfileRepository;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    /**
     * Instantiate repository
     *
     * @param ProfileRepository $repository
     */
    private $user_repo;
    private $repo;
    public function __construct(ProfileRepository $repository,
                                UserProfileRepository $userProfileRepository)
    {
        $this->repo = $repository;
        $this->user_repo = $userProfileRepository;
    }

    public function getUserInfo($user_id){
        return $this->user_repo->getUserInfo($user_id);
    }


    public function changeUserPassword(object $request) {
        if (Hash::check($request->old_password, Auth::user()->password)) {
            $changePass = $this->user_repo->updateUserData(Auth::id(), ['password' => bcrypt($request->password)]);
            if ($changePass) {
                return ['success' => TRUE, 'data' => [], 'message' => 'Password updated successfully!'];
            }
        }
        return ['success' => FALSE, 'data' => [], 'message' => 'Invalid User!'];
    }

   

    public function changeAdminPassword(int $userId, object $request) {
        $admin = $this->repo->getAdminByAdminID($userId);
        if ($admin) {
            if (Hash::check($request->old_password, $admin->password)) {
                $changePass = $this->repo->updateAdminData($userId, ['password' => bcrypt($request->password)]);
                if ($changePass) {
                    return ['success' => TRUE, 'data' => [], 'message' => 'Password updated successfully!'];
                }
            }
        }
        return ['success' => FALSE, 'data' => [], 'message' => 'Invalid User!'];
    }

}

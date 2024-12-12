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


}

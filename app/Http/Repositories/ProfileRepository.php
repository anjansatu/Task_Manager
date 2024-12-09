<?php

namespace App\Http\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class ProfileRepository
{
    /**
     * Instantiate repository
     *
     * @param Admin $model
     */
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
    public function getAdminByAdminID($usersId) {
        return $this->model->where('id', $usersId)->first();
    }

    public function updateAdminData(int $userId, array $data) {
        return $this->model->where('id', $userId)->update($data);
    }
}

<?php

namespace App\Http\Services;

use App\Http\Repositories\SettingRepository;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingService
{
    /**
     * Instantiate repository
     *
     * @param SettingRepository $repository
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repo = $repository;
    }

    public function getSettingsById($id){
        return $this->repo->getSettingsById($id);
    }
    public function getSettingsByIds(array $array){
        return $this->repo->getSettingsByIds($array);
    }

    public function updateOrCreateSingleSetting(array $check, array $param){
        return $this->repo->updateOrCreateSingleSetting($check,$param);
    }

    public function saveCommonSettings($data){

        try {
            DB::beginTransaction();
            foreach ($data as $key=>$arr){
                Setting::updateOrCreate(['slug' => $key], ['value' => $arr]);
            }
            DB::commit();
        }catch (\Exception $e){

            DB::rollBack();
            return false;
        }

        return true;
    }
}

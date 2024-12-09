<?php

namespace App\Http\Repositories;

use App\Models\KeySetting;
use Illuminate\Support\Facades\DB;

class SettingRepository
{
    /**
     * Instantiate repository
     *
     * @param KeySetting $model
     */
    public function __construct(KeySetting $model)
    {
        $this->model = $model;
    }
    public function getSettingsById($id){
        return $this->model->where('key',$id)->first();
    }

    public function getSettingsByIds(array $array){
        return $this->model->whereIn('key',$array)->orderBy('key','asc')->get();
    }

    public function updateOrCreateSingleSetting(array $check,array $param){
        return $this->model->updateOrCreate($check,$param);
    }
}

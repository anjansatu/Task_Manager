<?php

namespace App\Http\Services\User;

use App\Http\Repositories\User\UserRepository;
use App\Http\Services\MailService;
use App\Models\User;
use mysql_xdevapi\Exception;

class UserService
{
    private $mailService;
    /**
     * Instantiate repository
     *
     * @param UserRepository $repository
     */
    /**
     * Instantiate repository
     *
     * @param MailService $mailService
     */
    public function __construct(UserRepository $repository, MailService $mailService)
    {
        $this->repo = $repository;
        $this->mailService = $mailService;
    }

    public function userStatus($id){
        $user_data =  User::find($id);
        $inactive = false;

        if($user_data->status==STATUS_ACTIVE){
            $data['email_verified'] = \STATUS_INACTIVE;
            $data['email_verified_at'] = NULL;
            $data['status'] = STATUS_INACTIVE;
            $inactive = true;
        }else{
            $data['email_verified'] = STATUS_ACTIVE;
            $data['email_verified_at'] = date('Y-m-d h:i:s');
            $data['status'] = STATUS_ACTIVE;
        }
        $update = $this->repo->updateUser($id,$data);

        if ($update && $inactive) {
            $data = ['name' => $user_data->name];
            $this->mailService->sendEmail("emails.account-cancellation", $user_data->email, $data,"[GSA Node] Account Cancellation");
        }

        return $update;
    }

       public function userUpdate($id,$data){
        try {
            $this->repo->updateUser($id,$data);
            $response['status'] = true;
            $response['message'] = 'User updated successfully';
        }catch (Exception $e){
            $response['status'] = false;
            $response['message'] = $e->getMessage();
        }
        return $response;
    }
}

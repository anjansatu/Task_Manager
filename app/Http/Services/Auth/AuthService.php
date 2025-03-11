<?php

namespace App\Http\Services\Auth;

use App\Http\Repositories\Auth\AuthRepository;
use App\Http\Services\MailService;
use App\Models\User;

use Carbon\Carbon;
use App\Models\UserVerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthService
{
    protected $repo;
    protected $mailService;

    /**
     * Instantiate repository
     *
     * @param AuthRepository $repository
     */
    public function __construct(AuthRepository $repository, MailService $mailService)
    {
        $this->repo = $repository;
        $this->mailService = $mailService;
    }

    public function register(array $requestArrays)
    {
//        $userName = $this->generateUserName();
        $isUserName = User::where('username', $requestArrays['username'])->first();
        if (!empty($isUserName)) {
            return ['error' => false, 'message' => 'Something Went wrong. Please try again later.'];
        }
        $requestArrays['username'] = $requestArrays['username'];

        DB::beginTransaction();
        try {
            $user = User::create($this->getRegistrationData($requestArrays));
            $vf_code = randomNumber(4);

            UserVerificationCode::create(['email' => $user->email, 'code' => $vf_code, 'expired_at' => Carbon::now()->addDays(1)]);
            $data = ['name' => $user->first_name . ' ' . $user->last_name, 'vf_code' => encrypt($vf_code), 'user_id' => $user->id];
            $this->mailService->sendRegistrationEmail($user->email, $data);

            if (isset($user)) {
                DB::commit();
                return ['success' => true, 'message' => 'Congratulation!! Your Account Has Been Successfully Created. Please Verify Your Email To Login.'];
            } else {
                DB::rollBack();
                return ['error' => false, 'message' => 'Something Went wrong. Please try again later.'];

            }

        } catch (\Exception $exception) {
            DB::rollBack();
            return ['error' => false, 'message' => $exception->getMessage()];
        }
    }

    private function getRegistrationData(array $requestArray)
    {
        $user_data = [
            'name' => $requestArray['name'],
            'email' => $requestArray['email'],
            'username' => $requestArray['username'],
            'phone_number' => $requestArray['phone_number'],
            'password' => bcrypt($requestArray['password']),
            'balance' => 0,
            'status' => STATUS_INACTIVE,
        ];

        return $user_data;
    }


    public function resendVerificationCode($email)
    {
        $code = UserVerificationCode::where('email', $email)->first();
        if ($code) {
            UserVerificationCode::where('id', $code->id)->update(['expired_at' => Carbon::now()->addDays(1)]);
        } else {
            $vf_code = randomNumber(4);
            $code = UserVerificationCode::create(['email' => $email, 'code' => $vf_code, 'expired_at' => Carbon::now()->addDays(1)]);
        }
        $this->mailService->sendVerificationCodeEmail($email, $code->code);
        return ['success' => true, 'data' => $code->code, 'message' => 'Email with verification code has been send successfully'];
    }




    public function userVerifyEmail($code)
    {
        if (!empty($code)) {
            $user = UserVerificationCode::where(['code' => $code])->where('expired_at', '>', Carbon::now())->first();

            if ($user) {
                $u = User::where(['email' => $user->email])->first();
                DB::beginTransaction();
                try {
                    User::where(['id' => $u->id])->update(['email_verified' => STATUS_ACTIVE, 'email_verified_at' => Carbon::now(), 'status' => STATUS_ACTIVE]);
                    UserVerificationCode::where('email', $u->email)->delete();
                    $data = ['name' => $u->username ];
                    $this->mailService->sendEmail("emails.account-activation", $u->email, $data, 'Welcome to task_manager – Registration Successful');
                    $this->mailService->mailPdf($user->email, $data);
                    $response = ['success' => true, 'data' => null, 'message' => __('Thank you for verifying your email address. We are thrilled to confirm that your registration is now complete, and you have full access to your new ' . (allsetting("app_name")) . ' account.')];
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $response = ['success' => false, 'data' => null, 'message' => __('Email Verification Failed')];
                }
            } else {
                $response = ['success' => false, 'data' => null, 'message' => __('Verification Code Not Found')];
            }
            return $response;
        } else {
            $response = ['success' => false, 'data' => null, 'message' => __('Verification Code Not Found')];
        }
    }


    public function validationEmail(array $requestArray)
    {
        $vf_code = randomNumber(4);
        UserVerificationCode::create(['email' => $requestArray['email'], 'code' => $vf_code, 'expired_at' => Carbon::now()->addDays(1)]);
        $data = ['name' => $requestArray['name'], 'vf_code' => $vf_code];
        $this->mailService->sendEmailOTP($requestArray['email'], $data);
        return ['otp' => $vf_code];
    }


}




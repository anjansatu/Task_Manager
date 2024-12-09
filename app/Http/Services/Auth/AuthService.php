<?php

namespace App\Http\Services\Auth;

use App\Http\Repositories\Auth\AuthRepository;
use App\Http\Services\BSCNodeServices;
use App\Http\Services\MailService;
use App\Models\BinaryTrees;
use App\Models\KeySetting;
use App\Models\Referral;
use App\Models\SoloAgentMembers;
use App\Models\Transaction;
use App\Models\Unilevel;
use App\Models\UnilevelChild;
use App\Models\UnilevelSetting;
use App\Models\User;
use App\Models\UserPackage;
use App\Models\Wallet;
use App\Models\WalletHistory;
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
            'email_verified' => 0,
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
                    $this->mailService->sendEmail("emails.account-activation", $u->email, $data, 'Welcome to Innovative – Registration Successful');
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


    public function sendForgotPasswordMailApi($request)
    {
        try {
            $user = User::where(['email' => $request->email])->first();
            if ($user) {
                $token = random_int(1000, 9999);
                $isEmail = DB::table('password_resets')->where(['email' => $user->email])->get();
                if (!empty($isEmail[0])) {
                    $response = ['success' => true, 'data' => null, 'message' => __('Please check your email to recover password.')];
                } else {
                    DB::table('password_resets')->insert([
                        'email' => $user->email,
                        'token' => $token,
                        'created_at' => Carbon::now()
                    ]);
                }
                $data['remember_token'] = $token;
                $data['name'] = $user->name;
                $this->mailService->sendEmail("emails . reset_password_mail_api", $user->email, $data, "We received a request to reset your password");

                $response = ['success' => true, 'data' => null, 'message' => __('Please check your email to recover password.')];
            } else {
                $response = ['success' => false, 'data' => null, 'message' => __('Your email is not correct!')];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'data' => null, 'message' => __($e->getMessage())];
        }
        return $response;
    }

    public function changeStatus($user, $status)
    {
        User::where(['id' => $user->id])->update(['status' => $status]);
    }


    public function commission(int $userId, float $price, string $reason, string $pkg = null)
    {
        if (allsetting('commission_sett') == 1) {
            $user = User::where('id', $userId)->first();
            $level = allsetting('unilevel_comission_level');
            $unilevelSettings = UnilevelSetting::orderBy('key', 'asc')->pluck('value', 'key')->all();
            for ($i = 1; $i <= $level; $i++) {
                $referralUserId = $user->ref_id;
                if (empty($referralUserId)) {
                    break;
                }

                $checkEligibility = $this->eligibilityByReff($referralUserId, $i);
                if ($checkEligibility) {
                    $reffDetails = User::where('id', $referralUserId)->first();
                    $amount = ($price * $unilevelSettings[$i]) / 100;

                    if ($reffDetails->is_affiliate_enable == 1) {
                        $wallet = Wallet::where(['user_id' => $referralUserId])->first();
                        if ($wallet) {
                            Referral::create(['user_id' => $referralUserId, 'referral_id' => $userId, 'earning' => $amount, 'currency' => "USDT", 'reason' => $reason, 'pkg' => $pkg, 'level' => $i, 'status' => 1, 'type' => 1]);
                            WalletHistory::create(['user_id' => $referralUserId, 'wallet_id' => $wallet->id, 'amount' => $amount, 'in_out' => 'IN', 'wallet_type' => 'usdt_affiliate']);
                            Wallet::where('id', $wallet->id)->increment('usdt_affiliate', round($amount, 8));
                        }
                    }
                }

                $user = User::where('id', $referralUserId)->first();
            }
        } else {
            info("Affiliate commission is set to no");
        }
        return TRUE;
    }

    public function spot_commission(int $userId, float $price, string $reason, string $pkg = null)
    {
        if (allsetting('spot_commission_sett') == 1) {
            $user = User::where('id', $userId)->first();
            $spot_bonus = allsetting('spot_bonus');

            $referralUserId = $user->ref_id;
            if (empty($referralUserId)) {
                return true;
            }

            $refUser = User::where('id', $referralUserId)->where('is_package_active', 1)->where('status', 1)->first();
            if ($refUser && $refUser->is_affiliate_enable == 1) {
                $roi_limit = $refUser->roi_limit;
                $total_income = $refUser->total_income;
                $amount = ($price * $spot_bonus) / 100;
                $new_total_income = round($total_income + $amount, 2);

                $wallet = Wallet::where(['user_id' => $referralUserId])->first();
                if ($wallet) {
                    Referral::create(['user_id' => $referralUserId, 'referral_id' => $userId, 'earning' => $amount, 'currency' => "USDT", 'reason' => $reason, 'level' => 1, 'pkg' => $pkg, 'status' => 1, 'type' => 1]);
                    WalletHistory::create(['user_id' => $referralUserId, 'wallet_id' => $wallet->id, 'amount' => $amount, 'from' => $reason, 'in_out' => 'IN', 'wallet_type' => 'usdt_affiliate']);
                    Wallet::where('id', $wallet->id)->increment('usdt_spot', round($amount, 8));
                }
            }
        } else {
            info("Affiliate commission is set to no");
        }
        return TRUE;
    }

    public function deduct_level_equity(int $userId, float $price, string $reason)
    {
        if (allsetting('commission_sett') == 1) {
            $user = User::where('id', $userId)->first();
            $level = allsetting('unilevel_comission_level');
            $unilevelSettings = UnilevelSetting::orderBy('key', 'asc')->pluck('value', 'key')->all();
            for ($i = 1; $i <= $level; $i++) {
                $referralUserId = $user->ref_id;
                if (empty($referralUserId)) {
                    break;
                }

                $amount = ($price * $unilevelSettings[$i]) / 100;

                $wallet = Wallet::where(['user_id' => $referralUserId])->first();
                if ($wallet && $wallet->usdt_affiliate > 0) {
                    WalletHistory::create([
                        'user_id' => $referralUserId,
                        'wallet_id' => $wallet->id,
                        'amount' => $amount,
                        'from' => $reason,
                        'in_out' => 'OUT',
                        'wallet_type' => 'usdt_affiliate',
                        'level' => $i,
                        'ref_id' => $userId
                    ]);
                    if ($wallet->usdt_affiliate >= $amount) {
                        Wallet::where('id', $wallet->id)->decrement('usdt_affiliate', $amount);
                    } else {
                        Wallet::where('id', $wallet->id)->update(['usdt_affiliate' => 0]);
                    }
                }

                $user = User::where('id', $referralUserId)->first();
            }
        } else {
            info("Affiliate commission is set to no");
        }
        return TRUE;
    }

    public function sendForgotPasswordMail($request)
    {
        try {
            $user = User::where(['email' => $request->email])->first();
            if ($user) {
                $data['remember_token'] = encrypt($user->remember_token);
                $data['name'] = $user->first_name . ' ' . $user->last_name;
                $this->mailService->sendEmail("emails.reset_password_mail_api", $user->email, $data, 'Reset Your Password for Innovative');

                $response = ['success' => true, 'data' => null, 'message' => __('Please check your email to recover password.')];
            } else {
                $response = ['success' => false, 'data' => null, 'message' => __('The email address you entered does not match our records. Please try again or contact support for assistance at support@innovative.app ')];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'data' => null, 'message' => __($e->getMessage())];
        }
        return $response;
    }

    public function resetPassword($remember_token)
    {
        try {
            $user = $this->repo->getUserByToken($remember_token);
            if ($user) {
                $response = ['success' => true, 'data' => null, 'message' => __('User get successfully.')];
            } else {
                $response = ['success' => false, 'data' => null, 'message' => __('Invalid request!')];
            }
        } catch (\Exception $exception) {
            $response = ['success' => false, 'data' => null, 'message' => __($exception->getMessage())];
        }
        return $response;
    }

    public function changePassword(Request $request)
    {
        try {
            $user = User::where(['remember_token' => $request->remember_token])->first();
            if ($user) {
                $updated = $this->repo->changePassword($user, $request->password);
                if ($updated) {
                    $data = [
                        'name' => $user->first_name . " " . $user->last_name,
                    ];
                    $user = User::where(['id' => $user->id])->first();
                    $this->mailService->sendEmail("emails.reset_password_done_mail", $user->email, $data, 'Your Password Has Been Successfully Reset');
                    if ($user->status == STATUS_PENDING) {
                        $this->changeStatus($user, STATUS_SUCCESS);
                    }
                    $response = ['success' => true, 'data' => null, 'message' => __('Password changed successfully . ')];
                } else {
                    $response = ['success' => false, 'data' => null, 'message' => __('Password not changed try again!')];
                }
            } else {
                $response = ['success' => false, 'data' => null, 'message' => __('Sorry!user not found . ')];
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'data' => null, 'message' => __($e->getMessage())];
        }
        return $response;
    }

    public function validationEmail(array $requestArray)
    {
        $vf_code = randomNumber(4);
        UserVerificationCode::create(['email' => $requestArray['email'], 'code' => $vf_code, 'expired_at' => Carbon::now()->addDays(1)]);
        $data = ['name' => $requestArray['name'], 'vf_code' => $vf_code];
        $this->mailService->sendEmailOTP($requestArray['email'], $data);
        return ['otp' => $vf_code];
    }

    public function eligibilityByReff($userID, $level)
    {
        $unilevelSettings = UnilevelSetting::pluck('sponsor_to_unlock', 'key');
        $userCount = User::where('ref_id', $userID)->where('is_package_active', 1)->where('status', 1)->count();

        if ($userCount > 0) {
            if ($level == 1 && ($userCount >= $unilevelSettings[1])) return true;
            elseif ($level == 2 && ($userCount >= $unilevelSettings[2])) return true;
            elseif ($level == 3 && ($userCount >= $unilevelSettings[3])) return true;
            elseif ($level == 4 && ($userCount >= $unilevelSettings[4])) return true;
            elseif ($level == 5 && ($userCount >= $unilevelSettings[5])) return true;
            elseif ($level == 6 && ($userCount >= $unilevelSettings[6])) return true;
            elseif ($level == 7 && ($userCount >= $unilevelSettings[7])) return true;
            elseif ($level == 8 && ($userCount >= $unilevelSettings[8])) return true;
            elseif ($level == 9 && ($userCount >= $unilevelSettings[9])) return true;
            elseif ($level == 10 && ($userCount >= $unilevelSettings[10])) return true;
            elseif ($level == 11 && ($userCount >= $unilevelSettings[11])) return true;
            elseif ($level == 12 && ($userCount >= $unilevelSettings[12])) return true;
            elseif ($level == 13 && ($userCount >= $unilevelSettings[13])) return true;
            elseif ($level == 14 && ($userCount >= $unilevelSettings[14])) return true;
            elseif ($level == 15 && ($userCount >= $unilevelSettings[15])) return true;
            elseif ($level == 16 && ($userCount >= $unilevelSettings[16])) return true;
            elseif ($level == 17 && ($userCount >= $unilevelSettings[17])) return true;
            elseif ($level == 18 && ($userCount >= $unilevelSettings[18])) return true;
            elseif ($level == 19 && ($userCount >= $unilevelSettings[19])) return true;
            elseif ($level == 20 && ($userCount >= $unilevelSettings[20])) return true;
            elseif ($level == 21 && ($userCount >= $unilevelSettings[21])) return true;
            elseif ($level == 22 && ($userCount >= $unilevelSettings[22])) return true;
            elseif ($level == 23 && ($userCount >= $unilevelSettings[23])) return true;
            elseif ($level == 24 && ($userCount >= $unilevelSettings[24])) return true;
            elseif ($level == 25 && ($userCount >= $unilevelSettings[25])) return true;

            else return false;
        }
        return false;
    }

    protected function generateUserName()
    {
        do {
            $userName = "Inv-" . rand(100000, 999999);
        } while (User::where('username', $userName)->count());

        return $userName;
    }
}




<?php

namespace App\Http\Controllers\user\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Auth\AuthService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\Web\ForgetPasswordRequest;
use App\Http\Controllers\BaseController as Controller;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $service)
    {
        $this->authService = $service;
    }

    public function index(){
        return view('user.auth.login');
    }

    public function postLogin(Request $request){
        if (allsetting('access_login') != 1) {
            return $this->sessionError('Login access is currently disabled.', null);
        }

        $validator = Validator::make($request->all(), [
            'password' => 'required',
        ]);

        if ($validator->fails()) {

            return $this->sessionError($validator->errors()->first());
        }

        $login = $request->input('email');
        $user = User::where('email', $login)->orWhere('username', $login)->first();

        if (!$user) {
            return redirect()->back()->with('error_message', "Oops! It seems there might be an error with the email/username or password you've entered. Please double-check your details and try again.");
        }


        if (Auth::attempt(['email'=>$user->email,'password'=>$request->input('password')]) || Auth::attempt(['email'=>$user->username,'password'=>$request->input('password')])) {
            if (auth()->user()->status == STATUS_ACTIVE) {
                return $this->sessionSuccess("You have successfully logged in to " , 'dashboard');
            } elseif (auth()->user()->status == STATUS_INACTIVE) {
                Auth::logout();
                return $this->sessionError('Please verify your email!');

            }
            return $this->sessionSuccess("You have successfully logged in to " ,'dashboard');
        }
        return $this->sessionError("Oops! It seems there might be an error with the email or password you've entered. Please double-check your details and try again.");
    }

    public function signup(){
        return view('user.auth.register');
    }

    public function validationEmail(Request $request)
    {
        if (allsetting('access_registration') != 1) {
            return $this->responseError("Registration access is currently disabled due to system maintenance. Please try again later.", 500, []);
        }
        $validator = Validator::make($request->all(), [
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->responseError($validator->errors()->first(), 403, []);
        }

        $data = $this->authService->validationEmail($request->all());
        return $this->responseSuccess("OTP successfully sent to your email.", $data, 200);

    }
    public function postSignUp(UserRegistrationRequest $request)
    {
        if (allsetting('access_registration') != 1) {
            return $this->sessionError('Registration is temporarily disabled due to system maintenance. Please try again later.');
        }

        $resp = $this->authService->register($request->all());
        if (isset($resp['success']) && $resp['success'] == true) {
            return $this->sessionSuccess($resp['message'], 'login');
        }

        return $this->sessionError($resp['message']);
    }

    public function signOut()
    {
        Auth::guard('web')->logout();
        return $this->sessionSuccess(null, 'login');
    }

    public function userVerifyEmail($code)
    {
        $code = decrypt($code);
        $response = $this->authService->userVerifyEmail($code);
        if ($response['success']) {
            return $this->sessionSuccess($response['message'], 'login');
        } else {
            return $this->sessionError($response['message'], [], 'login');
        }
    }

    public function forgetPassword()
    {
        return view('user.auth.forget-password');
    }

    public function sendForgetPasswordMail(ForgetPasswordRequest $request)
    {

        $resp = $this->authService->sendForgotPasswordMail($request);
        if (isset($resp['success']) && $resp['success'] == true) {
            return $this->sessionSuccess($resp['message']);
        } elseif (isset($resp['success']) && $resp['success'] == false) {
            return $this->sessionError($resp['message']);
        }
        return $this->sessionError('Something went wrong!');
    }

    public function resetPassword($token)
    {
        $remember_token = decrypt($token);

        $response = $this->authService->resetPassword($remember_token);
        if ($response['success']) {
            $data['remember_token'] = $remember_token;
            return view('user.auth.reset_password', $data);
        } else {
            return $this->sessionError($response['message'], [], 'login');
        }
    }

    public function changePasswordUser(Request $request)
    {
        if ($request->toc == 1) {
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'min:8', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
                'password_confirmation' => 'required|same:password'
            ]);
            if ($validator->fails()) {
                return $this->sessionError($validator->errors()->first());
            }
            $resp = $this->authService->changePassword($request);

            if (isset($resp['success']) && $resp['success'] == true) {
                return $this->sessionSuccess($resp['message'], 'login');
            }
            return $this->sessionError($resp['message']);
        }else{
            return $this->sessionError('Changing password is not permitted now');
        }


    }

}

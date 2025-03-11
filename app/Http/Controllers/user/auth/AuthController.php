<?php

namespace App\Http\Controllers\user\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
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

    public function postLogin(Request $request)
{
    if (allsetting('access_login') != 1) {
        return $this->sessionError('Login access is currently disabled.', null);
    }

    $validator = Validator::make($request->all(), [
        'email' => 'required|email', // Email field validation যোগ করা হলো
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return $this->sessionError($validator->errors()->first());
    }

    // $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
    //     'secret' => env('RECAPTCHA_SECRET'),
    //     'response' => $request->input('g-recaptcha-response')
    // ]);

    // $result = $response->json();

    // if (!$result['success']) {
    //     return back()->withErrors(['captcha' => 'reCAPTCHA verification failed!']);
    // }


    if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        return $this->sessionSuccess("You have successfully logged in to ", 'dashboard');
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

}

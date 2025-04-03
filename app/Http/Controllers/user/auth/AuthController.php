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
use Illuminate\Support\Facades\RateLimiter;
use App\Http\Controllers\BaseController as Controller;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $service)
    {
        $this->authService = $service;
    }

    public function index()
    {
        return view('user.auth.login');
    }

   public function postLogin(Request $request)
    {
        if (allsetting('access_login') != 1) {
            return back()->withErrors(['error' => 'Login access is currently disabled.']);
        }
    
        // Unique Key for Rate Limiting (IP Based)
        $key = 'login_attempts_' . $request->ip();
    
        // Check if Too Many Login Attempts
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['error' => 'Too many login attempts. Please try again in 1 minute.'])->withInput();
        }
    
        // Validate Input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            // 'g-recaptcha-response' => 'required'
        ]);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        // Verify Google reCAPTCHA (Optional)
        /*
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET'),
            'response' => $request->input('g-recaptcha-response')
        ]);
    
        $result = $response->json();
    
        if (!$result['success']) {
            return back()->withErrors(['captcha' => 'reCAPTCHA verification failed!'])->withInput();
        }
        */
    
        // Authenticate User
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            RateLimiter::clear($key); // Reset Rate Limiter on Successful Login
            return redirect()->route('dashboard')->with('success', "You have successfully logged in.");
        }
    
        // Increase Login Attempt Count
        RateLimiter::hit($key, 60); // 60 seconds (1 min) cooldown
    
        return back()->withErrors(['error' => "Oops! Incorrect email or password. Please try again."]);
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

<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class MailService
{
    public function sendRegistrationEmail(string $to, array $data)
    {
        try {
            Mail::send('emails.registration', $data, function ($message) use ($to) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($to)->subject('Confirm Your Email to Start Your Journey with Innovative');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }

        return true;
    }

    public function sendVerificationCodeEmail(string $email, string $code)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $to = $user->email;
            $data = ['user_id' => $email, 'name' => $user->name, 'vf_code' => $code];
            try {
                Mail::send('emails.resend-verification-code', $data, function ($message) use ($to) {
                    $message->from(config('mail.from.address'), config('mail.from.name'));
                    $message->to($to);
                });
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }
        return true;
    }

    public function sendEmail(string $temp, string $to, array $data, $subject)
    {
        try {
            Mail::send($temp, $data, function ($message) use ($to, $subject) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($to)->subject($subject);
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }

        return true;
    }
   

}

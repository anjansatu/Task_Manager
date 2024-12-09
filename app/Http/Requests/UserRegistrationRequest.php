<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'email' => 'unique:users,email|required',
            'username' => 'unique:users,username|required',
            'password' => ['required', Password::min(6)],
            'password_confirmation' => 'required|same:password',
        ];
        if (allsetting('is_reff_code_required') == 1) {
            $rules['ref_id'] = 'required|exists:users,username';
        } else {
            $rules['ref_id'] = 'sometimes|nullable|exists:users,username';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'username.regex' => 'The username must be alphanumeric and between 4 to 15 characters long.',
        ];
    }
}

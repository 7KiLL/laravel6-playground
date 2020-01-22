<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class PhoneVerification extends FormRequest
{
    public function authorize()
    {
        return !Auth::user()->is_verified;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'request_id' => ['required', 'uuid'],
            'code' => ['required', 'digits:4']
        ];
    }
}

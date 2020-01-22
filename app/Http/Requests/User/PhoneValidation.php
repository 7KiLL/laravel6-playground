<?php

namespace App\Http\Requests\User;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PhoneValidation extends FormRequest
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
            'phone' => ['required', Rule::unique('users', 'phone')->ignoreModel(auth()->user()), new PhoneNumber]
        ];
    }
}

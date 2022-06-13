<?php

namespace Modules\Auth\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'     => 'required|email',
            'password'  => 'required|min:6',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {

        $v = [
            'email.required'      =>   __('auth::dashboard.login.validations.email.required'),
            'email.email'         =>   __('auth::dashboard.login.validations.email.email'),
            'password.required'   =>   __('auth::dashboard.login.validations.password.required'),
            'password.min'        =>   __('auth::dashboard.login.validations.password.min'),
        ];

        return $v;
    }
}

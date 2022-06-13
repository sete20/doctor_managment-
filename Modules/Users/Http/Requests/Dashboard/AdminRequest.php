<?php

namespace Modules\Users\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                  'roles'           => 'required',
                  'name'            => 'required',
                  'mobile'          => 'required|numeric|unique:users,mobile|digits_between:8,8',
                  'email'           => 'required|unique:users,email',
                  'password'        => 'required|min:6|same:confirm_password',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'roles'           => 'required',
                    'name'            => 'required',
                    'mobile'          => 'required|numeric|digits_between:8,8|unique:users,mobile,'.$this->id.'',
                    'email'           => 'required|unique:users,email,'.$this->id.'',
                    'password'        => 'nullable|min:6|same:confirm_password',
                  ];
        }
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
            'roles.required'          => __('users::dashboard.admins.validation.roles.required'),
            'name.required'           => __('users::dashboard.admins.validation.name.required'),
            'email.required'          => __('users::dashboard.admins.validation.email.required'),
            'email.unique'            => __('users::dashboard.admins.validation.email.unique'),
            'mobile.required'         => __('users::dashboard.admins.validation.mobile.required'),
            'mobile.unique'           => __('users::dashboard.admins.validation.mobile.unique'),
            'mobile.numeric'          => __('users::dashboard.admins.validation.mobile.numeric'),
            'mobile.digits_between'   => __('users::dashboard.admins.validation.mobile.digits_between'),
            'password.required'       => __('users::dashboard.admins.validation.password.required'),
            'password.min'            => __('users::dashboard.admins.validation.password.min'),
            'password.same'           => __('users::dashboard.admins.validation.password.same'),
        ];

        return $v;
    }
}

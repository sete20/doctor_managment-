<?php

namespace Modules\Users\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            // handle creates
            case 'post':
            case 'POST':

                return [
                    //general info
                    'name' => 'required',
                    'email' => 'required|unique:clients,email',
                    'phone' => 'required|unique:clients,phone',
                    'password' => 'required|confirmed|min:6',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    //general info
                    'name' => 'required',
                    'email' => 'required|unique:clients,email,'.$this->client,
                    'phone' => 'required|unique:clients,phone,'.$this->client,
                    'password' => 'nullable|confirmed|min:6',
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

//    public function messages()
//    {
//
//    }
}

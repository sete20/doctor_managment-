<?php

namespace Modules\Users\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ClientNotificationRequest extends FormRequest
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
                    'title' => 'required',
//                    'clients' => 'required|exists:clients,id',
                ];

            //handle updates
            case 'put':
            case 'PUT':

                return [
                    'title' => 'required',
                    'clients' => 'required|exists:clients,id',
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

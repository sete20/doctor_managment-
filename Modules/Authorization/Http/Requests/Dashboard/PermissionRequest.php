<?php

namespace Modules\Authorization\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
                  'display_name'  => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'display_name'  => 'required',
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
            'display_name.required'   => __('authorization::dashboard.permissions.validation.display_name.required'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["description.".$key.".required"]  = __('authorization::dashboard.permissions.validation.description.required').' - '.$value['native'].'';

        }

        return $v;

    }
}

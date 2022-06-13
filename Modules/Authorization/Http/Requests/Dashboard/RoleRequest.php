<?php

namespace Modules\Authorization\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                  'name'            => 'required|unique:roles,name',
                  'display_name.*'  => 'required',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name'            => 'required|unique:roles,name,'.$this->id.'',
                    'display_name.*'  => 'required',
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
            'name.required'           => __('authorization::dashboard.roles.validation.name.required'),
            'name.unique'             => __('authorization::dashboard.roles.validation.name.unique'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["display_name.".$key.".required"] = __('authorization::dashboard.roles.validation.display_name.required').' - '.$value['native'].'';

          $v["description.".$key.".required"]  = __('authorization::dashboard.roles.validation.description.required').' - '.$value['native'].'';

        }

        return $v;

    }
}

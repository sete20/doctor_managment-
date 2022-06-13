<?php

namespace Modules\Doctors\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
                  'name'         => 'required|unique:doctors,name',
                  'email'         => 'required|unique:doctors,email',
                  'password'         => 'required|min:6',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'name'         => 'required|unique:doctors,name,'.$this->id,
                    'email'         => 'required|unique:doctors,email,'.$this->id,
                    'password'         => 'nullable|min:6',
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
}

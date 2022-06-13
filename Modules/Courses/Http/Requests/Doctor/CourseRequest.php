<?php

namespace Modules\Courses\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
                  'category_id'     => 'required',
                  'price'     => 'required|numeric|min:0',
                  'offer_price'     => 'nullable|numeric|min:0',
                  'title.*'         => 'required|',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'category_id'     => 'required',
                    'price'     => 'required|numeric|min:0',
                    'title.*'          => 'required',
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

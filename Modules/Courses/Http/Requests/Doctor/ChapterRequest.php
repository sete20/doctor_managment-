<?php

namespace Modules\Courses\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
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
                  'course_id'     => 'required',
                  'title.*'         => 'required|unique:chapter_translations,title',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'course_id'     => 'required',
                    'title.*'          => 'required|unique:chapter_translations,title,'.$this->id.',chapter_id',
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

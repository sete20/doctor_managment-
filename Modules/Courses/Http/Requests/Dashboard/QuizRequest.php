<?php

namespace Modules\Courses\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{

    public function rules()
    {
        switch ($this->getMethod())
        {
            // handle creates
            case 'post':
            case 'POST':

                return [
                    'chapter_id'     => 'required|exists:chapters,id',
                    'title.*'         => 'required',
                    'description.*'         => 'required',
                    'questions' => 'required|array',
                    'questions.*' => 'required',
                    'answers' => 'required|array',
                    'answers.*' => 'required'
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'chapter_id'     => 'required|exists:chapters,id',
                    'title.*'         => 'required',
                    'description.*'         => 'required',
                    'questions' => 'required|array',
                    'questions.*' => 'required',
                    'answers' => 'required|array',
                    'answers.*' => 'required'
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

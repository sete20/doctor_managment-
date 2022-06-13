<?php

namespace Modules\Courses\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
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
                  'chapter_id'     => 'required|exists:chapters,id',
                  'title.*'         => 'required|unique:lesson_translations,title',
                  'description.*'         => 'required|unique:lesson_translations,description',
                  'attachment'         => 'nullable|max:3000',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'chapter_id'     => 'required|exists:chapters,id',
                    'title.*'          => 'required|unique:lesson_translations,title,'.$this->id.',lesson_id',
                    'description.*'         => 'required|unique:lesson_translations,description,'.$this->id.',lesson_id',
                    'attachment'         => 'nullable|max:3000',
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
            'chapter_id.required'    => __('courses::dashboard.contents.cards.validation.chapter_id.required'),
        ];

        foreach (config('laravellocalization.supportedLocales') as $key => $value) {

          $v["title.".$key.".required"]  = __('courses::dashboard.contents.cards.validation.title.required').' - '.$value['native'].'';

          $v["title.".$key.".unique"]    = __('courses::dashboard.contents.cards.validation.title.unique').' - '.$value['native'].'';

          $v["description.".$key.".required"]  = __('courses::dashboard.contents.cards.validation.description.required').' - '.$value['native'].'';

          $v["description.".$key.".unique"]    = __('courses::dashboard.contents.cards.validation.description.unique').' - '.$value['native'].'';

        }

        return $v;

    }
}

<?php

namespace Modules\Courses\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
{

    public function rules()
    {
        switch ($this->getMethod()) {
            // handle creates
            case 'post':
            case 'POST':

                return [
                    'chapter_id' => 'required|exists:chapters,id',
                    'title.*' => 'required',
                    'description.*' => 'required',
                    'video' => 'required|mimes:mp4,mov,ogg,qt',
                ];

            //handle updates
            case 'put':
            case 'PUT':
                return [
                    'chapter_id' => 'required|exists:chapters,id',
                    'title.*' => 'required',
                    'description.*' => 'required',
                    'video' => 'nullable|mimes:mp4,mov,ogg,qt',
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

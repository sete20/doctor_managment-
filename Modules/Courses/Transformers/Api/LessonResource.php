<?php

namespace Modules\Courses\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use Modules\Category\Transformers\Dashboard\CategoryResource;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;

class LessonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $mediaItem = $this->getFirstMedia('videos');

        if($mediaItem){
            $url = explode('/',$mediaItem->getFullUrl());
            unset($url[count($url) - 1]);
            $url = implode('/' , $url).'/';
            $url = Str::replace('storage' , 'media',$url);
        }else{
            $url = '';
        }

        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'description' => $this->description,
            'video_info' => [
                'is_completed' => $this->is_completed,
                'urls' => [
                    [
                        'quality' => '144',
                        'url' => $mediaItem ? $url.$mediaItem->getCustomProperty('144', null) : asset($this->source),
                    ],
                    [
                        'quality' => '480',
                        'url' => $mediaItem ? $url.$mediaItem->getCustomProperty('480', null) : asset($this->source),
                    ],
                    [
                        'quality' => '1080',
                        'url' => $mediaItem ? $url.$mediaItem->getCustomProperty('1080', null) : asset($this->source),
                    ],
                ],
                'length' => '0:30',
            ],
            'card_info' => [
                'url' => asset('uploads/testing.mp3'),
            ],
            'quiz_info' => [
                'is_answered' => $this->quiz_is_answered,
                'total_mark' => optional($this->quiz_answered)->question_count,
                'correct_answers' => optional($this->quiz_answered)->wright_answers_count,
            ],
        ];
    }
}

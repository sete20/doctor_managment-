<?php

namespace Modules\Courses\Entities;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;
use Modules\Core\Traits\ScopesTrait;
use Modules\Courses\Transformers\Api\AnswerResource;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Faq extends Model implements HasMedia
{
    use SoftDeletes, CrudModel,InteractsWithMedia;

    protected $fillable = ['status', 'lesson_id','title'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function clientAnswers()
    {
        return $this->hasMany(ClientAnswer::class,'faq_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function wrightAnswer()
    {
        return $this->hasMany(Answer::class)->where('true_answer', 1);
    }

    public function getUserAnswerAttribute()
    {
        $response = [
            'is_answered' => 0,
            'user_answer' => null,
            'correct_answer' => null,
            'is_true_answer' => null,
        ];
        $user = auth('api-client')->user();

        if ($user) {

                $client_answer = $this->clientAnswers()->where('client_id', $user->id)->first();

            if ($client_answer && $client_answer->answer) {
                $answer = $client_answer->answer;
                $response ['is_answered'] = 1;
                $response ['user_answer'] = new AnswerResource($answer);
                $response ['correct_answer'] = AnswerResource::collection($this->wrightAnswer()->get());
                $response ['is_true_answer'] = $this->wrightAnswer()->find($answer->id) ? true : false;
            }
        }
        return $response;
    }

}

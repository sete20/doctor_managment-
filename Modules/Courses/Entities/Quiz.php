<?php

namespace Modules\Courses\Entities;

use App\Traits\GetAttribute;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;
use Modules\Users\Entities\Client;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Quiz extends Model implements HasMedia
{
    use Translatable , SoftDeletes , ScopesTrait , InteractsWithMedia;

    protected $with 					    = ['translations'];
    protected $fillable 					= ['status' , 'chapter_id','order','type'];
    public $translatedAttributes 	        = [ 'title','description'];
    public $translationModel 			    = LessonTranslation::class;
    protected $table = 'lessons';
    public $timestamps = true;

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function questions()
    {
        return $this->hasMany(Faq::class ,'lesson_id');
    }

    public function clientAnswered()
    {
        return $this->hasMany(ClientQuiz::class ,'quiz_id');
    }

    public function getQuizIsAnsweredAttribute()
    {
        $user = auth('api-client')->user();
        if($this->type == 'quiz' && $user && $this->clientAnswered()->where('client_id',$user->id)->first())
            return 1;
        else
            return 0;
    }

    public function getQuizAnsweredAttribute()
    {
        $user = auth('api-client')->user();
        if($user) {
            if($this->type == 'quiz') {

                $answered_quiz = $this->clientAnswered()->where('client_id',$user->id)->first();
                if ($answered_quiz)
                    return $answered_quiz;
            }
        }
        return null;
    }

    public function scopequiz($query) {
        return $query->where('type' , 'quiz');
    }

    public function scopecard($query) {
        return $query->where('type' , 'card');
    }

    public function scopelesson($query) {
        return $query->where('type' , 'video');
    }

    public function scopeDoctor($query)
    {
        return $query->whereHas('chapter', function ($q) {
            $q->whereHas('course', function ($q) {
                $q->where('doctor_id', auth('doctor')->id());
            });
        });
    }
}
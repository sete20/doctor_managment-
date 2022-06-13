<?php

namespace Modules\Users\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Modules\Courses\Entities\ClientAnswer;
use Modules\Courses\Entities\ClientCourse;
use Modules\Courses\Entities\ClientQuiz;
use Modules\Courses\Entities\Course;
use Modules\Courses\Entities\Faq;
use Modules\Courses\Entities\Lesson;
use Modules\Notifications\Entities\Notification;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Client extends Authenticatable implements HasMedia
{
    use HasApiTokens, Notifiable,InteractsWithMedia;

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone','password','screen_shot_num');

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function requests()
    {
        return $this->hasMany(ClientCourse::class,'client_id');
    }

    public function lessonCompletes()
    {
        return $this->belongsToMany(Lesson::class ,'client_completions')->whereHas('chapter' , function ($q){
            $q->whereIn('course_id' , $this->courses->pluck('id')->toArray());
        });
    }

    public function faqs()
    {
        return $this->belongsToMany(Faq::class , 'client_answers');
    }

    public function answers()
    {
        return $this->hasMany(ClientAnswer::class , 'client_id');
    }

    public function quiz()
    {
        return $this->hasMany(ClientQuiz::class);
    }

    public function answeredQuiz()
    {
        return $this->belongsToMany(Lesson::class , 'client_quiz','client_id','quiz_id');
    }

    public function notifications()
    {
        return $this->morphToMany(Notification::class , 'notifiable')->withPivot('is_read');
    }

    public function token()
    {
        return $this->morphOne(Token::class , 'tokenable');
    }

    public function scopeDoctor($query)
    {
        return $query->whereHas('courses'  , function ($q) {
            $q->where('doctor_id' , auth('doctor')->id());
        });
    }
}
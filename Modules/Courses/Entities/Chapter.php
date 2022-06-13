<?php

namespace Modules\Courses\Entities;

use App\Traits\GetAttribute;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Traits\ScopesTrait;
use Modules\Notifications\Entities\Notification;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Chapter extends Model implements HasMedia
{
    use Translatable , SoftDeletes , ScopesTrait, GetAttribute, InteractsWithMedia;

    protected $table = 'chapters';
    protected $with 					    = ['translations'];
    protected $fillable 					= ['status' , 'course_id','order'];
    public $translatedAttributes 	        = [ 'title'];
    public $translationModel 			    = ChapterTranslation::class;
    public $timestamps = true;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function videos()
    {
        return $this->hasMany(Lesson::class)->where('type','video');
    }

    public function quizs()
    {
        return $this->hasMany(Lesson::class)->where('type','quiz');
    }

    public function grades()
    {
        $user = auth('api-client')->user();
        return $this->hasMany(Lesson::class)->where('type','quiz')->whereHas('clientAnswered' , function ($q) use($user){
            $q->where('client_id',$user->id);
        });
    }

    public function cards()
    {
        return $this->hasMany(Lesson::class)->where('type','card');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function getResourcesAttribute()
    {
        return $this->getFiles('resources');
    }


    public function scopeDoctor($query)
    {
        return $query->whereHas('course'  , function ($q) {
            $q->where('doctor_id' , auth('doctor')->id());
        });
    }
}
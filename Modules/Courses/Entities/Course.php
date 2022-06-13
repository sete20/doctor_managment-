<?php

namespace Modules\Courses\Entities;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Category\Entities\Category;
use Modules\Core\Traits\ScopesTrait;
use Modules\Doctors\Entities\Doctor;
use Modules\Notifications\Entities\Notification;
use Modules\Users\Entities\Client;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use Translatable, SoftDeletes, ScopesTrait, InteractsWithMedia;

    protected $with = ['translations'];
    protected $fillable = ['status', 'image', 'category_id', 'doctor_id', 'price', 'offer_price', 'is_offered','intro'];
    public $translatedAttributes = ['title', 'description', 'note'];
    public $translationModel = CourseTranslation::class;
    protected $table = 'courses';
    protected $withCount = ['videos', 'completeStatus'];
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class);
    }

    public function videos()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class)->lesson();
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }

    public function requests()
    {
        return $this->hasMany(ClientCourse::class, 'course_id');
    }

    public function acceptedRequests()
    {
        return $this->hasMany(ClientCourse::class, 'course_id')->where('status','accepted');
    }

    public function content()
    {
        return $this->hasMany('App\Models\CourseContent');
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    public function getClientStatusAttribute()
    {
        $status = 'not_asked';

        $user = auth('api-client')->user();

        if ($user) :
            $request = $this->requests()->where('client_id', $user->id)->first();
            $status = $request ? $request->status : $status;
        endif;

        return $status;
    }

    public function getFirstChapterAttribute()
    {
        return $this->chapters()->Active()->orderBy('order')->first();
    }

    public function getClientCompletePercentageAttribute()
    {
        $total_lessons = $this->lessons()->lesson()->count();
        $show_lessons = auth('api-client')->check() ? $this->lessons()->lesson()->whereHas('clientCompletes', function ($q) {
            $q->where('client_id', auth('api-client')->user()->id);
        })->count() : 0;

        return number_format(($total_lessons ? ($show_lessons / $total_lessons) * 100 : 0),1);
    }

    public function completeStatus()
    {
        return $this->hasManyThrough(Lesson::class, Chapter::class)->lesson()
            ->whereHas('clientCompletes', function ($q) {
                $q->where('client_id', (auth('api-client')->check() ? auth('api-client')->user()->id : null));
            });
    }

    public function getVideosCountAttribute()
    {
        return $this->lessons()->lesson()->count();
    }

    public function getQuizCountAttribute()
    {
        return $this->lessons()->quiz()->count();
    }

    public function getCardCountAttribute()
    {
        return $this->lessons()->card()->count();
    }

//    public function scopeNotCompleted($query)
//    {
//        return $query->whereHas('lessons' , function ($q){
//            $q->lesson()->whereHas()
//        });
//    }


    public function scopeDoctorScope($query)
    {
        return $query->where('doctor_id' , auth('doctor')->id());
    }
}
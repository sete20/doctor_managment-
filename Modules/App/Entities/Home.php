<?php

namespace Modules\App\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Traits\Dashboard\CrudModel;
use Modules\Core\Traits\HasTranslations;
use Modules\Courses\Entities\Course;

class Home extends Model
{
    use CrudModel, HasTranslations;

    protected $table = 'home';
    public $timestamps = true;
    protected $fillable = ['status', 'title'];
    public $translatable = ['title'];

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_home');
    }

}
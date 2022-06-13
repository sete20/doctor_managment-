<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;

class LessonTranslation extends Model
{
    protected $fillable = [ 'title','description'];
}

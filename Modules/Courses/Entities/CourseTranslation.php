<?php

namespace Modules\Courses\Entities;

use Illuminate\Database\Eloquent\Model;

class CourseTranslation extends Model
{
    protected $fillable = [ 'title' , 'description','note'];
}

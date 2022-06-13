<?php

namespace Modules\Courses\Repositories\Doctor;

use Illuminate\Http\Request;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Courses\Entities\Lesson;

class LessonRepository extends CrudRepository
{
    public function getModel()
    {
        return $this->model->Doctor();
    }
}

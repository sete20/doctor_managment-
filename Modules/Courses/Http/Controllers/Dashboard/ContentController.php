<?php

namespace Modules\Courses\Http\Controllers\Dashboard;

use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Lesson;
use Modules\Courses\Repositories\Dashboard\LessonRepository;

class ContentController extends Controller
{
    use CrudDashboardController{
        __construct as private CrudConstruct;
    }

    function __construct()
    {
        $this->CrudConstruct();
        $this->setModel(Lesson::class);
        $this->setRepository(LessonRepository::class);
        $this->setViewPath('courses::dashboard.contents');
    }
}

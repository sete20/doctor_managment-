<?php

namespace Modules\Courses\Http\Controllers\Doctor;

use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Lesson;

class VideoController extends Controller
{
    use CrudDashboardController{
        __construct as private __CrudConstruct;
    }

    function __construct()
    {
        $this->__CrudConstruct();
        $this->setModel(Lesson::class);
        $this->setViewPath('courses::doctor.contents.videos');
    }


    public function show($id){
        $video = $this->repository->findById($id);
        $views = $video->clientCompletes()->paginate(10);
        return $this->view('show' , compact('views','video'));
    }
}

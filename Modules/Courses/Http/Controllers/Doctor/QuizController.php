<?php

namespace Modules\Courses\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Courses\Entities\Lesson as Card;
use Modules\Courses\Entities\Lesson;

class QuizController extends Controller
{
    use CrudDashboardController{
        CrudDashboardController::__construct as private CrudConstruct;
    }

    public function __construct()
    {
        $this->CrudConstruct();
        $this->setModel(Lesson::class);
        $this->setViewPath('courses::doctor.contents.quiz');
    }

    public function show($id){
        $quiz = $this->repository->findById($id);
        $quizAnsweres = $quiz->clientAnswered()->paginate(10);
        return $this->view('show' , compact('quiz','quizAnsweres'));
    }
}

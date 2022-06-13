<?php

namespace Modules\Courses\Http\Middleware;

use Closure;
use Helper\Response;
use Illuminate\Http\Request;
use Modules\Courses\Repositories\Api\ChapterRepository;
use Modules\Courses\Repositories\Api\CourseRepository;
use Modules\Courses\Repositories\Api\LessonRepository;
use Modules\Courses\Repositories\Api\QuizRepository;

class AvailableCourse
{
    private $course;
    private $chapter;
    private $lesson;
    private $quiz;

    public function __construct(CourseRepository $course , ChapterRepository $chapter , LessonRepository $lesson , QuizRepository $quiz)
    {
        $this->course = $course;
        $this->chapter = $chapter;
        $this->lesson = $lesson;
        $this->quiz = $quiz;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $course = null;
        if ($request->course_id) {
            $course = optional($this->course->findById($request->course_id));
        }

        if($request->chapter_id) {
            $chapter = $this->chapter->findById($request->chapter_id);

            if(!$chapter)
                return Response::responseJson(0, 'chapter not found');

            $course = $chapter->course;
        }

        if($request->lesson_id) {
            $lesson = $this->lesson->findById($request->lesson_id);

            if(!$lesson)
                return Response::responseJson(0,'lesson not found');

            $course = optional($lesson->chapter)->course;
        }

        if($request->quiz_id) {
            $lesson = $this->quiz->findById($request->quiz_id);

            if(!$lesson)
                return Response::responseJson(0,'quiz not found');

            $course = optional($lesson->chapter)->course;
        }

        return $this->checkCourseStatus($course , $next , $request);
    }

    private function checkCourseStatus($course ,$next , $request) {

        if($course) {
            $status = $course->client_status;
            if ($status || $status != 'accepted') {
                switch ($status) {
                    case 'accepted':
                        return $next($request);
                    case 'pending':
                        return Response::responseJson(0,'your request done wait for admin response');
                    default:
                        return Response::responseJson(0,'you must book the course first');
                }
            }
        }

        return Response::responseJson(0,'course not found');
    }
}

<?php

namespace Modules\Courses\Repositories\Api;

use Illuminate\Http\Request;
use Modules\Courses\Entities\ClientCourse;
use Modules\Courses\Entities\Course;
use Illuminate\Support\Facades\DB;

class CourseRepository
{
    private $course;

    function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function getAll($order = 'id', $sort = 'asc')
    {
        $courses = $this->course->Active()->orderBy($order, $sort)->get();
        return $courses;
    }

    public function findById($id)
    {
        $courses = $this->course->Active()->find($id);
        return $courses;
    }

    public function findMyCourseById(Request $request, $id)
    {
        $client = $request->user('api-client');
        $courses = $client->courses()->where('courses.status', 1)->Active()->find($id);
        return $courses;
    }

    public function getPagination($request, $order = 'id', $sort = 'asc')
    {
        $paginate = $request->paginate_number ? $request->paginate_number : 10;
        $courses = $this->course->Active()->where(function ($q) use ($request) {

            if ($request->id):
                $q->where('id', $request->id);
            else:
                if ($request->search):

                    $q->whereHas('translations', function ($q) use ($request) {
                        $q->where('title', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                            ->orWhere('note', 'LIKE', '%' . $request->search . '%');
                    });

                endif;

                if ($request->doctor_id):
                    $q->where('doctor_id', $request->doctor_id);
                endif;

                if ($request->category_id):
                    $q->where('category_id', $request->category_id);
                endif;

            endif;
        })->orderBy($order, $sort)->paginate($paginate);
        return $courses;
    }

    public function getMyCoursesPagination($request, $order = 'id', $sort = 'asc')
    {
        $client = $request->user('api-client');

        $paginate = $request->paginate_number ? $request->paginate_number : 10;

        $query = $client->courses()->where('courses.status', 1)->where(function ($q) use ($request) {

                if ($request->id):
                    $q->where('course_id', $request->id);
                else:
                    if ($request->search):

                        $q->whereHas('translations', function ($q) use ($request) {
                            $q->where('title', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('description', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('note', 'LIKE', '%' . $request->search . '%');
                        });

                    endif;

                    if ($request->doctor_id):
                        $q->where('courses.doctor_id', $request->doctor_id);
                    endif;

                    if ($request->category_id):
                        $q->where('courses.category_id', $request->category_id);
                    endif;

                    if ($request->status && in_array($request->status, ClientCourse::$status)):
                        $q->where('client_course.status', $request->status);
                    endif;

                endif;


            })->orderBy($order, $sort);

        if ($request->complete_status) {

            switch ($request->complete_status) {
                case 'not_complete':
                    $courses = $query->paginate($paginate)->where('videos_count', '>', 'complete_status_count');
                    break;
                default:
                    $courses = $query->paginate($paginate)->where('videos_count', '=', 'complete_status_count');
                    break;
            }
        } else {

            $courses = $query->paginate($paginate);
        }
        return $courses;
    }

    public function LastViewedCource(Request $request){

        $client = $request->user('api-client');

        if($client->lessonCompletes()->latest()->first()
            && $client->lessonCompletes()->latest()->first()->chapter
            && $client->lessonCompletes()->latest()->first()->chapter->course)
        {
            return $client->lessonCompletes()->latest()->first()->chapter->course;
        }else{
            return false;
        }
    }

    public function request(Request $request, $course)
    {

        $user = $request->user('api-client');
        DB::beginTransaction();

        try {

            if ($user->requests()->where('course_id', $course->id)->count())
                return ['status' => 0, 'message' => 'you are already booked this course'];

            $user->requests()->create([
                'price' => $course->price,
                'offer_price' => $course->offer_price,
                'is_offered' => $course->is_offered,
                'course_id' => $course->id,
            ]);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            throw $e;
        }
    }

}

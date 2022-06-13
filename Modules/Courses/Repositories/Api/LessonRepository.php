<?php

namespace Modules\Courses\Repositories\Api;

use Modules\Courses\Entities\Lesson;

class LessonRepository
{
    private $lesson;

    function __construct(Lesson $lesson)
    {
        $this->lesson = $lesson;
    }

    public function getAll($order = 'id', $sort = 'asc')
    {
        $lessons = $this->lesson->Active()->orderBy($order, $sort)->get();
        return $lessons;
    }

    public function getPagination($request, $order = 'order', $sort = 'asc')
    {
        $paginate = $request->paginate_number ? $request->paginate_number : 10;
        $courses = $this->lesson->Active()->where(function ($q) use ($request) {

            if ($request->id):
                $q->where('id', $request->id);
            else:

                if ($request->chapter_id):
                    $q->whereHas('chapter' ,function ($q) use($request){
                        $q->where('id' , $request->chapter_id)->Active();
                    });
                endif;

            endif;
        })->orderBy($order, $sort)->paginate($paginate);
        return $courses;
    }

    public function findById($id)
    {
        $lesson = $this->lesson->Active()->find($id);
        return $lesson;
    }

    public function findVideoById($id)
    {
        $lesson = $this->lesson->lesson()->find($id);
        return $lesson;
    }
}

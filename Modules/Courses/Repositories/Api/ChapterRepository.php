<?php

namespace Modules\Courses\Repositories\Api;

use Illuminate\Http\Request;
use Modules\Courses\Entities\Chapter;
use Illuminate\Support\Facades\DB;

class ChapterRepository
{
    private $chapter;

    function __construct(Chapter $chapter)
    {
        $this->chapter = $chapter;
    }

    public function getAll($order = 'id', $sort = 'asc')
    {
        $chapters = $this->chapter->orderBy($order, $sort)->get();
        return $chapters;
    }

    public function getPagination($request, $order = 'order', $sort = 'asc')
    {
        $paginate = $request->paginate_number ? $request->paginate_number : 10;
        $courses = $this->chapter->Active()->where(function ($q) use ($request) {

            if ($request->id):
                $q->where('id', $request->id);
            else:

                if ($request->course_id):
                    $q->where('course_id' , $request->course_id);
                endif;

            endif;
        })->orderBy($order, $sort)->paginate($paginate);
        return $courses;
    }

    public function findById($id)
    {
        $chapter = $this->chapter->Active()->find($id);
        return $chapter;
    }
}

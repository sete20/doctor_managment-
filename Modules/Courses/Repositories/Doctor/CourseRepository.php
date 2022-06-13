<?php

namespace Modules\Courses\Repositories\Doctor;

use Helper\NotificationHelper;
use Illuminate\Http\Request;
use Modules\Courses\Entities\Course;
use DB;
use Modules\Users\Entities\Client;

class CourseRepository
{
    private $course;

    function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $courses = $this->course->DoctorScope()->orderBy($order, $sort)->get();
        return $courses;
    }

    public function countCategories($order = 'id', $sort = 'desc')
    {
        $courses = $this->course->DoctorScope()->orderBy($order, $sort)->count();
        return $courses;
    }

    public function mainCategories($order = 'id', $sort = 'desc')
    {
        $courses = $this->course->DoctorScope()->mainCategories()->orderBy($order, $sort)->get();
        return $courses;
    }

    public function findById($id)
    {
        $course = $this->course->DoctorScope()->withDeleted()->find($id);
        return $course;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->merge([
                'status' => $request->status == 'on' ? 1 : 0,
                'is_offered' => $request->is_offered == 'on' ? 1 : 0,
                'doctor_id' => auth('doctor')->user()->id,
            ]);
            $course = $this->course->DoctorScope()->create($request->except('title','description','note'));


            if ($request->file('image')) {
                $course->addMediaFromRequest('image')->toMediaCollection('images');
            }

            $this->translateTable($course, $request);

            DB::commit();

            NotificationHelper::sendNotification($course ,
                Client::pluck('id')->toArray(),'clients',
                __('app::dashboard.notifications.new_course_title'),
                (__('app::dashboard.notifications.new_course_body') . $course->translate(locale())->title));

            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $course = $this->findById($id);
        $request->restore ? $this->restoreSoftDelete($course) : null;

        try {
            $request->merge([
                'status' => $request->status == 'on' ? 1 : 0,
                'is_offered' => $request->is_offered == 'on' ? 1 : 0,
            ]);
            $course->update($request->except('title','description','note'));


            if ($request->file('image')) {
                $course->clearMediaCollection('images');
                $course->addMediaFromRequest('image')->toMediaCollection('images');
            }

            $this->translateTable($course, $request);
            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelete($model)
    {
        $model->restore();
    }

    public function translateTable($model, $request)
    {
        foreach ($request['title'] as $locale => $value) {

            $model->translateOrNew($locale)->title = $value;
            $model->translateOrNew($locale)->description = !empty($request['description']) ? $request['description'][$locale] : null;
            $model->translateOrNew($locale)->note = !empty($request['note']) ? $request['note'][$locale] : null;
        }

        $model->save();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {

            $model = $this->findById($id);

            if ($model->trashed()):
                $model->forceDelete();
            else:
                $model->delete();
            endif;

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {

            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function QueryTable($request)
    {
        $query = $this->course->DoctorScope()->with(['translations'])->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('translations', function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->input('search.value') . '%')
                        ->orWhere('description', 'like', '%' . $request->input('search.value') . '%')
                        ->orWhere('note', 'like', '%' . $request->input('search.value') . '%');
                });
            });
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Categories by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '')
            $query->whereDate('created_at', '>=', $request['req']['from']);

        if (isset($request['req']['to']) && $request['req']['to'] != '')
            $query->whereDate('created_at', '<=', $request['req']['to']);

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'only')
            $query->onlyDeleted();

        if (isset($request['req']['deleted']) && $request['req']['deleted'] == 'with')
            $query->withDeleted();

        if (isset($request['req']['status']) && $request['req']['status'] == '1')
            $query->active();

        if (isset($request['req']['status']) && $request['req']['status'] == '0')
            $query->unactive();

        return $query;
    }

}

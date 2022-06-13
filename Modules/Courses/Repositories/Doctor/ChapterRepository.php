<?php

namespace Modules\Courses\Repositories\Doctor;

use Helper\NotificationHelper;
use Illuminate\Http\Request;
use Modules\Core\Traits\Dashboard\HandleStatusAndFile;
use Modules\Courses\Entities\Chapter;
use DB;
use Modules\Users\Entities\Client;

class ChapterRepository
{
    use HandleStatusAndFile;
    private $chapter;

    function __construct(Chapter $chapter)
    {
        $this->chapter = $chapter;
        $this->fileAttribute = ['resources' => 'resources'];
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $chapters = $this->chapter->Doctor()->orderBy($order, $sort)->get();
        return $chapters;
    }

    public function findById($id)
    {
        $chapter = $this->chapter->Doctor()->withDeleted()->find($id);
        return $chapter;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->merge([
                'status' => $request->status == 'on' ? 1 : 0,
                'order' => $request->order ? $request->order : ($this->chapter->Doctor()->count() + 1),
            ]);
            $chapter = $this->chapter->Doctor()->create($request->except('title'));

            $this->handleFileAttributeInRequest($chapter, $request, true);
            $this->translateTable($chapter, $request);

            DB::commit();

            if ($chapter->course->acceptedRequests()->count())
                NotificationHelper::sendNotification($chapter,
                    $chapter->course->acceptedRequests()->pluck('client_id')->toArray(), 'clients',
                    __('app::dashboard.notifications.new_chapter_title'),
                    __('app::dashboard.notifications.new_chapter_body_for_course') . optional($chapter->course)->translate(locale())->title);

            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $chapter = $this->findById($id);
        $request->restore ? $this->restoreSoftDelete($chapter) : null;

        try {
            $request->merge([
                'status' => $request->status == 'on' ? 1 : 0,
            ]);
            $chapter->update($request->except('title'));
            $this->handleFileAttributeInRequest($chapter, $request);
            $this->translateTable($chapter, $request);
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
        $query = $this->chapter->Doctor()->with(['translations'])->where(function ($query) use ($request) {
            $query->where('id', 'like', '%' . $request->input('search.value') . '%');
            $query->orWhere(function ($query) use ($request) {
                $query->whereHas('translations', function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->input('search.value') . '%');
                });
            });
        })->orderBy('order');

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


    public function deleteAttachment($model, $collection, $id)
    {
        \Illuminate\Support\Facades\DB::beginTransaction();

        try {

            $model = $this->findById($model);
            $media = $model->getMedia($collection);
            $media->find($id)->delete();

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}

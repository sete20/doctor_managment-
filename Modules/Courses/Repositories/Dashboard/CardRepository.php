<?php

namespace Modules\Courses\Repositories\Dashboard;

use Illuminate\Http\Request;
use Modules\Courses\Entities\Lesson;
use DB;

class CardRepository
{
    private $card;

    function __construct(Lesson $card)
    {
        $this->card = $card;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $cards = $this->card->Doctor()->orderBy($order, $sort)->get();
        return $cards;
    }

    public function findById($id)
    {
        $card = $this->card->Doctor()->card()->withDeleted()->findOrFail($id);
        return $card;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->merge([
                'status' => $request->status ? 1 : 0,
                'type' => 'card',
                'order' => $request->order ? $request->order : ($this->card->Doctor()->count() + 1),
            ]);
            $card = $this->card->Doctor()->create($request->except('title','description','attachment'));


            if ($request->file('attachment')) {
                $card->addMediaFromRequest('attachment')->toMediaCollection('attachments');
            }
            $this->translateTable($card, $request);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $card = $this->findById($id);
        $request->restore ? $this->restoreSoftDelete($card) : null;

        try {
            $request->merge([
                'status' => $request->status ? 1 : 0,
            ]);
            $card->update($request->except('title','description','attachment'));

            if ($request->file('attachment')) {
                $card->clearMediaCollection('attachment');
                $card->addMediaFromRequest('attachment')->toMediaCollection('attachments');
            }

            $this->translateTable($card, $request);
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
            $model->translateOrNew($locale)->description = isset($request['description'][$locale]) ? $request['description'][$locale] : null;
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
        $query = $this->card->Doctor()->with(['translations'])->where(function ($query) use ($request) {
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

}

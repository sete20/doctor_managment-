<?php

namespace Modules\Doctors\Repositories\Dashboard;

use Illuminate\Support\Facades\Hash;
use Modules\Doctors\Entities\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorRepository
{
    private $doctor;

    function __construct(Doctor $doctor)
    {
        $this->doctor = $doctor;
    }

    public function getAll($order = 'id', $sort = 'desc')
    {
        $doctor = $this->doctor->orderBy($order, $sort)->get();
        return $doctor;
    }

    public function countServices($order = 'id', $sort = 'desc')
    {
        $doctor = $this->doctor->orderBy($order, $sort)->count();
        return $doctor;
    }

    public function findById($id)
    {
        $doctor = $this->doctor->withDeleted()->find($id);
        return $doctor;
    }

    public function create($request)
    {
        DB::beginTransaction();

        try {

            $doctor = $this->doctor->create([
                'status' => $request->status ? 1 : 0,
                'name' => $request->name,
                'email' => $request->email,
                'image' => $request->image ? path_without_domain($request->image) : null,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();

        $doctor = $this->findById($id);
        $request->restore ? $this->restoreSoftDelete($doctor) : null;

        try {
            $request->merge([
                'status' => $request->status ? 1 : 0,
                'image' => $request->image ? path_without_domain($request->image) : null,
                'password' => $request->password ? Hash::make($request->password) : $doctor->password,
            ]);
            $doctor->update($request->all());

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
        $query = $this->doctor->where(function ($query) use ($request) {

            if ($request->input('search.value')) :

                $query->where('id', 'like', '%' . $request->input('search.value') . '%')
                ->orWhere('name', 'like', '%' . $request->input('search.value') . '%');

            endif;
        });

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    public function filterDataTable($query, $request)
    {
        // Search Services by Created Dates
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

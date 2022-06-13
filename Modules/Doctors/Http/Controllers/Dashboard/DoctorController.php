<?php

namespace Modules\Doctors\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Core\Traits\DataTable;
use Illuminate\Routing\Controller;
use Modules\Doctors\Http\Requests\Dashboard\DoctorRequest;
use Modules\Doctors\Transformers\Dashboard\DoctorResource;
use Modules\Doctors\Entities\Doctor as Model;
use Modules\Doctors\Repositories\Dashboard\DoctorRepository as Doctor;

class DoctorController extends Controller
{
    private $doctor_repo;
    private $model;

    function __construct(Model $model , Doctor $doctor_repo)
    {
        $this->doctor_repo = $doctor_repo;
        $this->model = $model;
    }

    public function index()
    {
        return view('doctors::dashboard.doctors.index');
    }

    public function datatable(Request $request)
    {
        $datatable = DataTable::drawTable($request, $this->doctor_repo->QueryTable($request));

        $datatable['data'] = DoctorResource::collection($datatable['data']);

        return Response()->json($datatable);
    }

    public function create()
    {
        $model = $this->model;
        return view('doctors::dashboard.doctors.create' , compact('model'));
    }

    public function store(DoctorRequest $request)
    {
        try {
            $create = $this->doctor_repo->create($request);

            if ($create) {
                return Response()->json([true , __('app::dashboard.messages.created')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function show($id)
    {
        return view('doctors::dashboard.doctors.show');
    }

    public function edit($id)
    {
        $model = $this->doctor_repo->findById($id);
        return view('doctors::dashboard.doctors.edit',compact('model'));
    }

    public function update(DoctorRequest $request, $id)
    {
        try {
            $update = $this->doctor_repo->update($request,$id);

            if ($update) {
                return Response()->json([true , __('app::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->doctor_repo->delete($id);

            if ($delete) {
                return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $deleteSelected = $this->doctor_repo->deleteSelected($request);

            if ($deleteSelected) {
                return Response()->json([true , __('app::dashboard.messages.deleted')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}

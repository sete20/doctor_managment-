<?php

namespace Modules\Doctors\Http\Controllers\Api;

use Helper\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Doctors\Transformers\Api\DoctorResource;
use Modules\Doctors\Entities\Doctor as Model;
use Modules\Doctors\Repositories\Api\DoctorRepository as Doctor;

class DoctorController extends Controller
{
    private $doctor_repo;
    private $model;

    function __construct(Model $model, Doctor $doctor_repo)
    {
        $this->doctor_repo = $doctor_repo;
        $this->model = $model;
    }

    public function index(Request $request)
    {
        $records = $this->doctor_repo->getAll($request);
        return Response::responseJson(1,'data loaded' , DoctorResource::collection($records));
    }

}

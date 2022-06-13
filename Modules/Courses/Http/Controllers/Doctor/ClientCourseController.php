<?php

namespace Modules\Courses\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;

class ClientCourseController extends Controller
{
    use CrudDashboardController;

    public function edit($id)
    {
        $model = $this->repository->findById($id);
        $model->status = 'accepted';
        $model->save();
        session()->flash('success' , 'تم القبول بنجاح');
        return back();
    }
}

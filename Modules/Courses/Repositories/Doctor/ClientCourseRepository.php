<?php

namespace Modules\Courses\Repositories\Doctor;

use Modules\Core\Repositories\Dashboard\CrudRepository;

class ClientCourseRepository extends CrudRepository
{
    public function appendFilter(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        $query->where('status' , 'pending');
        return parent::appendFilter($query, $request);
    }
}

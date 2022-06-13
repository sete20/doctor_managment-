<?php

namespace Modules\Log\Repositories\Dashboard;

use DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Log\Entities\Activity;

class LogRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Activity::class);
    }
}

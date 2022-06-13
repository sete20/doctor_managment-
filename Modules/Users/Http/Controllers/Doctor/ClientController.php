<?php

namespace Modules\Users\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Users\Entities\Client;
use Modules\Users\Repositories\Doctor\ClientRepository;
use Modules\Users\Transformers\Dashboard\ClientResource;

class ClientController extends Controller
{
    use CrudDashboardController{
        __construct as private CrudConstruct;
    }

    function __construct()
    {
        $this->CrudConstruct();
        $this->setViewPath('users::doctor.clients');
        $this->setModel(Client::class);
        $this->setRepository(ClientRepository::class);
        $this->model_resource = ClientResource::class;
    }
}

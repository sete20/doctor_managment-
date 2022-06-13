<?php

namespace Modules\Users\Repositories\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Users\Entities\Client;

class ClientRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Client::class);
    }

    public function getModel()
    {
        return $this->model->Doctor();
    }

    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        if ($is_create){
            $data['password'] = Hash::make($request->password);
        }else{
            if($request->password){
                $data['password'] = Hash::make($request->password);
            }else{
                unset($data['password']);
            }
        }

        return parent::prepareData($data, $request, $is_create);
    }

    public function modelCreated($model, $request, $is_created = true): void
    {
        if ($is_created) {
            $model->activation = 'active';
            $model->save();
        }

        parent::modelCreated($model, $request, $is_created);
    }
}

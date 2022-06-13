<?php

namespace Modules\Courses\Http\Controllers\Doctor;

use Illuminate\Routing\Controller;
use Modules\Courses\Entities\Lesson as Card;
use Modules\Courses\Http\Requests\Doctor\CardRequest;
use Modules\Courses\Repositories\Doctor\CardRepository;

class CardController extends Controller
{
    private $card;
    private $model;

    function __construct(CardRepository $card , Card $model)
    {
        $this->card = $card;
        $this->model = $model;
    }

    public function create()
    {
        $model = $this->model;
        return view('courses::doctor.contents.cards.create' , compact('model'));
    }

    public function store(CardRequest $request)
    {
        try {
            $create = $this->card->create($request);

            if ($create) {
                return Response()->json([true , __('app::dashboard.messages.created')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function edit($id)
    {
        $model = $this->card->findById($id);
        return view('courses::doctor.contents.cards.edit',compact('model'));
    }

    public function update(CardRequest $request, $id)
    {
        try {
            $update = $this->card->update($request,$id);

            if ($update) {
                return Response()->json([true , __('app::dashboard.messages.updated')]);
            }

            return Response()->json([false  , __('app::dashboard.messages.failed')]);
        } catch (\PDOException $e) {
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}

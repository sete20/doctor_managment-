<?php

namespace Traits;

trait Master
{
    public $model;
    public $viewsDomain;
    public $viewsUrl;

    /**
     * @param $view
     * @param array $params
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($view, $params = [])
    {
        return view($this->viewsDomain . $view, $params);
    }

    public function returnError($data)
    {
        return response()->json([

            'status' => 0,
            'error' => true,
            'errors' => $data->errors(),
            'code' => 400
        ]);
    }

    public function returnSuccess()
    {
        return response()->json([
            'status' => 1,
            'success' => true,
            'url' => url($this->viewsUrl)
        ]);
    }
}
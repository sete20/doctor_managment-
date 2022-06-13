<?php

namespace Api\Client;

use Api\Client\Home\HomeModel;
use App\Http\Controllers\Controller;
use Modules\Users\Entities\Client;
use App\Models\Home;
use Helper\Helper;
use Helper\Response;
use Helper\Translation;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public $helper;
    public $guard;
    public $model;
    public $name_space = 'Api';

    public function __construct()
    {
        $this->helper = new Helper();
        $this->guard = 'customer';
        $this->model = new Client();
    }
    public function home(Request $request)
    {
        $rules =
            [
                'type' => 'required|in:'. implode(',',(new Home())->contents),
                'response_type' => 'nullable|in:pagination,all,singleRecord',
                'pagination_number' => 'nullable|numeric|min:1',
                'record_id' => 'required_if:response_type,singleRecord',
                'records_number' => 'nullable|min:1',
                'category_id' => 'required_if:type,sub_categories|exists:categories,id',
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return Response::responseJson(0, $data->errors()->first(), $data->errors());
        }

        $request->merge([
            'response_type' => $request->response_type ? $request->response_type : 'pagination',
            'pagination_number' => $request->pagination_number ? $request->pagination_number : 10,
        ]);

        $className = $this->name_space .'\Home\\' . ucfirst($request->type);

        $model = new $className();

        $return = new HomeModel($model, $request);

        return $return->Home();
    }



    public function contactUs(Request $request)
    {
        $rules =
            [
                'name' => !auth($this->guard)->check() ? 'required|max:70' : '',
                'phone' => !auth($this->guard)->check() ? 'required|regex:/(01)[0-9]{9}/' : '',
                'email' => !auth($this->guard)->check() ? 'required|email' : '',
                'contact' => 'required',
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return Response::responseJson(0, $data->errors()->first(), $data->errors());
        }

        auth($this->guard)->check() ? $request->user($this->guard)->contacts()->create(['contact' => $request->contact])
            : Contact::create($request->all());

        return Response::responseJson(1, Translation::trans('your contact is send successful'));
    }

}

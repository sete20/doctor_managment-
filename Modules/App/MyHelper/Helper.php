<?php


namespace Helper;

use App\Settings;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Setting;
use App\Models\Token;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class Helper
{

    public $error = ['error' => true, 'status' => 400];
    public $success = ['success' => true, 'status' => 200];
    public $status = ['error' => 400, 'success' => 200];

    protected $responseTo;

    public function __construct($responseTo = 'api')
    {
        $this->responseTo = $responseTo;
    }

    //////////////////////////////////////////////////////////////////////
    ///

    public function getResponseTo()
    {
        echo $this->responseTo;
    }


    /**
     * @param $input
     * @return mixed
     */
    static function convertEnglishNumbersToPersian($input)
    {
        $persian = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩','ص','م'];
        $english = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9,'AM','PM'];
        return str_replace($persian, $english, $input);
    }


    /**
     * @param $input
     * @return mixed
     */
    static function pluckArrayKey($array)
    {
        $return_array = [];

        foreach ($array as $key => $value)
        {
            array_push($return_array , $key);
        }

        return $return_array;
    }

    /**
     * @param $key
     * @param $array
     * @param $value
     * @return mixed
     */
    static function inArray($key, $array, $value)
    {
        $return = array_key_exists($key, $array) ? $array[$key] : $value;
        return $return;
    }

    static function responseJson($status, $message, $data = null)
    {

        if ($data == null) {
            $response =
                [
                    'status' => $status,
                    'message' => $message
                ];
        } else {
            $response =
                [
                    'status' => $status,
                    'message' => $message,
                    'data' => $data
                ];
        }

        return response()->json($response);
    }

    /**
     * @param $model
     * @param  $totalCount
     * @return array
     */
    public function ratePresent($model, $totalCount): array
    {
        $array = [];

        for ($i = 1; $i <= 5; $i++) {
            $array += [$i => (int)($model->reviews()->where('rate', $i)->count() ? ($model->reviews()->where('rate', $i)->count() / $totalCount) * 100 : 0)];
        }

        return $array;
    }

    public function switchResponseJson($status = 'success', $message = null, $data = [])
    {
        $responseData = $this->$status;
        $responseData += ['message' => $message, 'data' => $data];
        $status_code = $this->status[$status];

        if ($this->responseTo == 'web') {

            return response()->json($responseData, $status_code);
        }

        $response =
            [
                'code' => $status_code,
                'status' => $status == 'success' ? 1 : 0,
                'massage' => $message,
                'data' => $data
            ];

        return response()->json($response);
    }

    /**
     * @param $lat
     * @param $lon
     * @return  mixed
     */
    public function getLocation($lat, $lon)
    {
        $select = '*, ( 6367 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * 
                    cos( radians( longitude ) - radians(' . $lon . ') ) + sin( radians(' . $lat . ') ) 
                    * sin( radians( latitude ) ) ) ) AS distance';
        return $select;
    }

    /**
     * @param $key
     * @param string $value
     * @return string
     */
    public static function settingValue($key)
    {
        $value = Settings::first()->$key;
        return $value;
    }
    /**
     * @param $key
     * @param string $value
     * @return string
     */
    public static function settingValueV2($key, $value = '')
    {
        $value = Setting::where('key', $key)->first() ? Setting::where('key', $key)->first()->value : $value;
        return $value;
    }

///
//////////////////////////////////////////////////////////////////////

    static function generateCode($tableModel, $record, $rowName = 'code', $char_number = 30)
    {
        $code = Str::random($char_number);

        $test_record = $tableModel->where($rowName, $code)->first();

        if ($test_record) {
            self::generateCode($tableModel, $record, $rowName);
        } else {
            return $code;
        }
    }

    static function generateSlug($model, $from, $id = null, $separator = '-')
    {
        $slug = '';

        foreach ($from as $word) {
            $slug .= str_replace(' ', $separator, $word) . $separator;
        }

        $record = $model->where('slug', 'LIKE', $slug . '%')->where('id', '!=', $id)->latest('updated_at')->first();

        if ($record) {

            $number = intval(str_replace($slug, '', $record->slug)) + 1;
            return $slug . $number;
        } else {
            if ($id == null || $model->find($id)->slug == null) {
                return $slug . 1;
            }

            return $model->find($id)->slug;
        }

    }

    static function generateChar()
    {
        $array = [Str::random(1), rand(0, 9)];
        return $array[rand(0, 1)];
    }



//////////////////////////////////////////////////////////////////////
///
    static function ResetPassword($model, $password)
    {
        $model->password = Hash::make($password);
        $model->save();
        return true;
    }

    static function readNotification($notification_id, $user_id, $relation = 'users')
    {
        $notification = Notification::find($notification_id);

        if ($notification) {
            $notification->$relation()->updateExistingPivot($user_id, ['is_read' => 1]);
        }

    }


    static function removeToken($token)
    {
        Token::where('token', $token)->delete();
    }

    static function is_read($model)
    {
        if ($model->is_read == 0) {
            $model->is_read = 1;
            $model->save();
            return true;
        } else {
            return false;
        }
    }


    static function convertDateTime($dateTime)
    {
        $date = Carbon::parse($dateTime)->toDateTimeString();

        return $date;
    }

    static function convertDateTimeNotString($dateTime)
    {
        $date = Carbon::parse($dateTime);

        return $date;
    }

    static function toggleBoolean($model, $name = 'is_active', $open = 1, $close = 0)
    {
        if ($model->$name == $open) {
            $model->$name = $close;
            $model->save();

        } elseif ($model->$name == $close) {
            $model->$name = $open;
            $model->save();
        } else {
            return false;
        }

        return true;
    }


    static function toggleBooleanView($model, $url, $switch = 'is_active', $open = 1, $close = 0)
    {
        return view('form-fields.toggle-boolean-view', compact('model', 'url', 'switch', 'open', 'close'))->render();
    }

    static function ratStars($gold_stars, $style = '', $class = 'label-primary')
    {
        $style .= 'color : gold !important;';
        $empty_star = '<span> <i class="fa fa-star-o"></i> </span>';
        $gold_star = '<span> <i class="fa fa-star"></i> </span>';
        $half_star = '<span> <i class="fa fa-star-half-o" style="transform: rotateY(180deg);"></i> </span>';
        $html = '<label class="' . $class . '" style="' . $style . '">';

        for ($i = 1; $i <= 5; $i++) {
            if ($gold_stars > 0 && $gold_stars >= 1) {
                $html .= $gold_star;
                $gold_stars--;

            } elseif ($gold_stars > 0 && $gold_stars < 1) {
                $html .= $half_star;
                $gold_stars--;

            } elseif ($gold_stars <= 0) {
                $html .= $empty_star;
            }
        }
        $html .= '</label>';
        return $html;
    }

    static function frontRate($gold_stars)
    {
        $empty_star = '☆';
        $gold_star = '★';
        $html = '';

        for ($i = 1; $i <= 5; $i++) {
            if ($gold_stars > 0 && $gold_stars >= 1) {
                $html .= $gold_star;
                $gold_stars--;

            } elseif ($gold_stars <= 0) {
                $html .= $empty_star;
            }
        }
        $html .= '';
        return $html;
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit = 'm')
    {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            $k = ($miles * 1.609344) * 1.2;
            $distance = $k * 1000;
//            switch ($unit)
//            {
//                case 'k' :
//                    //احنا ضربنا في معامل عشان نقترب من المسافة الحقيقية
//                    $distance = ($miles * 1.609344) * 1.2;
//                    break;
//                case 'm':
//                    //احنا ضربنا في معامل عشان نقترب من المسافة الحقيقية
//                    $k = ($miles * 1.609344) * 1.2;
//                    $distance = $k * 1000;
//                    break;
//                case 'N':
//                    $distance = ($miles * 0.8684);
//                    break;
//                default:
//                    $distance = $miles;
//                    break;
//            }

            return $distance;
        }
    }
}

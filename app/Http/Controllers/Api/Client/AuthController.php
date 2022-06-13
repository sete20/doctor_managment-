<?php

namespace Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Mail\SendPinCode;
use Modules\Users\Entities\Client;
use Illuminate\Support\Carbon;
use \Illuminate\Support\Facades\Hash;
use Helper\Response;
use Helper\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class AuthController extends Controller
{

    /**
     * @return int
     */
    public function getPinCode()
    {
        return rand(1000 , 9999);
    }

    /**
     * @return string
     */
    public function getPinCodeExpiredDate()
    {
        return Carbon::now()->addMinutes(5);
    }

    /**
     * @return string
     */
    public function checkPinCodeExpiredDate($expired_date)
    {
        $check = Carbon::now() > $expired_date ? false : true;
        return $check;
    }

    public function sendPinCode(Request $request, $model = null)
    {
        if (!$model) {

            $rules =
                [
                    'email' => 'required|exists:clients,email',
                ];


            $data = validator()->make($request->all(), $rules);

            if ($data->fails()) {

                return Response::responseJson(0, $data->errors()->first(), $data->errors());
            }

            $model = Client::where(['email' => $request->email])->first();

            if (!$model) {

                return Response::responseJson(0, Translation::trans('The email is incorrect'));

            }elseif ($model->activation == 'deactivate') {

                return Response::responseJson(0, Translation::trans('You have been banned from use. You can contact the administration'));
            }

        }

        $pin_code = $this->getPinCode();
        $model->pin_code = $pin_code;

        try{
            Mail::to($model->email)->send(new SendPinCode($model));

        }catch (\Exception $e){

        }

        $model->pin_code_date_expired = $this->getPinCodeExpiredDate();
        $model->save();

        return Response::responseJson(1, Translation::trans('pin code is send successful'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $rules =
            [
                'email' => 'required|exists:clients,email',
                'password' => 'required|min:6',
                'token' => 'required',
                'serial_number' => 'required',
                'os' => 'required|in:android,ios',
            ];


        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return Response::responseJson(0, $data->errors()->first(), $data->errors());
        }

        $client = Client::where(['email' => $request->email])->first();

        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                // check user confirmation and activation
                ///
                if ($client->activation == 'pending') {
                    return Response::responseJson(2, Translation::trans('please confirm your account first'));
                } elseif ($client->activation == 'deactivate') {
                    return Response::responseJson(0, Translation::trans('You have been banned from use. You can contact the administration'));
                }

                ///
                ///////////////////
                //create token
                return $this->createToken($request , $client);

            } else {

                return Response::responseJson(0, Translation::trans('The email is incorrect'));
            }

        }

        return Response::responseJson(0, Translation::trans('The email is incorrect'));

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules =
            [
                'name' => 'required|max:70',
                'university' => 'required|max:70',
                'college' => 'required|max:70',
                'email' => 'required|email|unique:clients,email',
                'phone' => 'required|unique:clients,phone|regex:/(01)[0-9]{9}/',
                'password' => 'required|confirmed|min:6',
            ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {

            return Response::responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $record = Client::create($request->all());
        $record->password = Hash::make($request->password);
        $record->save();

        return $this->sendPinCode($request,$record);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeAccount(Request $request)
    {
        $rules =
            [
                'email' => 'required|exists:clients,email',
                'pin_code' => 'required|numeric',
                'token' => 'required',
                'serial_number' => 'required',
                'os' => 'required|in:android,ios',
            ];


        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return Response::responseJson(0, $data->errors()->first(), $data->errors());
        }

        $record = Client::where(['email' => $request->email])->first();

        if ($record) {

            if ($record->activation == 'active') {

                return Response::responseJson(0, Translation::trans('The account was previously activated'));

            } elseif ($record->activation == 'deactivate') {

                return Response::responseJson(0, Translation::trans('You have been banned from use. You can contact the administration'));
            }

            if ($record->pin_code == $request->pin_code) {

                //check pin code date time expired
                if ($this->checkPinCodeExpiredDate($record->pin_code_date_expired)) {

                    $record->pin_code = $this->getPinCode();
                    $record->pin_code_date_expired = null;
                    $record->activation = 'active';
                    $record->save();

                    return $this->createToken($request, $record);
                }

                return Response::responseJson(0, Translation::trans('The pin code has expired, try again'));
            }

            return Response::responseJson(0, Translation::trans('The pin code is incorrect'));
        }
        return Response::responseJson(0, Translation::trans('The email is incorrect'));
    }

    public function resetPasswordOutAuth(Request $request)
    {
        $rules =
            [
                'email' => 'required|email|exists:clients,email',
                'pin_code' => 'required|numeric',
                'password' => 'required|confirmed|min:6',
            ];


        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return Response::responseJson(0, $data->errors()->first(), $data->errors());
        }

        $record = Client::where(['activation' => 'active', 'email' => $request->email])->first();

        if ($record) {
            if ($record->pin_code == $request->pin_code) {

                //check pin code date time expired
                if ($this->checkPinCodeExpiredDate($record->pin_code_date_expired)) {

                    $record->pin_code = $this->getPinCode();
                    $record->password = Hash::make($request->password);
                    $record->save();

                    return Response::responseJson(1, Translation::trans('success'));
                }

                return Response::responseJson(0, Translation::trans('The pin code has expired, try again'));
            }

            return Response::responseJson(0, Translation::trans('The pin code is incorrect'));
        }
        return Response::responseJson(0, Translation::trans('The email is incorrect'));

    }

    public function resetPasswordInAuth(Request $request)
    {
        $rules =
            [
                'old_password' => 'required|min:6',
                'password' => 'required|confirmed|min:6',
            ];

        $data = validator()->make($request->all(), $rules);

        if ($data->fails()) {

            return Response::responseJson(0, $data->errors()->first(), $data->errors());
        }

        $record = $request->user('api-client');

        if (Hash::check($request->old_password, $record->password)) {

            $record->password = Hash::make($request->password);
            $record->save();

            return Response::responseJson(1, Translation::trans('success'));

        } else {

            return Response::responseJson(0, Translation::trans('The old password is incorrect'));
        }

    }

    public function resetPassword(Request $request)
    {
        return auth('api-client')->check() ? $this->resetPasswordInAuth($request) : $this->resetPasswordOutAuth($request);
    }


    public function showProfile(Request $request)
    {
        $user = $request->user();
        
        
        
        return Response::responseJson(1, Translation::trans('success'), ['token' => $request->bearerToken(), 'user' => new ClientResource($user)]);

    }


    public function screenShotReport(Request $request)
    {
        $user = $request->user();
        $user->screen_shot_num = $user->screen_shot_num + 1;
        $user->save();
        return Response::responseJson(1, Translation::trans('success'));
    }


    public function updateProfile(Request $request)
    {
        $record = $request->user();

        $rules =
            [
                'name' => 'nullable|max:70',
                'phone' => 'nullable|unique:clients,phone,' . $record->id . '|regex:/(01)[0-9]{9}/',
                'photo' => 'nullable|image',
            ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {

            return Response::responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $record->update([
            'name' => $request->name ?? $record->name,
            'phone' => $request->phone ?? $record->phone,
        ]);

        if ($request->hasFile('photo')) {
            $record->clearMediaCollection('images');
            $record->addMediaFromRequest('photo')->toMediaCollection('images');
        }

        return Response::responseJson(1, Translation::trans('success'),new ClientResource($record));
   }

    public function logout(Request $request)
    {
        $request->user()->token()->update(['token' => null]);

        return Response::responseJson(1, Translation::trans('you are logout successful'));
    }

    /**
     * @param Request $request
     * @param $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function createToken(Request $request, $client)
    {

        if (!$client->token) {
            $client->token()->create(['token' => $request->token, 'os' => $request->os, 'serial_number' => $request->serial_number]);

        }
//        elseif($client->token->serial_number != $request->serial_number) {
//            return Response::responseJson(0, Translation::trans('you can\'t login with this device'));
//        }
//        else{
//            $client->token()->update([
//                'token' => $request->token,
//            ]);
//        }

        //create passport token
        $token = $client->createToken('android')->accessToken;

        return Response::responseJson(1, Translation::trans('You have signed in successfully'),
            [
                'token' => $token,
                'user' => new ClientResource($client),
            ]);

    }

}

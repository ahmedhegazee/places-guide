<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\Government;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = $this->validateRegister($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();

        return jsonResponse(1, 'تم الاضافة بنجاح', ['api_token' => $client->api_token, 'client' => $client]);
    }
    public function login(Request $request)
    {

        $validator = $this->validateLogin($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        //here we use session driver because attempt works only in it
        $auth = Auth::guard('client')->attempt(['phone' => $request->phone, 'password' => $request->password]);
        if ($auth) {
            $client = Auth::guard('client')->user();
            if (!$client->is_banned) {
                if (is_null($client->api_token)) {
                    $client->api_token = Str::random(60);
                    $client->save();
                }
                return jsonResponse(1, 'تم الدخول بنجاح', ['api_token' => $client->api_token, 'client' => $client]);
            } else
                return jsonResponse(0, 'تم حظر هذا العميل');
        } else {
            $msg = 'بيانات المستخدم غير صحيحة';
            return jsonResponse(0, $msg, [], 401);
        }
    }
    public function validateLogin($data)
    {
        $rules = [
            'password' => 'required|string',
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/'],
        ];
        return validator()->make($data, $rules);
    }
    public function validateRegister($data)
    {
        // regex rule should be in an array.
        // before : means before today and -16 years mean before this year about 16 years
        $rules = [
            'name' => 'required|string|min:5',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|email|unique:clients',
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', 'unique:clients'],
            'dob' => 'required|date|before: -16 years',
            'last_donation_date' => 'required|date|before_or_equal: -1 days',
            'city_id' => ['required', Rule::in(City::all()->pluck('id')->toArray())],
            'blood_type_id' => ['required', Rule::in(BloodType::all()->pluck('id')->toArray())],
        ];
        return validator()->make($data, $rules);
    }
    public function validateUpdateProfile($data, $client)
    {
        // regex rule should be in an array.
        // before : means before today and -16 years mean before this year about 16 years
        $rules = [
            'name' => 'sometimes|string|min:5',
            'password' => 'sometimes|string|min:8|confirmed',
            'email' => ['sometimes', 'email', Rule::unique('clients')->ignore($client->id)],
            'phone' => ['sometimes', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', Rule::unique('clients')->ignore($client->id)],
            'dob' => 'sometimes|date|before: -16 years',
            'last_donation_date' => 'sometimes|date|before_or_equal: -1 days',
            'city_id' => ['sometimes', Rule::in(City::all()->pluck('id')->toArray())],
            'blood_type_id' => ['sometimes', Rule::in(BloodType::all()->pluck('id')->toArray())],
        ];
        return validator()->make($data, $rules);
    }
    public function updateProfele(Request $request)
    {
        // dd($request->all());
        $client = $request->user();
        $validator = $this->validateUpdateProfile($request->all(), $client);
        // $validator = $this->validateRegister($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $client->update($request->all());
        // $client->save();
        return jsonResponse(1, 'تم التحديث بنجاح',  $client);
    }
    public function getFavouriteBloodTypes()
    {
        $client = auth()->guard('client_api')->user();
        return  jsonResponse(1, 'success', $client->bloodTypes);
    }
    public function addFavouriteBloodTypes(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'bloodType' => 'required|array',
            'bloodType.*' => [Rule::in(BloodType::all()->pluck('id')->toArray())]
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $client = $request->user();
        $client->bloodTypes()->sync($request->bloodType);
        return jsonResponse(1, 'تم التحديث بنجاح');
    }
    public function getFavouriteGovernments()
    {
        $client = auth()->guard('client_api')->user();
        return  jsonResponse(1, 'success', $client->governments);
    }
    public function addFavouriteGovernments(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'govern' => 'required|array',
            'govern.*' => [Rule::in(Government::all()->pluck('id')->toArray())]
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $client = $request->user();
        $client->governments()->sync($request->govern);
        return jsonResponse(1, 'تم التحديث بنجاح');
    }
    public function sendResetCode(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', Rule::in(Client::all()->pluck('phone')->toArray())],
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $resetCode = random_int(100000, 999999);
        $client = Client::where('phone', $request->phone)->first();
        $client->pin_code = $resetCode;
        $client->save();
        sendSMS('your reset code is ' . $resetCode, '+2' . $client->phone);
        return jsonResponse(1, 'تم ارسال الكود بنجاح');
    }
    public function resetPassword(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', Rule::in(Client::all()->pluck('phone')->toArray())],
            'code' => 'required|string|min:6|max:6',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $client = Client::where('phone', $request->phone)->first();
        if ($client->pin_code == $request->code) {
            $client->update(['pin_code' => '000000', 'password' => bcrypt($request->password)]);
            return jsonResponse(1, 'تم تغيير كلمة المرور بنجاح', ['api_token' => $client->api_token, 'client' => $client]);
        } else {
            return jsonResponse(0, 'الرجاء ادخال الكود الصحيح');
        }
    }
    public function storeToken(Request $request)
    {
        $client = $request->user();
        $validator = validator()->make(request()->all(), [
            'token' => 'required|string',
            'type' => ['required', Rule::in(['ios', 'android'])]
        ]);
        if ($validator->fails())
            return jsonResponse(0, 'errors', $validator->errors());
        Token::where('token', $request->token)->delete();
        $client->tokens()->create($request->all());
        return jsonResponse(1, 'added successfully');
    }
    public function getTokens()
    {
        $client = auth()->guard('client_api')->user();
        return jsonResponse(1, 'tokens', $client->tokens);
    }
    public function removeToken(Request $request)
    {
        $validator = validator()->make(request()->all(), [
            'token' => 'required|string',
        ]);
        if ($validator->fails())
            return jsonResponse(0, 'errors', $validator->errors());
        Token::where('token', $request->token)->delete();
        return jsonResponse(1, 'deleted successfully');
    }
    public function getNotifications()
    {
        return jsonResponse(1, 'الاشعارات', auth()->guard('client_api')->user()->notifications);
    }
}
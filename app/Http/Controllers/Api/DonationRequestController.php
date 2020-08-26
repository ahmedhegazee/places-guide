<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\Client;
use App\Models\DonationRequest;
use App\Models\Government;
use App\Models\Notification;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonationRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = $request->user();
        $validator = $this->validateData($request->all());
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $donationRequest = $client->donationRequests()->create($request->all());
        // here we retrieve all the clients who have a favourite blood type of the same request's blood type
        $donatorsIDs = $donationRequest->city->government->clients()->whereHas('bloodTypes', function ($q) use ($request) {
            $q->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();
        if (count($donatorsIDs)) {
            $notification
                = $donationRequest->notifications()->create([
                    'title' => 'نحتاج لتبرعكم بالدم',
                    'content' => $donationRequest->bloodType->name . ' نحتاج للتبرع لهذه الفصيلة '
                ]);
            $notification->clients()->attach($donatorsIDs);
            $tokens = Token::whereIn('client_id', $donatorsIDs)->where('token', '!=', null)->pluck('token')->toArray();
            // dd($tokens);
            if (count($tokens)) {
                $data = [
                    'donation_request_id' => $donationRequest->id,
                ];
                $send = notifyByFireBase($notification->title, $notification->content, $tokens, $data);
                info('firebase result:' . $send);
                return jsonResponse(1, 'تم ارسال الاشعارات', $donationRequest);
            } else {
                return jsonResponse(0, 'لا يوجد متبرعين متوفرين بهذه الفصيلة', $donationRequest);
            }
        } else {
            return jsonResponse(0, 'لا يوجد متبرعين متوفرين بهذه الفصيلة');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  DonationRequest $donation_request
     * @return \Illuminate\Http\Response
     */
    public function show(DonationRequest $donation_request)
    {
        return jsonResponse(1, 'sucess', $donation_request);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  DonationRequest $donation_request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DonationRequest $donation_request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  DonationRequest $donation_request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DonationRequest $donation_request)
    {
        //
    }
    public function validateData($data)
    {
        $rules = [
            'name' => 'required|string|min:3',
            'age' => 'required|numeric',
            'blood_type_id' => ['required', Rule::in(BloodType::all()->pluck('id')->toArray())],
            'no_blood_bags' => 'required|numeric',
            'address' => [Rule::requiredIf(function () use ($data) {
                return !isset($data['longtitude']) && !isset($data['latitude']);
            }), 'string'],
            'longtitude' => ['numeric', Rule::requiredIf(function () use ($data) {
                return !isset($data['address']);
            })],
            'latitude' => ['numeric', Rule::requiredIf(function () use ($data) {
                return !isset($data['address']);
            })],
            'city_id'
            => ['required', Rule::in(City::all()->pluck('id')->toArray())],
            'government_id'
            => ['required', Rule::in(Government::all()->pluck('id')->toArray())],
            'phone'
            => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/'],
            'notes' => 'sometimes|string'
        ];
        return validator()->make($data, $rules);
    }
}

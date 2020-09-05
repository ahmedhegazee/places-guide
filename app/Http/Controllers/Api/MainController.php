<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\ClientMessage;
use App\Models\Governorate;
use App\Models\Settings;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGovernments()
    {
        $governments = Governorate::all(['id', 'name']);
        return jsonResponse(1, 'success', $governments);
    }
    public function getCities(Request $request)
    {
        $cities = City::govern($request->govern)->get(['name', 'id']);
        return jsonResponse(1, 'success', $cities);
    }
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::cat($request->category)->get(['name', 'id']);
        return jsonResponse(1, 'success', $subCategories);
    }
    public function getCategories()
    {
        $postsCategories = Category::all(['id', 'name']);
        return jsonResponse(1, 'success', $postsCategories);
    }
    public function getSettings()
    {
        $settings = Settings::all(['name', 'value']);
        return jsonResponse(1, 'success', $settings);
    }
    public function storeClientMessages(Request $request)
    {
        $client = $request->user();
        $validator = validator()->make($request->all(), [
            'title' => 'required|string|min:3|max:255',
            'content' => 'required|string'
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $message = $client->messages()->create($request->all());
        return jsonResponse(1, 'تم ارسال الرسالة بنجاح', $message);
    }
    public function getClientMessages()
    {
        $messages = ClientMessage::paginate(10);
        return jsonResponse(1, 'messages', $messages);
    }
}
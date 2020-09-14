<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Government;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Token;
use App\VisitorMessage;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Laracasts\Flash\Flash;

class MainController extends Controller
{
    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => 'required|string|confirmed',
        ]);
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update([
                'password' => bcrypt($request->new_password)
            ]);
            flash(__('messages.add'), 'success');
            return back();
        } else {
            return back()->withErrors(['old_password' => 'The old password is not correct']);
        }
    }
    public function showPasswordForm()
    {
        return view('owners.auth.change-password');
    }
    public function showChangeInfoForm()
    {
        $model = auth('owners')->user();
        return view('owners.auth.change-info', compact('model'));
    }
    public function changeInfo(Request $request)
    {
        $this->validate($request, [
            'full_name' => 'required|string|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($request->user()->id)]
        ], [
            'full_name.required' => 'حقل الاسم مطلوب',
            'full_name.min' => 'الاسم يجب ان يزي عن ثلاث احرف على الاقل',
            'email.required' => 'حقل البريد الالكتروني مطلوب',
            'email.email' => ' البريد الالكتروني يجب ان يكون مكتوب بطريقة صحيحة',
            'email.unique' => ' هذا البريد الالكتروني موجود من قبل',
        ]);
        $request->user()->update($request->all());
        flash(__('messages.update'), 'success');
        return redirect(route('owner.home'));
    }
    public function showChangeCompanyInfoForm()
    {
        // auth('owners')->user()->preventAccountTypeAttribute = false;
        $days = $this->getDays();
        $governs = $this->getGovernorates();
        $categories = $this->getCategories();
        $model = auth('owners')->user()->place;

        return view('owners.auth.change-info-company', compact('model', 'governs', 'days', 'categories'));
    }
    public function changeCompanyInfo(Request $request)
    {
        // dd($request->all());
        $place = $request->user()->place;
        $rules = [
            'name' => 'required|string|min:3|max:255',
            'tax_record' => ['required', 'string', Rule::unique('places')->ignore($place->id)],
            'address' => 'required|string|min:3|max:255',
            'about' => 'required|string',
            'phone' => 'required|string',
            // 'city_id' => ['required', 'numeric', Rule::in(City::all('id')->toArray())],
            'city_id' => 'required|numeric|exists:cities,id',
            // 'sub_category_id' => ['required', 'numeric', Rule::in(SubCategory::all('id')->toArray())],
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
            'opened_time' => 'required|string',
            'closed_time' => 'required|string',
            'closed_days' => ['required', 'array', Rule::in(array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'))],
            'website' => 'nullable|url',
            'facebook' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'main_image' => 'sometimes|image|max:4000'
        ];
        $this->validate($request, $rules);
        if ($request->closed_time <= $request->opened_time)
            return back()->with('closed_time', 'الرجاء اختيار معاد اغلاق مناسب');
        // dd();
        $request->merge(['closed_days' => implode(",", $request->closed_days), 'longitude' => number_format($request->longitude, 6), 'latitude' => number_format($request->latitude, 6)]);
        if ($request->has('main_image')) {
            $path = storeFileOnGoogleCloud($request->file('main_image'), 'images');
            $data = $request->except('main_image');
            $data['main_image'] = $path;
        } else {
            $data = $request->all();
        }

        // dd($data);
        $place->update($data);
        flash(__('messages.update'), 'success');
        return redirect(route('owner.home'));
    }
    function getDays()
    {
        return [
            'Sunday' =>  'الاحد',
            'Monday' =>  'الاثنين',
            'Tuesday' =>  'الثلاثاء',
            'Wednesday' =>  'الاربعاء',
            'Thursday' =>  'الخميس',
            'Friday' =>  'الجمعة',
            'Saturday' =>  'السبت',
        ];
    }
    function getGovernorates()
    {
        // $arr = ['' => 'اختار المحافظة'];

        return Governorate::all()->mapWithKeys(function ($role) {
            return [
                $role->id =>  $role->name,
            ];
        })->toArray();
    }
    function getCategories()
    {
        // $arr = ['' => 'اختار المحافظة'];

        return Category::all()->mapWithKeys(function ($role) {
            return [
                $role->id =>  $role->name,
            ];
        })->toArray();
    }
}
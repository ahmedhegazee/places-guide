<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Government;
use App\Models\Post;
use App\Models\Token;
use App\VisitorMessage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function home()
    {
        return view('front.home', compact('posts'));
    }
    public function about()
    {
        return view('front.about');
    }
    public function contact()
    {
        return view('front.contact');
    }
    public function storeMessage(Request $request)
    {
        $roles = [
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'messgAddres' => 'required|string',
            'messageText' => 'required|string',
        ];
        $messages = [
            'name.required' => 'حقل الاسم مطلوب',
            'email.required' => 'حقل البريد الالكتروني مطلوب',
            'email.email' => 'الرجاء ادخال بريد الكتروني صالح',
            'phone.required' => 'حقل رقم الهاتف مطلوب',
            'messgAddres.required' => 'حقل عنوان الرسالة مطلوب',
            'messageText.required' => 'حقل نص الرسالة مطلوب',
        ];
        $this->validate($request, $roles, $messages);
        VisitorMessage::create($request->all());
        flash('تم ارسال الرسالة بنجاح', 'success')->important();
        return back();
    }
    public function post(Post $post)
    {
        $relatedPosts = Post::searchCategory($post->category->id)->where('id', '!=', $post->id)->take(6)->get();
        // dd($relatedPosts);
        return view('front.post-details', compact('post', 'relatedPosts'));
    }
    public function favouritePosts()
    {
        $favouritePosts = auth('client')->user()->favouritePosts()->paginate(3);
        return view('front.favourite-posts', compact('favouritePosts'));
    }
    public function posts()
    {
        $posts = Post::paginate(3);
        return view('front.posts', compact('posts'));
    }
    public function toggleFavouritePosts(Request $request)
    {
        $client = $request->user();
        $client->favouritePosts()->toggle($request->post);
        return jsonResponse(1, 'success');
    }
    public function donation(Request $request)
    {
        $this->validate($request, [
            'city' => ['sometimes', 'numerc', Rule::in(City::all()->pluck('id')->toArray())],
            'blood' => ['sometimes', 'numeric', Rule::in(BloodType::all()->pluck('id')->toArray())],
            // 'search' => 'sometimes|string'
        ]);
        $records = DonationRequest::with('client')->with('city.government')->with('bloodType')->search($request->search)
            ->searchBloodType($request->blood)
            ->searchCity($request->city)
            ->paginate(10);
        return view('front.donation', compact('records'));
    }
    public function donationStatus(DonationRequest $request)
    {
        return view('front.donation-status', compact('request'));
    }
    public function createRequest()
    {
        return view('front.request-create');
    }
    public function storeRequest(Request $request)
    {
        $rules = [
            'name' => 'required|string|min:3',
            'age' => 'required|numeric',
            'blood_type_id' => ['required', Rule::in(BloodType::all()->pluck('id')->toArray())],
            'no_blood_bags' => 'required|numeric',
            'address' => [Rule::requiredIf(function () use ($request) {
                return !$request->has('longtitude') && !$request->has('latitude');
            }), 'string'],
            'longtitude' => ['numeric', Rule::requiredIf(function () use ($request) {
                return !$request->has('address');
            })],
            'latitude' => ['numeric', Rule::requiredIf(function () use ($request) {
                return !$request->has('address');
            })],
            'city_id'
            => ['required', Rule::in(City::all()->pluck('id')->toArray())],
            'government_id'
            => ['required', Rule::in(Government::all()->pluck('id')->toArray())],
            'phone'
            => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/'],
            'notes' => 'sometimes|string'
        ];
        $client = $request->user();
        $validator = $this->validate($request, $rules);

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
            }
        }
        flash('تم انشاء الطلب', 'success')->important();
        return back();
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:5',
            // 'password' => 'sometimes|string|min:8|confirmed',
            'email' => ['required', 'email', Rule::unique('clients')->ignore(auth('client')->user()->id)],
            'phone' => ['required', 'regex:/^(010|011|012|015){1}[0-9]{8}$/', Rule::unique('clients')->ignore(auth('client')->user()->id)],
            'dob' => 'required|date|before: -16 years',
            'last_donation_date' => 'required|date|before_or_equal: -1 days',
            'city_id' => ['sometimes', Rule::in(City::all()->pluck('id')->toArray())],
            'blood_type_id' => ['sometimes', Rule::in(BloodType::all()->pluck('id')->toArray())],
        ], [
            'name.required' => 'حقل الاسم مطلوب',
            'name.min' => 'يجب ان يحتوي حقل الاسم على الاقل خمس احرف',

            'password.required' => 'حقل كلمة المرور مطلوب',
            'password.min' => 'حقل كلمة المرور يجب ان يحتوي على الاقل ٨ احرف',
            'password.confirmed' => 'الرجاء كتابة كلمة المرور مره اخرى بشكل صحيح',

            'email.required' => 'حقل البريد الالكتروني مطلوب',
            'email.email' => 'الرجاء كتابة البريد الالكتروني بشكل صحيح',
            'email.unique' => 'هذا البريد الالكنروني موجود بالفعل',

            'phone.required' => 'حقل الجوال مطلوب',
            'phone.regex' => 'يجب كتابة رقم الجوال بشكل صحيح',
            'phone.unique' => 'رقم الجوال موجود بالفعل',

            'dob.required' => 'حقل تاريخ الميلاد مطلوب',
            'dob.date' => 'الرجاء كتابة تاريخ الميلاد بشكل صحيح',
            'dob.before' => 'يجب ان يكون سن المتبرع على الاقل ١٦ سنة',

            'last_donation_date.required' => 'حقل تاريخ اخر تبرع مطلوب',
            'last_donation_date.date' => 'الرجاء كتابة تاريخ اخر تبرع بشكل صحيح',
            'last_donation_date.before_or_equal' => 'الرجاء كتابة تاريخ اخر تبرع بشكل صحيح',

            'city_id.required' => 'حقل المدينة مطلوب',
            'city_id.in' => 'الرجاء اختيار المدينة بشكل صحيح',

            'blood_type_id.required' => 'حقل فصيلة الدم مطلوب',
            'blood_type_id.in' => 'الرجاء اختيار فصيلة الدم بشكل صحيح'

        ]);
    }
    public function profile()
    {
        $client = auth('client')->user();
        return view('front.profile', compact('client'));
    }
    public function updateProfile(Request $request)
    {
        $this->validator($request->all())->validate();
        if ($request->has('password'))
            $request->merge(['password' => bcrypt($request->password)]);
        // dd($request->user());
        $request->user()->update($request->all());
        flash('تم التحديث بنجاح', 'success');
        return back();
    }
}
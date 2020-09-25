<?php

namespace App\Http\Controllers\Front;

use App\FormatDataCollection;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Discount;
use App\Models\Government;
use App\Models\Place;
use App\Models\PlaceOwner;
use App\Models\SubCategory;
use App\Models\Token;
use App\Models\VisitorMessage;
use App\Models\WorkAd;
use App\Models\WorkerCategory;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    use FormatDataCollection;
    public function home()
    {
        if (!is_null(auth('clients')->user()))
            $bestPlaces = Place::best()->searchCity(auth('clients')->user()->city->id)->take(6)->get();
        else {
            $bestPlaces = collect([]);
        }
        // dd($bestPlaces);
        // $ratedPlaces = DB::table('reviews')
        //     ->join('places', 'reviews.place_id', '=', 'places.id')
        //     ->select('places.id', 'places.name', 'places.main_image', DB::raw('AVG(reviews.rating) as avg_rating'))
        //     ->groupBy('place_id')
        //     ->orderBy('avg_rating', 'desc')
        //     ->take(6)
        //     ->get();
        // dd($ratedPlaces);
        // $ratedPlaces = Place::whereHas('owner', function ($query) {
        //     $query->where('is_accepted', 1);
        // })->has('reviews')->get()->sortByDesc(function ($place) {
        //     return $place->rating;
        // });
        // dd($ratedPlaces);
        $places = Place::whereHas('owner', function ($query) {
            $query->where('is_accepted', 1);
        })
            ->latest()->take(6)->get();
        // dd($places);
        return view('front.home', compact('places',  'bestPlaces'));
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
    public function favouritePosts()
    {
        $favouritePosts = auth('client')->user()->favouritePosts()->paginate(3);
        return view('front.favourite-posts', compact('favouritePosts'));
    }
    public function toggleFavouritePosts(Request $request)
    {
        $client = $request->user();
        $client->favouritePosts()->toggle($request->post);
        return jsonResponse(1, 'success');
    }
    public function profile()
    {
        $client = auth('clients')->user();
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
    public function password()
    {
        $client = auth('clients')->user();
        return view('front.change-password', compact('client'));
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);
        if (Hash::check($request->old_password, $request->user()->password))
            $request->merge(['password' => bcrypt($request->password)]);
        else {
            flash('الرجاء ادخال كلمة المرور القديمة ', 'danger');
            return back();
        }
        $request->user()->update($request->only('password'));
        flash('تم التحديث بنجاح', 'success');
        return back();
    }
    public function category(Request $request, Category $category)
    {
        $title = __('pages.All places');
        $route = route('category', ['category' => $category->id]);
        $count = $category->acceptedPlaces()->count();
        $categories = $category->subCategories()->withCount('acceptedPlaces')->get();
        // dd($categories);
        $records = $category->acceptedPlaces()
            ->searchCategory($request->cat)
            ->searchCity($request->city)->paginate(10);
        $governs = $this->getGovernorates();
        return view('front.category', compact('records', 'category', 'governs', 'categories', 'route', 'title', 'count'));
    }

    public function discounts(Request $request)
    {
        $title = __('pages.All discounts');
        $route = route("discount");
        $count = Discount::available()->count();
        // dd($count);
        $acceptedOwners = PlaceOwner::accepted(1)->pluck('id')->toArray();
        $categories = Category::withCount(['places' => function ($query) use ($acceptedOwners) {
            $query->whereIn('place_owner_id', $acceptedOwners);
        }])->get();

        $records = Place::has('discounts', '>', 0)
            ->searchCategory($request->cat)
            ->searchCity($request->city)
            ->withCount('discounts')
            ->with('availableDiscounts')
            ->orderBy('name', 'asc')
            ->paginate(10);

        $governs = $this->getGovernorates();
        return view('front.discounts', compact('records', 'governs', 'title', 'route', 'count', 'categories'));
    }
    public function showPlaceDiscounts(Place $place)
    {
        $records = $place->availableDiscounts()->paginate(5);
        return view('front.discount-show', compact('place', 'records'));
    }
    public function workads(Request $request)
    {
        $title = __('pages.All Jobs');
        $route = route("workads");
        $governs = $this->getGovernorates();
        $records = WorkAd::whereHas('place', function ($query) use ($request) {
            if ($request->has('city'))
                $query->where('city_id', $request->city);
        })
            ->with('place')
            ->searchCategory($request->cat)
            ->paginate(10);
        $count = WorkAd::all()->count();
        $categories = WorkerCategory::withCount('ads')->get();
        // dd($records);
        return view('front.workads', compact('records', 'governs', 'count', 'title', 'route', 'categories'));
    }
    public function showWorkAd(WorkAd $ad)
    {
        //Make the show view
        return view('front.workad-show', compact('ad'));
    }
    public function validator($data)
    {
        $rules = [
            'full_name' => 'required|string|min:3',
            'email' => ['required', 'email', Rule::unique('clients')->ignore(auth('clients')->user()->id)],
            'city_id' => 'sometimes|exists:cities',
            'phone'
            => ['required', 'string', Rule::unique('clients')->ignore(auth('clients')->user()->id)],
        ];
        return validator($data, $rules);
    }
    public function place(Place $place)
    {
        $count = $place->photos->count() + 1;
        if (!is_null($place->vide0))
            $count++;
        return view('front.place', compact('place', 'count'));
    }
    public function review(Request $request, Place $place)
    {
        $this->validate($request, [
            'content' => 'required|string|min:3|max:255',
            'rating' => 'required|numeric|min:0|max:5',
        ]);
        $request->user()->reviews()->create([
            'place_id' => $place->id,
            'content' => $request->content,
            'rating' => $request->rating,
        ]);
        flash(__('messages.add'), 'success');
        return back();
    }
}
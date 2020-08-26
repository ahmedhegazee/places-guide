<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\VisitorMessage;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {

        $posts = Post::take(6)->get();
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
}
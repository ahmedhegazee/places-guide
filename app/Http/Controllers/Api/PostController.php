<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use App\ImageUtility;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'category' => ['sometimes', 'numeric', Rule::in(Category::all()->pluck('id')->toArray())],
            'search' => 'sometimes|string'
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $posts = Post::searchCategory($request->category)->content($request->search)->paginate(10);
        return jsonResponse(1, 'success', $posts);
    }
    public function favouritePosts()
    {
        $client = auth()->guard('client_api')->user();
        $posts = $client->favouritePosts()->paginate(10);
        return jsonResponse(1, 'success', $posts);
    }
    public function toggleFavouritePosts(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'post' => [Rule::in(Post::all()->pluck('id')->toArray())]
        ]);
        if ($validator->fails()) {
            return jsonResponse(0, 'errors', $validator->errors());
        }
        $client = $request->user();
        $client->favouritePosts()->toggle($request->post);
        return jsonResponse(1, 'تم التحديث بنجاح');
    }

    public function show(Post $post)
    {
        $isFavourite = auth()->guard('client_api')->user()->favouritePosts->contains($post);
        return jsonResponse(1, 'success', ['post' => $post, 'favourite' => $isFavourite]);
    }
}

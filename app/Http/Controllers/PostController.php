<?php

namespace App\Http\Controllers;

use App\ImageUtility;
use App\Models\Category;
use App\Models\Client;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'category' => ['sometimes', 'numeric', Rule::in(Category::all()->pluck('id')->toArray())],
            // 'search' => 'sometimes|string'
        ]);
        $records = Post::searchCategory($request->category)->content($request->search)->paginate(5);
        return view('posts.index', compact('records'));
    }
    function getCategories()
    {
        return
            Category::all()->mapWithKeys(function ($category) {
                return [
                    $category->id =>  $category->name,
                ];
            })->toArray();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->getCategories();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'category_id' => ['required', Rule::in(Category::all()->pluck('id')->toArray())],
            'title' => 'required|string',
            'content' => 'required|string',
            'photo' => 'required|image|max:10240'
        ]);

        $image = $request->file('photo');
        $imageStr = ImageUtility::storeImage($image, '/storage/posts/', 200, 300);
        // dd($imageStr);
        $data = $request->except('photo');
        $data['photo'] =  $imageStr;
        Post::create($data);
        flash('Post is added', 'success')->important();

        return redirect(route('post.index'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = $this->getCategories();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $this->validate($request, [
            'category_id' => ['sometimes', Rule::in(Category::all()->pluck('id')->toArray())],
            'title' => 'sometimes|string',
            'content' => 'sometimes|string',
            'photo' => 'sometimes|image|max:10240'
        ]);


        $data = $request->except('photo');
        if ($request->has('photo')) {
            ImageUtility::deleteImage($post->photo);
            $image = $request->file('photo');
            $imageStr = ImageUtility::storeImage($image, '/storage/posts/', 200, 300);
            $data['photo'] = $imageStr;
        }
        $post->update($data);
        flash('Post is updated', 'success')->important();
        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        ImageUtility::deleteImage($post->photo);
        $post->delete();
        flash('Post is deleted', 'success')->important();
        return redirect(route('post.index'));
    }
}

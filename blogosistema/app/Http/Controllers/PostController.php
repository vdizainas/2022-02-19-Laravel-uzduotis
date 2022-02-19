<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::all();

        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    // filter
    public function postfilter(Request $request) {

        $category_id = $request->category_id;
        $posts = Post::where('category_id', '=', $category_id)->get();
        return view('post.postfilter', ['posts' => $posts]);

    }

    public function indexpagination(Request $request) {

        $sortCollumn = $request->sortCollumn;
        $sortOrder = $request->sortOrder;

        $all_post = Post::all();
        $post_items = array_keys($all_post->first()->getAttributes());

        if(empty($sortCollumn) || empty($sortOrder)) {
            $posts = Post::paginate(30);
        } else {
            $posts = Post::orderBy($sortCollumn, $sortOrder)->paginate(30);
        }   

        $select_array = $post_items;

        // $posts = Post::all()->sortBy('data', SORT_REGULAR, true);
        // $posts = Post::orderBy('data', 'DESC')->paginate(30);

        // $posts = Post::paginate(30);
        return view('post.indexpagination', ['posts' => $posts, 'sortCollumn' => $sortCollumn, 'sortOrder' => $sortOrder, 'select_array' => $select_array]);
    }

}

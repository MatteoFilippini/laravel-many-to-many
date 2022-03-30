<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $tags = Tag::all();
        return view('admin.posts/index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'title' => ['string', 'max:50', 'min:5', 'required', Rule::unique('posts')->ignore($post->id)],
            'content' => 'string|min:10|required',
            'image' => 'url|nullable',
            'category_id' => 'nullable|exists:posts,category_id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');
        $post = Post::create($data);
        if (array_key_exists('tags', $data)) $post->tags()->attach($data['tags']);
        return redirect()->route('admin.posts.index')->with('message', 'Hai creato un nuovo post')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $post = Post::findOrFail($post->id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post_tag_ids = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post', 'categories', 'tags', 'post_tag_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($request->all());
        $request->validate([
            'title' => ['string', 'max:50', 'min:5', 'required', Rule::unique('posts')->ignore($post->id)],
            'content' => 'string|min:10|required',
            'image' => 'url|nullable',
            'category_id' => 'nullable|exists:posts,category_id',
            'tags' => 'nullable|exists:tags,id'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title, '-');
        $post->update($data);
        if (!array_key_exists('tags', $data)) $post->tags()->detach();
        else  $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.show', $post)->with('message', 'Hai modificato questo post')->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (count($post->tags)) $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "Il post $post->title è stato eliminato")->with('type', 'success');
    }
}

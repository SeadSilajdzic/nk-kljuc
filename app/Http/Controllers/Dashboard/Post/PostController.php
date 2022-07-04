<?php

namespace App\Http\Controllers\Dashboard\Post;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Post\Post;
use App\Http\Requests\Dashboard\Post\StorePostRequest;
use App\Http\Requests\Dashboard\Post\UpdatePostRequest;
use App\Models\Dashboard\User\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     * @throws AuthorizationException
     */
    public function index()
    {
        $currentUser = auth()->user();
        $this->authorize('viewAny', $currentUser);
        $posts = Post::getPosts();
        return view('dashboard.posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     * @throws AuthorizationException
     */
    public function create()
    {
        $currentUser = auth()->user();
        $this->authorize('create', $currentUser);
        $users = User::returnAdmins();
        return view('dashboard.posts.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return void
     * @throws AuthorizationException
     */
    public function store(StorePostRequest $request)
    {
        $currentUser = auth()->user();
        $this->authorize('create', $currentUser);
        $data = $request->validated();

        Post::create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
//            'image' => $data[''],
//            'images' => $data[''],
            'slug' => Str::slug($data['title']),
            'subtitle' => $data['subtitle'],
            'status' => $data['status'],
        ]);

        return redirect()->route('dashboard.post.index')->with('success', 'Objava uspješno kreirana');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     * @throws AuthorizationException
     */
    public function edit(Post $post)
    {
        $currentUser = auth()->user();
        $this->authorize('update', $currentUser);
        $users = User::returnAdmins();
        return view('dashboard.posts.edit', [
            'post' => $post,
            'users' => $users
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return Response
     * @throws AuthorizationException
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $currentUser = auth()->user();
        $this->authorize('update', $currentUser);
        $data = $request->validated();

        $post->update([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'short_description' => $data['short_description'],
            'description' => $data['description'],
//            'image' => $data[''],
//            'images' => $data[''],
            'slug' => Str::slug($data['title']),
            'subtitle' => $data['subtitle'],
            'status' => $data['status'],
        ]);

        return redirect()->route('dashboard.post.index')->with('success', 'Objava uspješno ažurirana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Post $post)
    {
        $currentUser = auth()->user();
        $this->authorize('delete', $currentUser);
        $post->delete();
        return redirect()->route('dashboard.post.index')->with('warning', 'Objava uspješno arhivirana');
    }

    /**
     * Check the list of the archived models.
     *
     * @return void
     * @throws AuthorizationException
     */
    public function archived()
    {
        $currentUser = auth()->user();
        $this->authorize('archived', $currentUser);
        $posts = Post::onlyTrashed()->with(['user' => function($query) {
            $query->select(['id', 'name']);
        }])->select(['id', 'title', 'status', 'user_id'])->paginate(15);
        return view('dashboard.posts.archived', [
            'posts' => $posts
        ]);
    }

    /**
     * Possibility to restore archived model.
     *
     * @param $id
     * @return void
     * @throws AuthorizationException
     */
    public function restore($id)
    {
        $currentUser = auth()->user();
        $this->authorize('restore', $currentUser);
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->back()->with('info', 'Objava uspješno vraćena');
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param $id
     * @return void
     * @throws AuthorizationException
     */
    public function forceDelete($id)
    {
        $currentUser = auth()->user();
        $this->authorize('forceDelete', $currentUser);
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        return redirect()->back()->with('danger', 'Objava trajno obrisana');
    }
}

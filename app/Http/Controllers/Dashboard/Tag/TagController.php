<?php

namespace App\Http\Controllers\Dashboard\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Tag\StoreTagRequest;
use App\Http\Requests\Dashboard\Tag\UpdateTagRequest;
use App\Models\Dashboard\Tag\Tag;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     * @throws AuthorizationException
     */
    public function index()
    {
        $currentUser = auth()->user();
        $this->authorize('viewAny', $currentUser);
        $tags = Tag::tags();
        return view('dashboard.tags.index', [
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTagRequest $request
     * @return void
     * @throws AuthorizationException
     */
    public function store(StoreTagRequest $request)
    {
        $currentUser = auth()->user();
        $this->authorize('create', $currentUser);
        $data = $request->validated();

        Tag::create([
            'name' => $data['name']
        ]);

        return redirect()->back()->with('success', 'Tag uspješno kreiran');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tag $tag
     * @return void
     * @throws AuthorizationException
     */
    public function edit(Tag $tag)
    {
        $this->authorize('update', $tag);
        return view('dashboard.tags.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTagRequest $request
     * @param Tag $tag
     * @return void
     * @throws AuthorizationException
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $this->authorize('update', $tag);
        $data = $request->validated();

        $tag->update([
            'name' => $data['name']
        ]);

        return redirect()->route('dashboard.tag.index')->with('success', 'Tag uspješno ažuriran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tag $tag
     * @return void
     * @throws AuthorizationException
     */
    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);
        $tag->delete();

        return redirect()->back()->with('danger', 'Tag trajno obrisan');
    }
}

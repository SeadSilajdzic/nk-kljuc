<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Models\Dashboard\Category\Category;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class CategoryController extends Controller
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
        $categories = Category::select(['id', 'name'])->withCount('posts')->paginate(5);
        return view('dashboard.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return void
     * @throws AuthorizationException
     */
    public function store(CategoryRequest $request)
    {
        $currentUser = auth()->user();
        $this->authorize('create', $currentUser);
        $data = $request->validated();
        Category::create([
            'name' => $data['name']
        ]);
        return redirect()->back()->with('success', 'Kategorija uspješno kreirana');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return Response
     * @throws AuthorizationException
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('dashboard.category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return Response
     * @throws AuthorizationException
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);
        $data = $request->validated();
        $category->update([
            'name' => $data['name']
        ]);
        return redirect()->back()->with('success', 'Kategorija uspješno ažurirana');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Category $category)
    {
        $this->authorize('destroy', $category);
        $category->delete();
        return redirect()->back()->with('danger', 'Kategorija trajno obrisana');
    }
}

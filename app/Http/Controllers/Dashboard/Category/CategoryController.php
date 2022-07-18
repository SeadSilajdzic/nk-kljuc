<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\CategoryRequest;
use App\Models\Dashboard\Category\Category;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
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
     */
    public function store(CategoryRequest $request)
    {
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
     */
    public function edit(Category $category)
    {
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
     */
    public function update(CategoryRequest $request, Category $category)
    {
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
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('danger', 'Kategorija trajno obrisana');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Events\SystemUpdate;
use App\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $category = Category::create($attributes);

        SystemUpdate::dispatch("Category Created!");

        return response()->json([
            'id' => $category->id,
            'message' => 'category was successfully created'
        ]);
    }

    public function update(Category $category)
    {
        $attributes = request()->validate([
            'name' => 'required',
        ]);

        $category->update($attributes);

        SystemUpdate::dispatch("Category Updated!");


        return response()->json([
            'category' => $category->name,
            'message' => 'category updated'
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'message' => 'category was successfully deleted'
        ]);
    }
}

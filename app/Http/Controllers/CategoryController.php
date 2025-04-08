<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('pages.category.category-index', ["models" => $categories]);
    }

    public function store(CategoryCreateRequest $request)
    {
        $data = $request->all();
        Category::create($data);
        return back();
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->all();
        $category->update($data);
        return back();
    }
    public function delete(Category $category)
    {
        $category->delete();
        return back();
    }

    public function status(Category $category)
    {
        if ($category->status == 1) {
            $category->status = 2;
        } else {
            $category->status = 1;
        }
        $category->save();
        return back();
    }
    public function search(Request $request)
    {
        $query = $request->input('name');

        $models = Category::where('name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('pages.category.category-index', ["models" => $models]);
    }
}

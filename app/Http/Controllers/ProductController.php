<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        $categories = Category::where('status', 1)->get();
        return view('pages.product.product-index', ['models' => $products, 'categories' => $categories]);
    }

    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
            $file->move('image_upload/', $filename);
            $data['image'] = 'image_upload/' . $filename;
        }

        $data['slug'] = Str::slug($data['name']);
        Product::create($data);
        return back();
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = date('Y-m-d') . '_' . time() . '.' . $extension;
            $file->move('image_upload/', $filename);
            $data['image'] = 'image_upload/' . $filename;
        }
        

        $data['slug'] = Str::slug($data['name']);
        
        $product->update($data);
        return back();
    }

    public function delete(Product $product)
    {
        $product->delete();
        return back();
    }

    public function status(Product $product)
    {
        if ($product->status == 1) {
            $product->status = 2;
        } else {
            $product->status = 1;
        }
        $product->save();
        return back();
    }
    public function search(Request $request)
    {
        $query = $request->input('name');

        $models = Product::where('name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('pages.category.category-index', ["models" => $models]);
    }
}

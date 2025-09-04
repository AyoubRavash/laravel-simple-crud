<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        if ($request->has("search") && $request->search) {
            $query = $query->where("name", "like", "%" . $request->search . "%")->orWhere("description", "like", "%" . $request->search . "%");
        }
        $perPage = env('PAGE_SIZE', 10);
        $products = $query->latest()->paginate($perPage);
        return view("product.product-list", compact("products"));
    }

    public function create()
    {
        $categories = Category::all();
        return view("product.product-create", compact("categories"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "nullable|string",
            "price" => "required|numeric",
            "quantity" => "required|integer",
            "status" => "required|string",
            "category_id" => "required|integer",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        if ($request->hasFile("image")) {
            $validated["image"] = $request->file("image")->store("products", 'public');
        }
        Product::create($validated);
        return redirect()->route("product.index")->with("success", "Product created successfully");
    }


    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view("product.product-show", compact("product"));
        } catch (\Throwable $th) {
            return redirect()->route("product.index")->with("error", "Product not found");
        }
    }

    public function showDestroyed(Request $request)
    {
        $query = Product::query()->onlyTrashed();
        if ($request->has("search") && $request->search) {
            $query = $query->where("name", "like", "%" . $request->search . "%")->orWhere("description", "like", "%" . $request->search . "%");
        }
        $perPage = env('PAGE_SIZE', 10);
        $products = $query->latest()->paginate($perPage);
        return view("product.product-show-deleted", compact("products"));
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            $categories = Category::all();
            return view("product.product-edit", compact("product", "categories"));
        } catch (\Throwable $th) {
            return redirect()->route("product.index")->with("error", "Product not found");
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            "name" => "required|string",
            "description" => "nullable|string",
            "price" => "required|numeric",
            "quantity" => "required|integer",
            "status" => "required|string",
            "category_id" => "required|integer",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        try {
            $product = Product::findOrFail($id);
            if ($request->hasFile("image")) {
                if (Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }
                $validated["image"] = $request->file("image")->store("products", 'public');
            }
            $product->update($validated);
            return redirect()->route("product.index")->with("success", "Product updated successfully");
        } catch (\Throwable $th) {
            return redirect()->route("product.index")->with("error", "An error occurred while updating the product");
        }
    }

    public function destroy($id)
    {
        try {
            Product::findOrFail($id)->delete();
            return redirect()->route("product.index")->with("success", "Product deleted successfully");
        } catch (\Throwable $th) {
            return redirect()->route("product.index")->with("error", "An error occurred while deleting the product");
        }
    }

    public function restore($id)
    {
        try {
            Product::withTrashed()->findOrFail($id)->restore();
            return redirect()->route("product.index")->with("success", "Product restored successfully");
        } catch (\Throwable $th) {
            return redirect()->route("product.index")->with("error", "An error occurred while restoring the product");
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::onlyTrashed()->findOrFail($id);
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $product->forceDelete();
            return redirect()->route("product.show-deleted")->with("success", "Product deleted permanently");
        } catch (\Throwable $th) {
            return redirect()->route("product.show-deleted")->with("error", "An error occurred while deleting the product $th");
        }
    }
}

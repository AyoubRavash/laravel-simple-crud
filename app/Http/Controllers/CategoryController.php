<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index(Request $request)
  {
    $query = Category::query();
    if ($request->has("search") && $request->search) {
      $query = $query->where("name", "like", "%" . $request->search . "%");
    }
    $perPage = env('PAGE_SIZE', 10);
    $categories = $query->latest()->paginate($perPage);
    return view('category.category-list', compact('categories'));
  }

  public function show($id)
  {
    try {
      $category = Category::findOrFail($id);
      return view('category.category-show', compact('category'));
    } catch (\Throwable $th) {
      return redirect()->route('category.index')->with('error', 'Category not found');
    }
  }

  public function create()
  {
    return view('category.category-create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string',
      'status' => 'required|string',
    ]);
    Category::create($validated);
    return redirect()->route('category.index')->with('success', 'Category created successfully');
  }

  public function edit($id)
  {
    try {
      $category = Category::findOrFail($id);
      return view('category.category-edit', compact('category'));
    } catch (\Throwable $th) {
      return redirect()->route('category.index')->with('error', 'Category not found');
    }
  }

  public function update(Request $request, $id)
  {
    $validated = $request->validate([
      'name' => 'required|string',
      'status' => 'required|string',
    ]);
    try {
      $category = Category::findOrFail($id);
      $category->update($validated);
      return redirect()->route('category.index')->with('success', 'Category updated successfully');
    } catch (\Throwable $th) {
      return redirect()->route('category.index')->with('error', 'Category not found');
    }
  }

  public function destroy($id)
  {
    try {
      Category::findOrFail($id)->delete();
      return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    } catch (\Throwable $th) {
      return redirect()->route('category.index')->with('error', 'Category not found');
    }
  }

  public function restore($id)
  {
    try {
      Category::withTrashed()->findOrFail($id)->restore();
      return redirect()->route('category.show-deleted')->with('success', 'Category restored successfully');
    } catch (\Throwable $th) {
      return redirect()->route('category.index')->with('error', 'An error occurred while restoring the category');
    }
  }

  public function showDestroyed(Request $request)
  {
    $query = Category::query()->onlyTrashed();
    if ($request->has("search") && $request->search) {
      $query = $query->where("name", "like", "%" . $request->search . "%");
    }
    $perPage = env('PAGE_SIZE', 10);
    $categories = $query->latest()->paginate($perPage);
    return view('category.category-show-deleted', compact('categories'));
  }

  public function delete($id)
  {
    try {
      $category = Category::onlyTrashed()->findOrFail($id);
      $category->forceDelete();
      return redirect()->route('category.show-deleted')->with('success', 'Category deleted permanently');
    } catch (\Throwable $th) {
      return redirect()->route('category.index')->with('error', 'An error occurred while deleting the category');
    }
  }


}

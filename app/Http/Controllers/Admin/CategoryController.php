<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CategoryUpdaeteRequest;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Category::latest();
            return DataTables::eloquent($categories)
                ->addColumn('action', function($category) {
                    $editButton = '<a class="btn btn-sm btn-primary editCategory" href="javascript:void(0);" data-id="' . $category->id . '"><i class="fas fa-edit"></i></a>';

                    $delButton = '<form action="' . route('categories.destroy', [$category->id]) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm(\'Are you sure you want to delete this category?\')"><i class="fas fa-trash"></i></button>
                                  </form>';

                    return $editButton . ' ' . $delButton;
                })
                ->addColumn('created_at', function($category) {
                    return $category->created_at ? $category->created_at->format('d-m-Y') : '';
                })
                ->rawColumns(['action', 'created_at'])
                ->toJson();
        }

        return view('admin.categories.index');
    }

    public function suggestions(Request $request) {
        $search = $request->term;
        $categories = Category::where('title', 'LIKE', "%{$search}%")->pluck('title');
        if ($categories->isEmpty()) {
            $categories = Category::latest()->pluck('title');
        }
        return response()->json($categories);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.update', compact('category'));
    }

    public function update(CategoryUpdaeteRequest $request, Category $category)
    {
        try {
            $category->update([
                'title' => $request->title,
            ]);

            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong, please try again.');
        }
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong, please try again.');
        }
    }
}
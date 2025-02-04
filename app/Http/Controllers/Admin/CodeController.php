<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CodeStoreRequest;
use App\Http\Requests\CodeUpdateRequest;
use App\Models\Code;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\CategoryService;  // Assuming we create a CategoryService
use Yajra\DataTables\Facades\DataTables;

class CodeController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $codes = Code::latest(); // You can optimize the query if needed
            return DataTables::eloquent($codes)
                ->addColumn('category', function($code) {
                    $category = $code->category ? $code->category->title : '';
                    return $category;
                })
                ->addColumn('action', function($code) {
                    $editButton = '<a class="btn btn-sm btn-primary" href="' . route('codes.edit', [$code->id]) . '"><i class="fas fa-edit"></i></a>';

                    $delButton = '<form action="' . route('codes.destroy', [$code->id]) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm(\'Are you sure you want to delete this code?\')"><i class="fas fa-trash"></i></button>
                                  </form>';

                    return $editButton . ' ' . $delButton;
                })
                ->addColumn('created_at', function($code) {
                    return $code->created_at ? $code->created_at->format('d-m-Y') : '';
                })
                ->rawColumns(['action', 'created_at'])
                ->toJson();
        }

        return view('admin.codes.index');
    }

    public function create()
    {
        return view('admin.codes.create');
    }

    public function store(CodeStoreRequest $request)
    {
        try {
            $category = $this->categoryService->createOrGetCategory($request->category);

            Code::create([
                'category_id' => $category->id,
                'title' => $request->title,
                'code' => $request->code
            ]);

            return redirect()->route('codes.index')->with('success', 'Code created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong, please try again.');
        }
    }

    public function edit(Code $code)
    {
        return view('admin.codes.update', compact('code'));
    }

    public function update(CodeUpdateRequest $request, Code $code)
    {
        try {
            $category = $this->categoryService->createOrGetCategory($request->category);

            $code->update([
                'category_id' => $category->id,
                'title' => $request->title,
                'code' => $request->code
            ]);

            return redirect()->route('codes.index')->with('success', 'Code updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong, please try again.');
        }
    }

    public function destroy(Code $code)
    {
        try {
            $code->delete();
            return redirect()->route('codes.index')->with('success', 'Code deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong, please try again.');
        }
    }
}
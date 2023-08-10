<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // $query = Category::query();
        // if ($search = $request->search) {
        //     $query->where('name', 'LIKE', "%{$search}%");
        // }
        // $categories = $query->paginate(10);

        $categories = Category::paginate(100);
        $mainCategories = Category::where('parent_id', 0)->orWhere('parent_id', null)->get();
        return view('dashboard.categories.index', compact('mainCategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator($request->all(), [
            'name' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            // 'parent_id' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable'
        ]);
        if (!$validator->fails()) {
            $data = $request->except('_token', 'image');
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'store');
                $data['image'] = $path;
            }
            $isSaved = Category::create($data);

            // return redirect()->route('dashboard.categories.index')
            //     ->with('success', 'تمت اضافة قسم جديد بنجاح')
            //     ->with('icon', 'success');
            return response()->json(['message' => $isSaved ? "تمت اضافة قسم جديد بنجاح" : "Failed to Saved", 'icon' => $isSaved ? 'success' : 'error', 'info' => $isSaved], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first(), 'icon' => 'error'], Response::HTTP_BAD_REQUEST);
            // dd('Fails');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $mainCategories = Category::where('parent_id', 0)->orWhere('parent_id', null)->get();
        // $category = Category::where('id', $id)->withCount('child')->firstOrFail();
        $category = Category::findOrFail($id);
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orWhere('parent_id', '<>', $id);
            })
            ->get();
        return view('dashboard.categories.edit', compact('category', 'mainCategories', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'nullable|string',
            'parent_id' => 'nullable|int|exists:categories,id',
            // 'parent_id' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required'
        ]);

        if (!$validator->fails()) {
            File::delete(public_path($category->image));
            $data = $request->except('_token', 'image');
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'store');
                $data['image'] = $path;
            }

            $category->update($data);

            return redirect()->route('dashboard.categories.index')
                ->with('success', 'تمت تعديل القسم بنجاح')
                ->with('icon', 'info');
        } else {
            dd($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $category = Category::findOrFail($id);
        $isDeleted = $category->delete();
        File::delete(public_path($category->image));
        if ($isDeleted) {

            return response()->json(['title' => 'success', 'text' => 'Category Deleted Successfully', 'icon' => 'success'], Response::HTTP_OK);
        } else {
            return response()->json(['title' => 'Error', 'text' => 'Category Deleted Failed', 'icon' => 'error'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function trash(Request $request)
    {
        dd($request);
        // $categories = Category::onlyTrashed()->paginate();
        // return view('dashboard.categories.trash', compact('categories'));
    }


    public function restore(Request $request, $id)
    {
        $category = Category::onlyTrashed()->findOrFail($id)->paginate();
        // $category->restore();
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category Restored!');
    }


    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id)->paginate();
        // $category->forceDelete();
        return redirect()->route('dashboard.categories.trash')->with('success', 'Category Deleted forever!');
    }
}

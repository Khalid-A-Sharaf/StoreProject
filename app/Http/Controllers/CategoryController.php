<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mainCategories = Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
        // $categories = Category::paginate(10);
        return view('dashboard.categories.index', ['mainCategories' => $mainCategories]);
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
    public function store(Request $request,  Category $categories)
    {
        //
        // dd($request->all());

        $validator = Validator($request->all(), [
            'name' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable'
        ]);
        if (!$validator->fails()) {
            // dd('yes');
            $categories->name = $request->name;
            $categories->parent_id = $request->parent_id;
            if ($request->has('image')) {
                $image = $request->file('image');
                $imageName = time() . '_Category.' . $image->getClientOriginalExtension();
                $image->storeAs('images', $imageName, ['disk' => 'public']);
                $categories->image = $imageName;
            }
            $isSaved = $categories->save();
            return redirect()->route('dashboard.categories.index')->with('success', 'تمت اضافة قسم جديد بنجاح');
        } else {
            dd('Fails');
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
    public function edit(Category $category)
    {
        //
        $mainCategories = Category::where('parent_id', 0)->orwhere('parent_id', null)->get();
        return view('dashboard.categories.edit', ['category' => $category, 'mainCategories' => $mainCategories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}

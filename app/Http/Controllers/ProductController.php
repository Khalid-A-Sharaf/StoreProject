<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
// use App\Models\ProductColor;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::has('colors')->withCount('colors')->latest()->get();
        $X_products = Color::all();
        // dd($X_product);
        return view('dashboard.products.index', compact('products', 'X_products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::with('child')->get();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $products)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'nullable|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'discount_price' => 'nullable|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|required'
        ]);
        if (!$validator->fails()) {
            if ($request->has('image')) {
                $path = $request->file('image')->store('images', 'store');
            }
            $name = $request->name;
            $data = $request->except('_token', 'image');
            $slug = Str::slug($name);
            $data['image'] = $path;
            $data['slug'] = $slug;
            $products = Product::create($data);

            foreach ($request->colors as $color) {
                $slug = Str::slug($color);
                $products->colors()->create([
                    'color' => $color,
                    'slug' => $slug,
                ]);
            }
            return redirect()->route('dashboard.products.index')
                ->with('success', 'تمت اضافة قسم جديد بنجاح')
                ->with('icon', 'info');
        } else {
            dd('Fails');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        $parents = Category::all();
        // $colors = implode(' | ', $product->colors()->pluck('color')->toArray());
        $colors = $product->colors()->pluck('color');
        return view('dashboard.products.edit', compact('product', 'parents', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        $validator = Validator($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric|exists:categories,id',
            'discount_price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable'
        ]);

        if (!$validator->fails()) {
            $data = $request->except('_token', 'image', 'colors');
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('images', 'store');
                $data['image'] = $path;
            }
            $product->update($data);
            // $colors = explode(',', $request->colors);
            $colors = $request->colors;
            $color_ids = [];
            $colors_pro = Color::all();
            foreach ($colors as $c_color) {
                $slug = Str::slug($c_color);
                $color = $colors_pro->where('slug', $slug)->first();
                if (!$color) {
                    $color = Color::create([
                        'color' => $c_color,
                        'slug' => $slug,
                    ]);
                }
                $color_ids[] = $color->id;
            }

            $product->colors()->sync($color_ids);
            // foreach ($request->colors as $color) {
            // $product->colors()->update([
            //         'color' => $color
            //     ]);
            // }
            return redirect()->route('dashboard.products.index')
                ->with('success', 'تمت اضافة قسم جديد بنجاح')
                ->with('icon', 'info');
        } else {
            dd('Fails');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

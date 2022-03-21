<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->with(['subCategory'=>function($q){
                $q->select('id','name','category_id')->with('category:id,name');
            }])
            ->where('staff_id',auth()->user()->id)
            ->orderByDesc('id')
            ->paginate(15);

        return view('products.index',[
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sub_category_id' => $request->sub_category,
            'staff_id' => auth()->user()->id
        ]);

        if($request->has('images')){
            foreach($request->images as $image){
                $path = $image->store('products/'.auth()->user()->id,'public');
                $product->images()->create([
                    'image_path'=>$path
                ]);
            }
        }

        return redirect()->route('products.index')->with('success','Successfully Product Created');
    }

    public function edit(Product $product)
    {
        $product = $product->load('subCategory.category');
        return view('products.edit',[
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request,Product $product)
    {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'sub_category_id' => $request->sub_category,
        ]);

        if ($request->has('images')) {
            foreach($product->images as $image){
                Storage::disk('public')->delete($image->image_path);
                Image::find($image->id)->delete();
            }
            foreach ($request->images as $image) {
                $path = $image->store('products/' . auth()->user()->id, 'public');
                $product->images()->create([
                    'image_path' => $path
                ]);
            }
        }
        return redirect()->back()->with('success', 'Successfully Product Updated');
    }

    public function destroy(Product $product)
    {
        foreach($product->images as $image){
            Storage::disk('public')->delete($image->image_path);
        }

        $product->delete();
        return redirect()->back()->with('success', 'Successfully Product Deleted');
    }
}

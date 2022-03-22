<?php

namespace App\Http\Controllers;

use App\Http\Requests\InqueryRequest;
use App\Mail\InqueryMail;
use App\Models\category;
use App\Models\Image;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        $categories = category::query()
            ->where('is_hidden',category::VISIBLE)
            ->orderByDesc('id')
            ->paginate(15);
        return view('home',[
            'categories' => $categories
        ]);
    }

    public function showSubCategories(category $category)
    {
        $sub_categories = SubCategory::query()
            ->where('category_id',$category->id)
            ->where('is_hidden',SubCategory::VISIBLE)
            ->orderByDesc('id')
            ->paginate(15);

        return view('subcategories-home',[
            'category' => $category,
            'sub_categories' => $sub_categories
        ]);
    }

    public function showProducts(category $category,SubCategory $sub_category)
    {
        $products = Product::select('id','name')
            ->where('sub_category_id',$sub_category->id)
            ->addSelect(['image_path' => Image::select('image_path')
                ->whereColumn('product_id','products.id')
                ->limit(1)
            ])
            ->orderByDesc('id')
            ->paginate(15);

        return view('products-home',[
            'category' => $category,
            'sub_category' => $sub_category,
            'products' => $products
        ]);
    }

    public function showProduct($id)
    {
        $product = Product::query()
            ->where('id',$id)
            ->with(['images','subCategory'=>function($q){
                $q->select('id','name','category_id')
                    ->with(['category'=>function($q){
                        $q->select('id','name','staff_id')
                            ->with(['staff:id,name']);
                    }]);
            }])
            ->first();

        return view('show-product',[
            'product' => $product
        ]);
    }

    public function sendInquery(Product $product,InqueryRequest $request)
    {
        Mail::to($product->staff)->send(new InqueryMail($request->validated(),$product->toArray()));
        return redirect()->back()->with('success','Inquery Sent');
    }
}

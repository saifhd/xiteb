<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Http\Requests\SubCategoryUpdateRequest;
use App\Models\category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SubCategoriesController extends Controller
{

    public function index()
    {
        $sub_categories = SubCategory::query();

        if(auth()->user()->role->name == "staff"){
            $sub_categories = $sub_categories->where('staff_id', auth()->user()->id);
        }
        $sub_categories = $sub_categories->with('category:id,name')->paginate(15);

        return view('sub_categories.index',[
            'sub_categories' => $sub_categories
        ]);
    }

    public function create()
    {
        $categories = category::select('id','name')
            ->where('staff_id',auth()->user()->id)
            ->where('is_hidden', category::VISIBLE)
            ->get();
        return view('sub_categories.create',[
            'categories' => $categories
        ]);
    }

    public function store(SubCategoryRequest $request)
    {
        $path = $request->file('image')->store('sub_categories/'.auth()->user()->id,'public');

        auth()->user()->subCategories()->create([
            'name' => $request->name,
            'image_path' => $path,
            'category_id' => $request->category
        ]);

        return redirect()->route('sub-categories.index')->with('success', 'Successfully Sub Category Created');
    }

    public function edit(SubCategory $sub_category)
    {
        if (!Gate::allows('sub_category', $sub_category)) {
            abort(403);
        }

        $categories = category::select('id', 'name')
            ->where('staff_id', auth()->user()->id)
            ->where('is_hidden',category::VISIBLE)
            ->get();

        return view('sub_categories.edit',[
            'sub_category' => $sub_category,
            'categories' => $categories
        ]);
    }

    public function  update(SubCategoryUpdateRequest $request,SubCategory $sub_category)
    {
        if (!Gate::allows('sub_category', $sub_category)) {
            abort(403);
        }

        if($request->has('image')){
            if($sub_category->image_path){
                Storage::disk('public')->delete($sub_category->image_path);
            }

            $path = $request->file('image')->store('sub_categories/' . auth()->user()->id, 'public');
            $sub_category->update([
                'image_path' => $path
            ]);
        }
        $sub_category->update([
            'name' => $request->name,
            'category' => $request->category
        ]);

        return redirect()->back()->with('success', 'Successfully Sub Category Updated');
    }

    public function destroy(SubCategory $sub_category)
    {
        if (!Gate::allows('admin_request')) {
            abort(403);
        }

        $sub_category->delete();
        return redirect()->back()->with('success', 'Successfully Sub Category Deleted');
    }

    public function changeStatus(SubCategory $sub_category)
    {
        $sub_category->update([
            'is_hidden' => $sub_category->is_hidden == 0 ? 1 : 0
        ]);
        return redirect()->back()->with('success', 'Successfully Changed Sub Category status');
    }
}

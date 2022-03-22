<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\categoryUpdateRequest;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = category::query();

        if(auth()->user()->role->name == 'staff')
        {
            $categories = $categories->where('staff_id', auth()->user()->id);
        }

        $categories = $categories->orderByDesc('id')->paginate(15);

        return view('categories.index',[
            'categories' =>$categories
        ]);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function Store(CategoryRequest $request)
    {
        $path = $request->file('image')->store('categories/'.auth()->user()->id,'public');

        auth()->user()->categories()->create([
            'name' => $request->name,
            'image_path' => $path
        ]);

        return redirect()->route('categories.index')->with('success','Successfully Category Created');
    }

    public function edit(category $category)
    {
        if (!Gate::allows('category', $category)) {
            abort(403);
        }

        return view('categories.edit',[
            'category' => $category
        ]);
    }

    public function update(Category $category, categoryUpdateRequest $request)
    {
        if (!Gate::allows('category',$category)) {
            abort(403);
        }

        $category->update([
            'name' => $request->name
        ]);
        if($request->has('image')){
            if($category->image_path){
                Storage::disk('public')->delete($category->image_path);
            }
            $path = $request->file('image')->store('categories/' . auth()->user()->id, 'public');
            $category->update([
                'image_path' => $path
            ]);
        }

        return redirect()->back()->with('success', 'Successfully Category Updated');

    }

    public function destroy(Category $category)
    {
        if (!Gate::allows('admin_request')) {
            abort(403);
        }
        $category->delete();
        return redirect()->back()->with('success', 'Successfully Category Deleted');
    }

    public function changeStatus(Category $category)
    {
        $category->update([
            'is_hidden' => $category->is_hidden == 0 ? 1 : 0
        ]);
        return redirect()->back()->with('success', 'Successfully Changed Category status');
    }
}

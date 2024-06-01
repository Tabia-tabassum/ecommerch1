<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\PostCategory;
use App\Models\ProductOffer;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data['allCategories'] = Category::whereNull('parent_id')->cursor();
        return view('admin.category', $data);
    }

    public function storeCategory(Request $request)
    {

        Category::create([
            'name' => $request->input('categoryName'),
            'parent_id' => $request->input('parentCategoryId') !== null && !empty($request->input('parentCategoryId')) ? $request->input('parentCategoryId') : null,
        ]);

        return redirect()->back()->with(['success'=>'Category Created Successfully']);
    }
    public function updateCategory(Request $request)
    {

        Category::findOrFail($request->input('categoryId'))->update([
            'name' => $request->input('categoryName'),
            'parent_id' => $request->input('parentCategoryId') !== null && !empty($request->input('parentCategoryId')) ? $request->input('parentCategoryId') : null,
        ]);

        return redirect()->back()->with(['success'=>'Category updated Successfully']);
    }

    public function deleteCategory(Request $request)
    {

        $id = $request->input('id');

        $responce = Category::where('id', $id)->delete();

        if($responce == 1){
            return 1;
        }

    }

    public function categoryDetails($id)
    {
        $all_blog = Blog::with('category.postCategory')->whereHas('category.postCategory',function ($select) use ($id){
            $select->where('category_id',$id);
        })->get();

        return view('category',['all_blog'=>$all_blog]);
    }
}

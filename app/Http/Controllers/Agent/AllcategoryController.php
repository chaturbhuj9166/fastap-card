<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Sub_category;


class AllcategoryController extends Controller
{
    public function index()
    {
        //return view('admin.allcategory');

       return view('admin.allcategory' ,['allcategory'=> Category::paginate(10) ]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        //return;

        // validate data
        $request->validate([
            'category' => 'required',
            'status' =>'required|not_in:2',
        ]);

        $category = new Category;
        $category->category = $request->category;
        $category->status = $request->status;

        $category->save();
        return redirect('/admin/allcategory')->withSuccess('Category Created !!!!');
    }

    public function destroy($id)
    {
        $category = Category::where('id',$id)->first();
        $category->delete();

        return back()->withSuccess('Category Deleted !!!!');
    }

    public function editcategory($id)
    {
        $category = Category::where('id',$id)->first();
        return view('admin.editcategory' , ['category'=> $category]);
    }

    public function update(Request $request ,$id)
    {
        //dd($request->all());
        //return;

        // validate data
        $request->validate([
            'category' => 'required',
            'status' =>'required|not_in:2',
        ]);
        $category = Category::where('id',$id)->first();

        $category->category = $request->category;
        $category->status = $request->status;

        $category->save();

        return redirect('/admin/allcategory')->withSuccess('Category Updated !!!!');
    }


}

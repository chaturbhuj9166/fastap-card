<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Sub_category;

class AllsubcategoryController extends Controller
{
    public function index()
    {
       // return view('admin.allsubcategory');

       //return view('admin.allsubcategory' ,['allsubcategory'=> Sub_category::paginate(10) ]);
       return view('admin.allsubcategory' ,['allsubcategory'=> Sub_category::paginate(10) , 'allcategory'=> Category::all()]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'category_id' =>'required|not_in:select',
            'sub_category' => 'required',
            'sub_category_slug' => 'required',
            'internal_title' => 'required',
            'internal_desc' => 'required',
            'overview_desc' => 'required',
           // 'overview_image' => 'required|mimes:png|max:10000',
            'overview_image' => 'required|mimes:jpeg,jpg,png|max:10000',
            'pros' => 'required',
            'cons' => 'required',
            'why_how_desc' => 'required',
            //'why_how_image' => 'required|mimes:png|max:10000',
            'why_how_image' => 'required|mimes:jpeg,jpg,png|max:10000',

            'status' =>'required|not_in:2'

        ]);

         // upload image
         $over_view_Name = time().'.'.$request->overview_image->extension();
         $request->overview_image->move(public_path('frontend\assets\images\about\overview'),$over_view_Name);

        // upload image
        $imageName = time().'.'.$request->why_how_image->extension();
        $request->why_how_image->move(public_path('frontend\assets\images\about'),$imageName);




        $subcategory = new Sub_category;

        $subcategory->overview_image = $over_view_Name;

        $subcategory->why_how_image = $imageName;

        $subcategory->category_id = $request->category_id;
        $subcategory->sub_category = $request->sub_category;
        $subcategory->sub_category_slug = $request->sub_category_slug;

        $subcategory->internal_title = $request->internal_title;
        $subcategory->internal_desc = $request->internal_desc;

        $subcategory->overview_desc = $request->overview_desc;

        $subcategory->pros = $request->pros;
        $subcategory->cons = $request->cons;
        $subcategory->why_how_desc = $request->why_how_desc;

        $subcategory->status = $request->status;




        $subcategory->save();
        return redirect('/admin/allsubcategory')->withSuccess('Sub Category Created !!!!');
    }


    public function destroy($id)
    {
        $subcategory = Sub_category::where('id',$id)->first();
        $subcategory->delete();
        return back()->withSuccess('Sub Category Deleted !!!!');
    }

    public function editsubcategory($id)
    {
        $subcategory = Sub_category::where('id',$id)->first();
        return view('admin.editsubcategory' , ['subcategory'=> $subcategory , 'allcategory'=> Category::all()]);
    }


    public function update(Request $request , $id)
    {
            // dd($request->all());
            // return;

        // validate data
        $request->validate([
            'category_id' =>'required|not_in:select',
            'sub_category' => 'required',
            'sub_category_slug' => 'required',
            'internal_title' => 'required',
            'internal_desc' => 'required',

            'overview_desc' => 'required',
            'overview_image' =>  'nullable|mimes:jpeg,jpg,png|max:10000',

            'pros' => 'required',
            'cons' => 'required',
            'why_how_desc' => 'required',

            'status' =>'required|not_in:2',

            // 'why_how_image' => 'nullable|mimes:png|max:10000'
            'why_how_image' => 'nullable|mimes:jpeg,jpg,png|max:10000'
        ]);

        $subcategory = Sub_category::where('id',$id)->first();


        if(isset($request->overview_image))
        {
            // upload image
            $over_view_Name = time().'.'.$request->overview_image->extension();
            $request->overview_image->move(public_path('frontend\assets\images\about\overview'),$over_view_Name);
            $subcategory->overview_image = $over_view_Name;
        }

        if(isset($request->why_how_image))
        {
            // upload image
            $imageName = time().'.'.$request->why_how_image->extension();
            $request->why_how_image->move(public_path('frontend\assets\images\about'),$imageName);
            $subcategory->why_how_image = $imageName;
        }


        $subcategory->category_id = $request->category_id;
        $subcategory->sub_category = $request->sub_category;
        $subcategory->sub_category_slug = $request->sub_category_slug;
        $subcategory->internal_title = $request->internal_title;
        $subcategory->internal_desc = $request->internal_desc;
        $subcategory->overview_desc = $request->overview_desc;
        $subcategory->pros = $request->pros;
        $subcategory->cons = $request->cons;
        $subcategory->why_how_desc = $request->why_how_desc;

        $subcategory->status = $request->status;

        $subcategory->save();
        return redirect('/admin/allsubcategory')->withSuccess('Sub Category Updated !!!!');
    }


}

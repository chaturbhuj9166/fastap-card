<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Sub_category;

class AddnewserviceController extends Controller
{
    public function index()
    {
        return view('admin.addnewservice' , ['allcategory'=> Category::all()] );
    }

    public function getSubcat(Request  $request)
    {
        // echo "tst";
        $category_id = $request->post('category_id');

      //$subcategory = Sub_category::where('category_id',$category_id)->all();
      $subcategory = Sub_category::where('category_id',$category_id)->get();

      //print_r($subcategory);

      $html='<option selected value="select_sub">Select Sub Category type...</option>';

      foreach($subcategory as $subcategory_List){
        $html .='<option value="'.$subcategory_List->id.'"> '.$subcategory_List->sub_category.'  </option>';
      }
      echo $html;

    }
}

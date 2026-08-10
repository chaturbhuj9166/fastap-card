<?php

namespace App\Http\Controllers;

use App\Models\childcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;


class ChildcategoryController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/



public function categoryslist(Request $request){
$data['categoryslist']=DB::table('categories')->where('status',1)->get();
return view('admin/add-childcategory',$data);
}

public function getSubcat(Request $request){
$cid=$request->post('cid');
$getSubcat=DB::table('subcategories')->where('catagory_id',$cid)->where('status',"1")->get();

$html='<option value="">--Select Subcategroy type--</option>';
foreach($getSubcat as $list){
$html.='<option value="'.$list->id.'">'.$list->sub_categroy.'</option>';
}
echo $html;
}


public function add_childcategory(Request $req){
$req->validate([
'childcategroy'=>'required | unique:childcategories,child_categroy',
'image'=>'required',
'editor'=>'required',
'catagory'=>'required',
'subcategory'=>'required',
 'status'=>'required'
]);

$childcategroy = NEW childcategory;
$childcategroy -> catagory_id=$req->catagory;
$childcategroy -> subcategroy_id=$req->subcategory;
$childcategroy -> child_categroy=$req->childcategroy;
$childcategroy -> description=$req->editor;
$childcategroy -> status=$req->status;


if ($req->hasFile('image')) {
$image = $req->file('image');
$Extension = $image->getClientOriginalExtension();
$filename =time().'.'.$Extension;
$destinationPath = public_path('uploads/Child_categroy');
$imagePath = $destinationPath. "/".  $filename;
$image->move($destinationPath, $filename);
$childcategroy->image = $filename;
}



$childcategroy -> save();

return redirect('admin/view-Childcategory')->with('success','Childcategroy Added Successfully');

}


public function show(childcategory $childcategory)
{
      $data = DB::table('childcategories')
            ->join('subcategories', 'childcategories.subcategroy_id', '=', 'subcategories.id')
            ->join('categories', 'categories.id', '=', 'subcategories.catagory_id')
      ->select('categories.categroy', 'subcategories.sub_categroy', 'childcategories.child_categroy','childcategories.image','childcategories.status','childcategories.id')
      ->paginate(10);

    

return view('admin/view-Childcategory',['view_Childcategory'=>$data]);
}

public function updatecatStatus(Request $request)
{
$user = childcategory::findorfail($request->id);


$user->status = $request->status;
$user->save();

return response()->json(['message' => 'Childcategory status updated successfully.']);
}


function select($id){

$childcatupdate = Crypt::decrypt($id);
$datas = childcategory::find($childcatupdate);

return view('admin/update-childcategroy',['upadatechildcat'=>$datas]);

}


function edit(request $req){

$childcategroy = childcategory::find($req->id);

$childcategroy -> child_categroy=$req->childcategory;
$childcategroy -> description=$req->editor;



if ($req->hasFile('image')) {
$image = $req->file('image');
$Extension = $image->getClientOriginalExtension();
$filename =time().'.'.$Extension;
$destinationPath = public_path('uploads/Child_categroy');
$imagePath = $destinationPath. "/".  $filename;
$image->move($destinationPath, $filename);
$childcategroy->image = $filename;
}

$childcategroy -> save();

return redirect('admin/view-Childcategory')->with('warning','Child-Category Successfully Updated');

}

public function deletechildcategroy($id) {
$childcatdelete = Crypt::decrypt($id);
$image = childcategory::find($childcatdelete);
$destinationPath = public_path("uploads/Child_categroy/{$image->image	}");
if (File::exists($destinationPath)) {
File::delete($destinationPath);
}else{

echo  'no File exists';
}
$image->delete();

return back()->with('error','Child-category Successfully Deleted');



}
}

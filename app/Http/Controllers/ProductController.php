<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\brand_logo;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;

class ProductController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function categoryslist(Request $requestuest){
$data['categoryslist']=DB::table('categories')->orderBy('categroy','asc')->where('status',1)->get();
return view('admin-new.product.add',$data);
}


public function getsubcat(Request $request){
$cid=$request->post('cid');
$getSubcat=DB::table('subcategories')->where('catagory_id',$cid)->orderBy('sub_categroy','asc')->where('status',"1")->get();

$html='<option value="">Select Subcategroy</option>';
foreach($getSubcat as $list){
$html.='<option value="'.$list->id.'">'.$list->sub_categroy.'</option>';
}
echo $html;
}



public function add_product(Request $request){
$request->validate([
'pro_name'=>'required | unique:products,pro_name',
'pro_img'=>'required',
'pro_multi_img'=>'required',
'pro_price'=>'required',
'pro_mrp'=>'required',
'editor'=>'required',
'status'=>'required',
]);


$pro =new product;
$pro->catagory_id=$request->catagory;
$pro->pro_name=$request->pro_name;
$pro->url = Str::slug($request->pro_name);
$pro->pro_price=$request->pro_price;
$pro->pro_mrp=$request->pro_mrp;
$pro->pro_description=$request->editor;
$pro->status=$request->status;
$pro->commission=$request->commission;

if ($request->hasFile('pro_img')) {
$image = $request->file('pro_img');
$Extension = $image->getClientOriginalExtension();
$filename =time().'.'.$Extension;
$destinationPath = public_path('uploads/product_images/product_single_img');
$imagePath = $destinationPath. "/".  $filename;
$image->move($destinationPath, $filename);
$pro->pro_img = $filename;
}

 if($request->hasfile('pro_multi_img'))
             {
                foreach($request->file('pro_multi_img') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/product_images/product_multi_img//';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
                $pro->pro_multi_img = json_encode($Imgdata);
             }
    

$pro->save();

return redirect('admin/view-product')->with('success','Product Added Susscssfully');

}


public function proselect(Request $request){

    $view = product::paginate(10);

    return view('admin-new.product.index',['proview'=>$view]);


}

public function updateStatus(Request $request)
{
$user = product::findorfail($request->id);


$user->status = $request->status;
$user->save();

return response()->json(['message' => 'Product status updated successfully.']);
}


public function deleteproduct($id) {
$prodelete = Crypt::decrypt($id);
$image = product::find($prodelete);
$destinationPath = public_path("uploads/product_images/product_single_img/{$image->pro_img}");
if (File::exists($destinationPath)) {
File::delete($destinationPath);
}else{

echo  'no File exists';
}
$image->delete();

return back()->with('error','Product Successfully Deleted');



}

public function singalproduct($id){
    
    $pid = crypt::decrypt($id);
    
    $pro['singal'] = product::find($pid);


//  ->join('subcategories', 'products.subcategroy_id', '=', 'subcategories.id')
// ->join('categories', 'categories.id', '=', 'subcategories.catagory_id')
//  ->select('categories.categroy', 'subcategories.sub_categroy','products.*');
      
//     print_r($pid);
//     die;
      
      
return view('admin/view-singal-product',$pro);
}





public function updateselectproduct($id){
    
   
    $updateselectproduct = crypt::decrypt($id);

    $data = product::find($updateselectproduct);
  
     return view('admin/update_product',['proselect'=>$data]);

}

function edit(request $req){
    


$pro = product::find($req->id);

$pro->pro_name=$req->pro_name;
$pro->pro_price=$req->pro_price;
$pro->pro_mrp=$req->pro_mrp;
$pro->pro_description=$req->editor;
$pro->commission=$req->commission;



if ($req->hasFile('pro_img')) {
$image = $req->file('pro_img');
$Extension = $image->getClientOriginalExtension();
$filename =time().'.'.$Extension;
$destinationPath = public_path('uploads/product_images/product_single_img');
$imagePath = $destinationPath. "/".  $filename;
$image->move($destinationPath, $filename);
$pro->pro_img = $filename;
}

 if($req->hasfile('pro_multi_img'))
             {
                foreach($req->file('pro_multi_img') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/product_images/product_multi_img//';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
                $pro->pro_multi_img = json_encode($Imgdata);
             }

$pro -> save();

return redirect('admin/view-product')->with('warning','Product Successfully Updated');

}



public function view_brand_logo_view(){
    $logo=brand_logo::paginate(10);

    return view('admin-new.brand.index',compact('logo'));
}

public function add_logo(Request $request){
    $logo= new brand_logo;
    $logo->title=$request->title;
    
  if ($request->hasFile('logo')) {
$image = $request->file('logo');
$Extension = $image->getClientOriginalExtension();
$filename =time().'.'.$Extension;
$destinationPath = public_path('uploads/product_images/');
$imagePath = $destinationPath. "/".  $filename;
$image->move($destinationPath, $filename);
$logo->logo = $filename;
}
    $logo->save();
return redirect('admin/view-brand_logo')->with('warning','Logo Successfully Add');
  
}
public function brand_logo_delete($id){
 $logo=brand_logo::where('id',$id)->first();
 $logo->delete();
return redirect('admin/view-brand_logo');
  
}

public function brand_logo_update($id){
 $logo=brand_logo::where('id',$id)->first();

return view('admin/view-brand_logo_update',compact('logo'));
  
}

public function view_faq()
{
    $show_info = Faq::orderBy('id','asc')->paginate(15);
    return view('admin-new.faq.index',compact('show_info'));
}

public function add_faq()
{

    return view('admin-new.faq.add');
}

public function faq_data(Request $request)
{
    // $d = $request->input();
    // dd($d);
    $request->validate([
'name'=>'required',
'description'=>'required',
// 'image'=>'required',
]);

$faq =new Faq;
$faq->name=$request->name;
$faq->description=$request->description;


if ($request->hasFile('image')) {
$image = $request->file('image');
$Extension = $image->getClientOriginalExtension();
$filename =time().'.'.$Extension;
$destinationPath = public_path('uploads/faq/');
$imagePath = $destinationPath. "/".  $filename;
$image->move($destinationPath, $filename);
$faq->image = $filename;
}
if($faq->save()){
return redirect('admin/view-faq')->with('success','Faq Added Susscssfully');
}
else{
    return back()->with('error','Error');
}
}

public function faq_delete($id)
{
    $faq=Faq::where('id',$id)->get()->first();
    if($faq->delete()){
    return back()->with('success','Faq`s Delete Successfully');
    }
    else{
        return back()->with('error','Error');
    }
}

public function edit_faq($id)
{
    $edit_info = Faq::where('id',$id)->get()->first();
    return view('admin/faq/edit',compact('edit_info'));
}

public function faq_update(Request $request , $id)
{
   $faq_edit =Faq::find($id);
$faq_edit->name=$request->name;
$faq_edit->description=$request->description;


if ($request->hasFile('image')) {
$image = $request->file('image');
$Extension = $image->getClientOriginalExtension();
$filename =time().'.'.$Extension;
$destinationPath = public_path('uploads/faq/');
$imagePath = $destinationPath. "/".  $filename;
$image->move($destinationPath, $filename);
$faq_edit->image = $filename;
}else{
    
}
if($faq_edit->update()){
return redirect('admin/view-faq')->with('success','Faq Update Susscssfully');
}
else{
    return back()->with('error','Error');
}
 
}


}

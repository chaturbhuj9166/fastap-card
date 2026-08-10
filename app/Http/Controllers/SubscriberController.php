<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\Order;
use App\Models\OrderMeta;
use App\Models\OrderProduct;

use App\Models\Cart;
use App\Models\websetting;

use App\Models\contact;
use App\Models\corporate;
use App\Models\Testimonial;
use App\Models\Qualification;
use App\Models\Profession;
use App\Models\Thought;
use App\Models\Portfolio;
use App\Models\customer;
use App\Models\subscibe_channel;
use App\Models\Social;
use App\Models\coupon;
use App\Models\Subscriber;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Session;

class SubscriberController extends Controller
{
 
 
 public function subscribers_view(){
$data = Subscriber::orderBy('name','asc')->where('status',1)->get();
return view('admin/subscriber/index',compact('data'));
}

public function add_subscribers(Request $request){
$request->validate([
'name'=>'required',
'email'=>'required',
'mobile'=>'required',
]);


$pro =new Subscriber;
$pro->name=$request->name;
$pro->email=$request->email;
$pro->mobile=$request->mobile;
$pro->save();

return redirect('/')->with('message_subscribers','subscribers Added Susscssfully');

}

public function subscribersdelete($id){
 $logo=Subscriber::where('id',$id)->first();
 $logo->delete();
return redirect('admin/subscriber/index')->with('success','subscribers Delete Susscssfully');
  
}
 
}
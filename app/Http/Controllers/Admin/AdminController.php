<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
      
use App\Models\Admin; 
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Crypt; 
use App\Models\websetting; 
use App\Models\category; 
use App\Models\Order; 
use App\Models\OrderMeta; 
use App\Models\OrderProduct;   
use App\Models\customer; 
use App\Models\subcategory; 
use App\Models\Testimonial;  
use App\Models\Price; 
                         
use App\Models\User; 
use App\Models\Contact;  
use App\Models\Corporate;
use App\Models\Qualification;
use App\Models\Profession;
use App\Models\Thought;
use App\Models\Portfolio; 
use App\Models\offer;
use App\Models\subscibe_channel;
use App\Models\Social; 
use App\Models\coupon;
use App\Models\Pricing_Plans;

use App\Models\Video;
use App\Models\Professional_photo;
use App\Models\Myproduct;
use App\Models\ProfessionTheme;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\RestaurantInfo;
use App\Models\Company;
use App\Models\CompanyStaff;
use App\Models\ProfileEngagement;

use sendmail;

use Hash;
use Illuminate\Support\Facades\DB;

// // For show data in viewagent 
use App\Models\Agent;
use App\Models\Notification;

use App\Models\Preorder;


use Carbon\Carbon; // Import the Carbon library to work with dates
// //

use Illuminate\Support\Facades\Validator;
use Session;


class AdminController extends Controller
{
    
    public function changeorderstatus(Request $request){
        
        
          $user = Order::findorfail($request->id);
        

    $user->status = $request->status;
    $user->save();

    return response()->json(['message' => 'Order status updated successfully.']);

    }
    
    
    function check(Request $request){
         //Validate Inputs
         $request->validate([
            'email'=>'required|email|exists:admins,email',
            'password'=>'required|min:5|max:30'
         ],[
             'email.exists'=>'This email is not exists in admins table'
         ]);

         $creds = $request->only('email','password');

         if( Auth::guard('admin')->attempt($creds) ){
             return redirect()->route('admin.index');
         }else{
             return redirect()->route('admin.login')->with('error','Invalid E-mail Or Password');
         }
    }

    function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
    
    
    /****************************************************************************************Admin Auth End*************************************************************************************************************/

/****************************************************************************************Web Setting Start*************************************************************************************************************/


function websetting(request $req){

    $req->validate([
        'companynames'=>'required',
        'email'=>'required',
        'mobile'=>'required'
       ]);

  
$websetting = NEW websetting;
$websetting -> companynames=$req->companynames;
$websetting -> email=$req->email;
$websetting -> mobile=$req->mobile;
$websetting -> tagline=$req->tagline;
$websetting -> address=$req->address;
$websetting -> abouttitle=$req->abouttitle;
$websetting -> description=$req->editor;
$websetting -> facebook=$req->facebook;
$websetting -> instagram=$req->instagram;
$websetting -> twitter=$req->twitter;
$websetting -> linkdin=$req->linkdin;
$websetting -> youtube=$req->youtube;
$websetting -> Pinterest=$req->Pinterest;
$websetting -> veriety_of_pro=$req->veriety_of_pro;
$websetting -> Testimonial_title=$req->Testimonial_title;

if ($req->hasFile('logo')) {
    $logo = $req->file('logo');
    $Extension = $logo->getClientOriginalExtension();
    $logoname =time().'logo.'.$Extension;
    $destinationPath = public_path('uploads/system_setting');
    $logoPath = $destinationPath. "/".  $logoname;
    $logo->move($destinationPath, $logoname);
    $websetting->logo = $logoname;
  }

  if ($req->hasFile('favicon')) {
    $favicon = $req->file('favicon');
    $Extension = $favicon->getClientOriginalExtension();
    $faviconname =time().'favicon.'.$Extension;
    $destinationPath = public_path('uploads/system_setting');
    $faviconPath = $destinationPath. "/".  $faviconname;
    $favicon->move($destinationPath, $faviconname);
    $websetting->favicon = $faviconname;
  }

  if ($req->hasFile('footerlogo')) {
    $footerlogo = $req->file('footerlogo');
    $Extension = $footerlogo->getClientOriginalExtension();
    $footerlogoname =time().'footerlogo.'.$Extension;
    $destinationPath = public_path('uploads/system_setting');
    $footerlogoPath = $destinationPath. "/".  $footerlogoname;
    $footerlogo->move($destinationPath, $footerlogoname);
    $websetting->footerlogo = $footerlogoname;
  }

 if($req->hasfile('Aboutimg'))
             {
                foreach($req->file('Aboutimg') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/system_setting/';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
                $websetting->Aboutimg = json_encode($Imgdata);
             }

$websetting -> save();

return back()->with('success','Successfully Submited');

}


function viewwebsetting(){


    $data = websetting::All();

   return view('admin-new.settings.index',['viewwebsettings'=>$data]);
}

function updatedata($id){
    
    $catupdate = crypt::decrypt($id);

    $data = websetting::find($catupdate);
  
     return view('admin/updatewebsetting',['upadates'=>$data]);

}



function updatewebsetting(Request $req){

    $websetting = websetting::find($req->id);
    

 $websetting -> companynames=$req->companynames;

$websetting -> email=$req->email;
$websetting -> mobile=$req->mobile;
// $websetting -> tagline=$req->tagline;
$websetting -> address=$req->address;
// $websetting -> abouttitle=$req->abouttitle;
// $websetting -> description=$req->editor;
$websetting -> facebook=$req->facebook;
$websetting -> instagram=$req->instagram;
$websetting -> twitter=$req->twitter;
$websetting -> linkdin=$req->linkdin;
$websetting -> youtube=$req->youtube;
$websetting -> veriety_of_pro=$req->veriety_of_pro;
$websetting -> testimonial_title=$req->testimonial_title;
$websetting -> Pinterest=$req->Pinterest;
$websetting -> home_banner_heading_2=$req->home_banner_heading_2;
$websetting -> home_banner_heading_1=$req->home_banner_heading_1;

if($req->hasfile('brandlogo'))
             {
                foreach($req->file('brandlogo') as $file)
                {
                      
                        $Extension = $file->getClientOriginalExtension();
                        $logoname =time().'logo.'.$Extension;
                        $destinationPath = public_path('uploads/system_setting');
                        $logoPath = $destinationPath. "/".  $logoname;
                        $file->move($destinationPath, $logoname);
                        
                     $Imgdata[] = $logoname;
                }
                $websetting->brand_logo = json_encode($Imgdata);
             }


if ($req->hasFile('logo')) {
    $logo = $req->file('logo');
    $Extension = $logo->getClientOriginalExtension();
    $logoname =time().'logo.'.$Extension;
    $destinationPath = public_path('uploads/system_setting');
    $logoPath = $destinationPath. "/".  $logoname;
    $logo->move($destinationPath, $logoname);
    $websetting->logo = $logoname;
  }else{
    $websetting -> logo=$req->logohidden;
  }

  if ($req->hasFile('favicon')) {
    $favicon = $req->file('favicon');
    $Extension = $favicon->getClientOriginalExtension();
    $faviconname =time().'favicon.'.$Extension;
    $destinationPath = public_path('uploads/system_setting');
    $faviconPath = $destinationPath. "/".  $faviconname;
    $favicon->move($destinationPath, $faviconname);
    $websetting->favicon = $faviconname;
  }else{
    $websetting -> favicon=$req->faviconhidden;
  }


  if ($req->hasFile('footerlogo')) {
    $footerlogo = $req->file('footerlogo');
    $Extension = $footerlogo->getClientOriginalExtension();
    $footerlogoname =time().'footerlogo.'.$Extension;
    $destinationPath = public_path('uploads/system_setting');
    $footerlogoPath = $destinationPath. "/".  $footerlogoname;
    $footerlogo->move($destinationPath, $footerlogoname);
    $websetting->footerlogo = $footerlogoname;
  }else{
    $websetting -> footerlogo=$req->footerlogohidden;
  }

 if($req->hasfile('Aboutimg'))
             {
                foreach($req->file('Aboutimg') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/system_setting/';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
                $websetting->Aboutimg = json_encode($Imgdata);
             }

$websetting -> save();

return redirect('admin/viewwebsetting')->with('success','Successfully Updated');

}




/**************************************************************************************WEB SETTING END***************************************************************************************************************/


/****************************************************************************************Categroy Start*************************************************************************************************************/


function addcategroy(request $req){

    $req->validate([
        'categroy'=>'required | unique:categories,categroy',
        'image'=>'required',
         'editor'=>'required',
         'status'=>'required'
       ]);
       
       $categroy = NEW category;
$categroy -> categroy=$req->categroy;
$categroy -> description=$req->editor;
$categroy -> status=$req->status;



if ($req->hasFile('image')) {
    $image = $req->file('image');
    $Extension = $image->getClientOriginalExtension();
    $filename =time().'.'.$Extension;
    $destinationPath = public_path('uploads/category');
    $imagePath = $destinationPath. "/".  $filename;
    $image->move($destinationPath, $filename);
    $categroy->image = $filename;
  }
  
  
  
  $categroy -> save();

return redirect('admin/viewcategroy')->with('success','Category Successfully Submited');

}

function viewcategroy(){


    $data = category::paginate(10);

   return view('admin-new.category.index',['viewcategroy'=>$data]);
}


function updatecatagroydata($id){
    
    $catupdate = Crypt::decrypt($id);
$datas = category::find($catupdate);


     return view('admin/updatecategroy',['upadatecate'=>$datas]);

}

function updatecategroy(request $req){
    


 $categroy = category::find($req->id);

$categroy -> categroy=$req->categroy;
$categroy -> description=$req->editor;




if ($req->hasFile('image')) {
    $image = $req->file('image');
    $Extension = $image->getClientOriginalExtension();
    $filename =time().'.'.$Extension;
    $destinationPath = public_path('uploads/category');
    $imagePath = $destinationPath. "/".  $filename;
    $image->move($destinationPath, $filename);
    $categroy->image = $filename;
  }
  
  $categroy -> save();

return redirect('admin/viewcategroy')->with('warning','Category Successfully Updated');

}




public function deletecategroy($id) {
    $catupdate = Crypt::decrypt($id);
    $image = category::find($catupdate);
    $destinationPath = public_path("uploads/category/{$image->image	}");
    if (File::exists($destinationPath)) {
        File::delete($destinationPath);
    }else{
        
      echo  'no File exists';
    }
    $image->delete();

      return back()->with('error','Category Successfully Deleted');



}

public function updateStatus(Request $request)
{
    $user = category::findorfail($request->id);
        

    $user->status = $request->status;
    $user->save();

    return response()->json(['message' => 'category status updated successfully.']);
}


/**************************************************************************************Categroy END***************************************************************************************************************/


/****************************************************************************************Sub Categroy Start*************************************************************************************************************/

function add_subcategroy(request $req){

    $req->validate([
        'subcategroy'=>'required | unique:subcategories,sub_categroy',
        'image'=>'required',
         'catagory_id'=>'required',
         'editor'=>'required',
          'status'=>'required'
       ]);
       
       $subcategroy = NEW subcategory;
$subcategroy -> sub_categroy=$req->subcategroy;
$subcategroy -> description=$req->editor;
$subcategroy -> catagory_id=$req->catagory_id;
$subcategroy -> status=$req->status;




if ($req->hasFile('image')) {
    $image = $req->file('image');
    $Extension = $image->getClientOriginalExtension();
    $filename =time().'.'.$Extension;
    $destinationPath = public_path('uploads/subcategory');
    $imagePath = $destinationPath. "/".  $filename;
    $image->move($destinationPath, $filename);
    $subcategroy->image = $filename;
  }
  
  $subcategroy -> save();

return redirect('admin/view-subcategory')->with('success','Sub-Category Successfully Submited');

}


function view_subcategroy(){


    // $data = subcategory::paginate(10);
    
 $data = DB::table('categories')->join('subcategories','categories.id','=','subcategories.catagory_id')
 ->where('categories.status',"1")
->paginate(10);


   return view('admin/view-subcategory',['viewsubcategroys'=>$data]);
  
}


function selectcategory(){
$users = DB::select('select * from categories where status = :status', ['status' => 1]);

return view('admin/add-subcategory',['selectcategorys'=>$users]);
}


function update_subcatagroydata($id){
    $prodID = Crypt::decrypt($id);
    $datas = subcategory::find($prodID);

     return view('admin/update-subcategory',['upadatesubcate'=>$datas]);

}


function update_subcategroy(request $req){

 $subcategroy = subcategory::find($req->id);
$subcategroy -> sub_categroy=$req->subcategroy;
$subcategroy -> description=$req->editor;




if ($req->hasFile('image')) {
    $image = $req->file('image');
    $Extension = $image->getClientOriginalExtension();
    $filename =time().'.'.$Extension;
    $destinationPath = public_path('uploads/subcategory');
    $imagePath = $destinationPath. "/".  $filename;
    $image->move($destinationPath, $filename);
    $subcategroy->image = $filename;
  }
  
  $subcategroy -> save();

return redirect('admin/view-subcategory')->with('success','Sub-Category Successfully Updated');

}




function deletesubcategroy($id){
    $prodID = crypt::decrypt($id);
    $data= subcategory::find($prodID);
        $destinationPath = public_path("uploads/subcategory/{$data->image}");
    if (File::exists($destinationPath)) {
        File::delete($destinationPath);
    }else{
        
      echo  'no File exists';
    }
    $data->delete();
    
   return back()->with('error','Sub Category Successfully Deleted');;



}



public function updatecatStatus(Request $request)
{
    $user = subcategory::findorfail($request->id);
        

    $user->status = $request->status;
    $user->save();

    return response()->json(['message' => 'subcategory status updated successfully.']);
}


//my work
public function orders(Request $request){
    // $orders = Order::join('customers','customers.id','=','orders.user_id')->select('orders.*','customers.name as name')->orderBy('orders.id','desc')->get();
   $orders=order::with('user')->orderBy('orders.id','desc')->paginate(20);
    return view('admin-new.order.index',['orders'=>$orders]);
}

public function orderview(Request $request,$id){
   // return $id;
    $d['order'] = Order::where('id',$id)->first();
    $d['ordermeta'] = OrderMeta::where('order_id',$id)->first();
    $d['allorder'] = OrderProduct::where('order_id',$id)->get();
    return view('admin-new.order.view',$d);
}

/* preorder section start */

public function preorder(Request $request){
    $preorders = Preorder::paginate(10);
    return view('admin-new.preorder.index',['preorders'=>$preorders]);
}

/* preorder section end */

/* anand start code manage agent */

public function manageagent(Request $request){

    $agents = Agent::paginate(10);
    return view('admin-new.agent.index',['agents'=>$agents]);
}

public function addagent(Request $request)
{
    return view('admin-new.agent.add');
}

public function addagentstore(Request $request)
{
    // dd($request->all());
    // return;
    
    $request->validate([
    'name'=>'required',
    'mobile'=>'required',
    'alternative_mobile'=>'required',
    'address'=>'required',
    'email'=>'required',
    'password'=>'required',
    'agent_code' => 'required|unique:agents,agent_code',
    'aadhar_front'=>'required',
    'aadhar_back'=>'required',
    
    'status'=>'required|not_in:select',
    ]);

    
    $agent =new Agent;
    $agent->name=$request->name;
    $agent->mobile=$request->mobile;
    $agent->alternative_mobile=$request->alternative_mobile;
    $agent->address=$request->address;
    $agent->email=$request->email;
    
    $agent->password=$request->password;
    $agent->agent_code=$request->agent_code;
    $agent->status=$request->status;
    
    
    if ($request->hasFile('aadhar_front')) {
        $image = $request->file('aadhar_front');
        $Extension = $image->getClientOriginalExtension();
        $filename =time().'.'.$Extension;
        $destinationPath = public_path('uploads/aadhar/aadhar_front');
        $imagePath = $destinationPath. "/".  $filename;
        $image->move($destinationPath, $filename);
        $agent->aadhar_front = $filename;
    }
    
    if ($request->hasFile('aadhar_back')) {
        $image = $request->file('aadhar_back');
        $Extension = $image->getClientOriginalExtension();
        $filename =time().'.'.$Extension;
        $destinationPath = public_path('uploads/aadhar/aadhar_back');
        $imagePath = $destinationPath. "/".  $filename;
        $image->move($destinationPath, $filename);
        $agent->aadhar_back = $filename;
    }

    
    $agent->save();
    
    return redirect('admin/manageagent')->with('success','Agent Added Susscssfully');
    

}

public function agentdelete($id) 
{
    // $agentelete = Crypt::decrypt($id);
    // $image = Agent::find($agentelete);
    // $aadhar_front_destinationPath = public_path("uploads/aadhar/aadhar_front/{$image->aadhar_front}");
    // $aadhar_front_destinationPath = public_path("uploads/aadhar/aadhar_back/{$image->aadhar_back}");

    // if (File::exists($aadhar_front_destinationPath)) {
    //     File::delete($aadhar_front_destinationPath);
    // }else{
    //  echo  'no File exists';
    // }
    
    // if (File::exists($aadhar_back_destinationPath)) {
    //     File::delete($aadhar_back_destinationPath);
    // }else{ echo  'no File exists';}
    // $image->delete();
    
    $agent = Agent::where('id',$id)->first();
    $agent->delete();
    
    return back()->with('error','Agent Successfully Deleted');
}


public function editagent($id)
{
    $agent = Agent::where('id',$id)->first();
    return view('admin.editagent' , ['agent'=> $agent]);
}

public function agentupdate(Request $request , $id)
{
  /*  dd($request->all());
    return;*/
    
    $request->validate([
    'name'=>'required',
    'mobile'=>'required',
    'alternative_mobile'=>'required',
    'address'=>'required',
    'email'=>'required',
    'password'=>'required',
    'agent_code' => 'required|unique:agents,agent_code,' . $id,
    'aadhar_front'=>'nullable',
    'aadhar_back'=>'nullable',
    
    'status'=>'required|not_in:select',
    ]);

   $agent = Agent::where('id',$id)->first();
   
    $agent->name=$request->name;
    $agent->mobile=$request->mobile;
    $agent->alternative_mobile=$request->alternative_mobile;
    $agent->address=$request->address;
    $agent->email=$request->email;
    
    $agent->password=$request->password;
    $agent->agent_code=$request->agent_code;
    $agent->status=$request->status;
    
    
    if ($request->hasFile('aadhar_front')) {
        $image = $request->file('aadhar_front');
        $Extension = $image->getClientOriginalExtension();
        $filename =time().'.'.$Extension;
        $destinationPath = public_path('uploads/aadhar/aadhar_front');
        $imagePath = $destinationPath. "/".  $filename;
        $image->move($destinationPath, $filename);
        $agent->aadhar_front = $filename;
    }
    
    if ($request->hasFile('aadhar_back')) {
        $image = $request->file('aadhar_back');
        $Extension = $image->getClientOriginalExtension();
        $filename =time().'.'.$Extension;
        $destinationPath = public_path('uploads/aadhar/aadhar_back');
        $imagePath = $destinationPath. "/".  $filename;
        $image->move($destinationPath, $filename);
        $agent->aadhar_back = $filename;
    }

    
    $agent->save();
    
    return redirect('admin/manageagent')->with('success','Agent Added Susscssfully');
    

}


public function viewagent($id)
{
        $agent_id = $id;
        
        // Get Notification start //
        $agent = Agent::where('id',$agent_id)->first();
        $notification = Notification::where('agent_id',$agent_id)->latest()->paginate(10);
        
        // Get Notification end //
        
        
        // Order count start for Total Orders box
        $TotalOrders = Order::where('agent_code', '=', $agent_id)
                   ->orderBy('created_at', 'desc')
                   ->get();
                   
        // Order count end for Total Orders box
    
        
        // Get Earning This Month & Orders This Month for dashboard 4 boxes 
        // Get the current month's first day and last day
        $currentMonthFirstDay = Carbon::now()->startOfMonth();
        $currentMonthLastDay = Carbon::now()->endOfMonth();
        
        // Fetch the orders for the current month using date range
        $topOrdersThisMonth = Order::where('agent_code', '=', $agent_id)
                       ->whereBetween('created_at', [$currentMonthFirstDay, $currentMonthLastDay])
                       ->get();
        
        // Total order count for the current month
        $totalOrdersThisMonth = $topOrdersThisMonth->count();
        
        $topOrderIds = $topOrdersThisMonth->pluck('id');

        $topOrderMeta = OrderMeta::whereIn('order_id', $topOrderIds)->get();
        
        // Fetch agent data for the current agent
        $currentAgent = Agent::where('id', '=', $agent_id)->first();
        
        // Calculate the total earning for the current month
        $earningThisMonth = 0;
        
        foreach ($topOrdersThisMonth as $order) {
            $relatedOrderMeta = $topOrderMeta->where('order_id', $order->id);
        
            foreach ($relatedOrderMeta as $orderMetaItem) {
                $totalAmount = $order->total_amount; // Replace with your actual total amount
                $percentage = $order->agent_commission; // Replace with the percentage you want to calculate
        
                $calculatedPercentage = ($percentage / 100) * $totalAmount;
                $earningThisMonth += $calculatedPercentage;
            }
        }
    /////////
        
    // $agent = Agent::where('id',$id)->first();
    // return view('admin.viewagent' , ['agent'=> $agent]);
    
    return view('admin.viewagent' , ['agent' => $agent , 'notification' =>$notification , 'TotalOrders' =>$TotalOrders , 'totalOrdersThisMonth' =>$totalOrdersThisMonth , 'earningThisMonth' => $earningThisMonth,]);
}

// Noficiation start 

    public function storenotification(Request $request)
    {
        // dd($request->all());
        // return;
        // validate data
        $request->validate([
            'title' =>'required',
            'agent_id'=>'required',
            'description' => 'required',
        ]);
        $notification = new Notification;
        $notification->title = $request->title;
        $notification->agent_id = $request->agent_id;
        $notification->description = $request->description;

        $notification->save();
        return back()->withSuccess('Notification Created !!!!');
    }
    
    public function destroynotification($id)
    {
        $notification = Notification::where('id',$id)->first();
        $notification->delete();

        return back()->withSuccess('Notification Deleted !!!!');
    }
    
    public function editnotification($id , $agent_id)
    {
        $agent = Agent::where('id',$agent_id)->first();
        $notification = Notification::where('id',$id)->first();

        return view('admin.editnotification' , ['agent'=> $agent , 'notification'=> $notification]);
    }

    public function updatenotification(Request $request ,$id)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'title' =>'required',
            'agent_id'=>'required',
            'description' => 'required'
        ]);

        $notification = Notification::where('id',$id)->first();

        $notification->title = $request->title;
        $notification->agent_id = $request->agent_id;
        $notification->description = $request->description;

        $notification->save();
        // return redirect('/admin/allusers')->withSuccess('User Updated !!!!');
        return back()->withSuccess('Notification Updated !!!!');
    }
    
    
// Notification end


public function updateagentStatus(Request $request)
{
    $agent = Agent::findorfail($request->id);
    
    
    $agent->status = $request->status;
    $agent->save();
    
    return response()->json(['message' => 'Agent status updated successfully.']);
}




/* anand end code manage agent */



/* anand start code for user block and unblock from userpanel & profile */

public function updateuserPermission(Request $request)
{
    $customer = customer::findorfail($request->id);
    
    $customer->permission = $request->permission;
    $customer->save();
    
    return response()->json(['message' => 'User permission updated successfully.']);
}

/* anand end code for user block and unblock from userpanel & profile */
 
 
/* anand start code for panel permission user and gold panel */
 
public function updatePanel_status(Request $request)
{  
    $customer = customer::findorfail($request->id); 
    
    $customer->panel_status = $request->panel_status;
    $customer->save();  
    
    return response()->json(['message' => 'User Panel Status updated successfully.']);
}

/* anand end code for panel permission user and gold panel */


/**************************************************************************************Sub_Categroy END***************************************************************************************************************/

  
/**************************************************************************************Child Categroy Start*************************************************************************************************************/

public function userdashboard(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');

        if(!empty($user_id)){
            $user = customer::find($user_id);

            // Use redesigned dashboard
            $now = Carbon::now();
            $currentStart = $now->copy()->subDays(30);
            $previousStart = $now->copy()->subDays(60);
            $previousEnd = $currentStart->copy();

            $engagements = ProfileEngagement::where('customer_id', $user_id);
            $profileViews = (clone $engagements)->where('action', 'view')->count();
            $totalShares = (clone $engagements)->where('action', 'share')->count();
            $contactsSaved = (clone $engagements)->where('action', 'contact_save')->count();

            $trendPercent = function ($action) use ($user_id, $currentStart, $previousStart, $previousEnd) {
                $current = ProfileEngagement::where('customer_id', $user_id)
                    ->where('action', $action)
                    ->where('created_at', '>=', $currentStart)
                    ->count();
                $previous = ProfileEngagement::where('customer_id', $user_id)
                    ->where('action', $action)
                    ->where('created_at', '>=', $previousStart)
                    ->where('created_at', '<', $previousEnd)
                    ->count();

                if ($previous === 0) {
                    return 0;
                }

                return (int) round((($current - $previous) / $previous) * 100);
            };

            $profileViewsTrend = $trendPercent('view');
            $sharesTrend = $trendPercent('share');
            $contactsTrend = $trendPercent('contact_save');

            return view('userdashboard-new.index', [
                'user' => $user,
                'profileViews' => $profileViews,
                'totalShares' => $totalShares,
                'contactsSaved' => $contactsSaved,
                'profileViewsTrend' => $profileViewsTrend,
                'sharesTrend' => $sharesTrend,
                'contactsTrend' => $contactsTrend,
            ]);
        }else{
             return redirect('Login');
        }
}


//  public function profile_view(Request $request){
//         $user_id = $request->session()->get('FRONT_USER_ID');
//         if(!empty($user_id)){
//             $d['profile_view'] = customer::where('user_id',$user_id)->get();
//             return view('userdashboard/profile/proflle_view',$d);
//         }else{
//              return redirect('Login');
//         }

//     }



public function myorder(Request $request){

    $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            // $orders = Order::join('customers','customers.id','=','orders.user_id')->select('orders.*','customers.name as name')->where('orders.user_id',$user_id )->paginate(6);
            $orders = Order::join('customers','customers.id','=','orders.user_id')->select('orders.*','customers.name as name')->where('orders.user_id',$user_id )->orderBy('orders.id', 'desc')->paginate(6);

            // Use redesigned orders page
            return view('userdashboard-new.order.orderlist',['orders'=>$orders]);
        }else{
             return redirect('Login');
        }
}


public function goldenuser(Request $request){

    $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            // $orders = Order::join('customers','customers.id','=','orders.user_id')->select('orders.*','customers.name as name')->where('orders.user_id',$user_id )->paginate(6);
            //$orders = Order::join('customers','customers.id','=','orders.user_id')->select('orders.*','customers.name as name')->where('orders.user_id',$user_id )->orderBy('orders.id', 'desc')->paginate(6);


$d['qualifications'] =   Qualification::where('user_id',$user_id)->orderby('id','DESC')->get();
            $d['professions'] =      Profession::where('user_id',$user_id)->orderby('id','DESC')->get();
            $d['thoughts'] =         Thought::where('user_id',$user_id)->orderby('id','DESC')->get();
            $d['portfolios'] =       Portfolio::where('user_id',$user_id)->orderby('id','DESC')->get();
            $d['userdata'] =         customer::where('id',$user_id)->first();
            $d['social'] =          Social::where('user_id',$user_id)->first();
            
            /* anand start code */
            $d['videos'] =          Video::where('user_id',$user_id)->orderby('id','DESC')->get();
           
            $d['myfiles'] =     Customer::where('id',$user_id)->first()->document??NULL;
            
          //  $d['professional_photos'] =      Professional_photo::where('user_id',$user_id)->first();

            $d['professional_photos'] =      Professional_photo::where('user_id',$user_id)->orderby('id','DESC')->get();
            $d['myproducts'] =               Myproduct::where('user_id',$user_id)->orderby('id','DESC')->get();
            /* anand end code */
        


            return view('golden/index',$d);
        }else{
             return redirect('Login');
        }
}


// Public function qrcode(){ 
    
//     return view('userdashboard/order/qrcode');
// }



public function qrcode(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $user = customer::where('id',$user_id)->first();
            // Use redesigned QR code page
            return view('userdashboard-new.order.qrcode',['user'=>$user]);
        }else{
             return redirect('Login');
        }
}

public function showuserprofile(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $user = customer::where('id',$user_id)->first();
            // Use redesigned profile page
            return view('userdashboard-new.profile.myprofile',['user'=>$user]);
        }else{
             return redirect('Login');
        }
}

/**
 * Profile Theme Selection Page
 */
public function profileTheme(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $userdata = customer::where('id', $user_id)->first();
        $themes = ProfessionTheme::active()->ordered()->get();
        $currentTheme = null;

        if($userdata->profession_type){
            $currentTheme = ProfessionTheme::find($userdata->profession_type);
        }

        return view('userdashboard-new.theme.index', [
            'userdata' => $userdata,
            'themes' => $themes,
            'currentTheme' => $currentTheme
        ]);
    }else{
        return redirect('Login');
    }
}

/**
 * Save Selected Profile Theme
 */
public function selectProfileTheme(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $request->validate([
            'theme_id' => 'required|exists:profession_themes,id'
        ]);

        $userdata = customer::where('id', $user_id)->first();
        $userdata->profession_type = $request->theme_id;
        $userdata->save();

        $theme = ProfessionTheme::find($request->theme_id);

        return redirect('/profile-theme')->with('success', 'Theme updated to "' . $theme->name . '" successfully!');
    }else{
        return redirect('Login');
    }
}

/**
 * Save Theme Customization Settings
 */
public function saveThemeCustomization(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $userdata = customer::where('id', $user_id)->first();

        $customization = [
            'primary_color' => $request->primary_color ?? '#7C3AED',
            'accent_color' => $request->accent_color ?? '#f59e0b',
            'button_style' => $request->button_style ?? 'rounded',
            'show_social' => $request->has('show_social'),
            'show_contact_buttons' => $request->has('show_contact_buttons'),
            'show_save_contact' => $request->has('show_save_contact'),
            'show_share' => $request->has('show_share'),
        ];

        $userdata->theme_customization = $customization;
        $userdata->save();

        return redirect('/profile-theme')->with('success', 'Theme customization saved successfully!');
    }else{
        return redirect('Login');
    }
}

/**
 * Menu Management for Restaurant Theme
 */
public function myMenu(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $categories = MenuCategory::where('customer_id', $user_id)->ordered()->with('items')->get();
        $totalItems = MenuItem::where('customer_id', $user_id)->count();
        $bestsellers = MenuItem::where('customer_id', $user_id)->where('is_bestseller', 1)->count();

        return view('userdashboard-new.menu.index', compact('categories', 'totalItems', 'bestsellers'));
    }else{
        return redirect('Login');
    }
}

public function createMenuCategory(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        return view('userdashboard-new.menu.category-create');
    }else{
        return redirect('Login');
    }
}

public function storeMenuCategory(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024'
        ]);

        $category = new MenuCategory();
        $category->customer_id = $user_id;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->icon = $request->icon ?? 'fa-utensils';
        $category->status = $request->has('is_active') ? 1 : 0;
        $category->sort_order = MenuCategory::where('customer_id', $user_id)->max('sort_order') + 1;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_cat.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu/categories'), $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('/mymenu')->with('success', 'Category created successfully!');
    }else{
        return redirect('Login');
    }
}

public function editMenuCategory(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $category = MenuCategory::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        return view('userdashboard-new.menu.category-edit', compact('category'));
    }else{
        return redirect('Login');
    }
}

public function updateMenuCategory(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024'
        ]);

        $category = MenuCategory::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->icon = $request->icon ?? 'fa-utensils';
        $category->status = $request->has('is_active') ? 1 : 0;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_cat.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu/categories'), $filename);
            $category->image = $filename;
        }

        $category->save();

        return redirect('/mymenu')->with('success', 'Category updated successfully!');
    }else{
        return redirect('Login');
    }
}

public function toggleMenuCategory(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $category = MenuCategory::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $category->status = $category->status ? 0 : 1;
        $category->save();

        return redirect('/mymenu')->with('success', 'Category status updated!');
    }else{
        return redirect('Login');
    }
}

public function deleteMenuCategory(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $category = MenuCategory::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        MenuItem::where('category_id', $id)->delete();
        $category->delete();

        return redirect('/mymenu')->with('success', 'Category deleted successfully!');
    }else{
        return redirect('Login');
    }
}

public function reorderMenuCategories(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $order = $request->input('order', []);
        foreach($order as $index => $id){
            MenuCategory::where('id', $id)->where('customer_id', $user_id)->update(['sort_order' => $index]);
        }
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 401);
}

public function categoryItems(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $category = MenuCategory::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $items = MenuItem::where('category_id', $id)->where('customer_id', $user_id)->ordered()->get();

        return view('userdashboard-new.menu.items', compact('category', 'items'));
    }else{
        return redirect('Login');
    }
}

public function createMenuItem(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $categories = MenuCategory::where('customer_id', $user_id)->get();
        return view('userdashboard-new.menu.item-create', compact('categories'));
    }else{
        return redirect('Login');
    }
}

public function storeMenuItem(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:menu_categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024'
        ]);

        $item = new MenuItem();
        $item->customer_id = $user_id;
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->dietary_type = $request->dietary_type ?? 'veg';
        $item->spice_level = ($request->spice_level === null || $request->spice_level === '') ? 0 : $request->spice_level;
        $item->is_available = $request->has('is_available') ? 1 : 0;
        $item->is_bestseller = $request->has('is_bestseller') ? 1 : 0;
        $item->is_chefs_special = $request->has('is_chefs_special') ? 1 : 0;
        $item->sort_order = MenuItem::where('category_id', $request->category_id)->max('sort_order') + 1;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_item.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu/items'), $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect('/mymenu/category/'.$request->category_id.'/items')->with('success', 'Item added successfully!');
    }else{
        return redirect('Login');
    }
}

public function editMenuItem(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $item = MenuItem::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $categories = MenuCategory::where('customer_id', $user_id)->get();
        return view('userdashboard-new.menu.item-edit', compact('item', 'categories'));
    }else{
        return redirect('Login');
    }
}

public function updateMenuItem(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $request->validate([
            'name' => 'required|max:255',
            'category_id' => 'required|exists:menu_categories,id',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:1024'
        ]);

        $item = MenuItem::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $item->category_id = $request->category_id;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->dietary_type = $request->dietary_type ?? 'veg';
        $item->spice_level = ($request->spice_level === null || $request->spice_level === '') ? 0 : $request->spice_level;
        $item->is_available = $request->has('is_available') ? 1 : 0;
        $item->is_bestseller = $request->has('is_bestseller') ? 1 : 0;
        $item->is_chefs_special = $request->has('is_chefs_special') ? 1 : 0;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_item.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/menu/items'), $filename);
            $item->image = $filename;
        }

        $item->save();

        return redirect('/mymenu/category/'.$item->category_id.'/items')->with('success', 'Item updated successfully!');
    }else{
        return redirect('Login');
    }
}

public function toggleMenuItem(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $item = MenuItem::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $item->is_available = !$item->is_available;
        $item->save();

        return redirect()->back()->with('success', 'Item availability updated!');
    }else{
        return redirect('Login');
    }
}

public function toggleMenuItemBestseller(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $item = MenuItem::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $item->is_bestseller = !$item->is_bestseller;
        $item->save();

        return redirect()->back()->with('success', 'Bestseller status updated!');
    }else{
        return redirect('Login');
    }
}

public function deleteMenuItem(Request $request, $id){
    $user_id = $request->session()->get('FRONT_USER_ID');
    if(!empty($user_id)){
        $item = MenuItem::where('id', $id)->where('customer_id', $user_id)->firstOrFail();
        $category_id = $item->category_id;
        $item->delete();

        return redirect('/mymenu/category/'.$category_id.'/items')->with('success', 'Item deleted successfully!');
    }else{
        return redirect('Login');
    }
}









public function userorderview(Request $request,$id){
    $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $d['order'] = Order::where('id',$id)->first();
            $d['ordermeta'] = OrderMeta::where('order_id',$id)->first();
            $d['allorder'] = OrderProduct::where('order_id',$id)->get();
            return view('userdashboard-new.order.view',$d);
        }else{
             return redirect('Login');
        }
}

public function updateuserprofile(Request $request){
    $user_id = $request->session()->get('FRONT_USER_ID');
    
        $request->validate([
            // 'title1' => 'required|max:200',
                'title1' => 'max:1477',
                'profile' => 'image|mimes:jpeg,png,jpg,webp|max:1024', // 1024 KB = 1 MB
                'banner' => 'image|mimes:jpeg,png,jpg,webp|max:1024',
        ], [
            // 'title1.max' => 'The about us must not exceed 200 characters.',
             'title1.max' => 'The about us must not exceed 200 words.',
              'profile.required' => 'Profile image is required.',
              'profile.image' => 'The file must be an image.',
              'profile.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
             'profile.max' => 'Profile image must not exceed 1 MB.',
              'banner.image' => 'The file must be an image.',
              'banner.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
             'banner.max' => 'Banner image must not exceed 1 MB.',
        ]);
   

        if(!empty($user_id)){
            $userdata = customer::where('id',$user_id)->first();
            $userdata->name = $request->name;
            if (!empty($request->mobile)) {
                $userdata->mobile = $request->mobile;
            } elseif (!empty($request->phone)) {
                $userdata->mobile = $request->phone;
            }
            $userdata->phone = $request->phone;
            $userdata->email=$request->email;
            $userdata->city = $request->city;
            $userdata->state = $request->state;
            $userdata->country = $request->country;
            $userdata->address = $request->address;
            $userdata->zip = $request->zip_code;
            
            $userdata->title1 = $request->about ?? $request->title1;
            $userdata->about = $request->about;
            
            $userdata->title2 = $request->bio ?? $request->title2;
            $userdata->bio = $request->bio;
            $userdata->title3 = $request->title3;
            $userdata->title4 = $request->title4;
            
            $userdata->degree = $request->degree;
            $userdata->age = $request->age;
            $userdata->dob = $request->dob;
            $userdata->profession = $request->profession;
            $userdata->twitter = $request->twitter;
            $userdata->facebook = $request->facebook;
            $userdata->instagram = $request->instagram;
            $userdata->linkdn = $request->linkdn;
            $userdata->desig = $request->designation ?? $request->desig;
            $userdata->company = $request->company;
            $userdata->website = $request->website;
            if (!empty($request->customer_url)) {
                $userdata->slug = $request->customer_url;
            }
            $userdata->whatsapp = $request->whatsapp;
            if ($request->has('profession_data')) {
                $userdata->profession_data = $request->input('profession_data');
            }
            

            if($request->hasfile('profile'))
            {
                $file = $request->file('profile');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $destinationPath = public_path('frontend/user_images');
                $file->move($destinationPath, $filename);
                $userdata->profile = $filename;
            }
            
             if($request->hasfile('banner'))
            {
                $file = $request->file('banner');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $destinationPath = public_path('frontend/user_images');
                $file->move($destinationPath, $filename);
                $userdata->banner = $filename;
            }
           
            $userdata->save();

            if (!empty($request->whatsapp)) {
                $social = Social::firstOrNew(['user_id' => $user_id]);
                $social->whatsapp = $request->whatsapp;
                if (empty($social->status)) {
                    $social->status = '1';
                }
                $social->save();
            }
            return redirect()->back()->with('success','Profile Successfully Updated');
        }else{
             return redirect('Login');
        }

}
    public function myqualification(Request $request){

        $user_id = $request->session()->get('FRONT_USER_ID');
           $userdata = customer::where('id',$user_id)->first();
        if(!empty($user_id)){
            $d['qualifications'] = Qualification::where('user_id',$user_id)->get();
            return view('userdashboard-new.qualifications.index',$d,compact('userdata'));
        }else{
             return redirect('Login');
        }

    }
    
    
    public function addqualification(Request $request){
        return view('userdashboard-new.qualifications.add');
    }
    
    public function savequalifiaction(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $qualification = new Qualification;
            $qualification->user_id = $user_id;
            $qualification->qualifiaction = $request->qualifiaction;
            $qualification->description = $request->description;
            $qualification->save();
            return redirect('myqualification')->with('success','Qualification Successfully Added');
        }else{
             return redirect('Login');
        }
    }
    
    public function editqualification(Request $request ,$id){
        $datas = Qualification::find($id);
        return view('userdashboard-new.qualifications.edit',['qualification'=>$datas]);
    } 
    
    public function updatequalification(request $request){
        $qualification = Qualification::find($request->id);
        $qualification->qualifiaction = $request->qualifiaction;
        $qualification->description = $request->description;
        $qualification -> save();
    
        return redirect('myqualification')->with('success','Qualification Successfully Updated');
    }
    
    public function deletequalification($id) {
        $qualification = Qualification::find($id);
        $qualification->delete();
        return back()->with('error','Qualification Successfully Deleted');
    }
    //my profession
    public function myprofessions(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
          $userdata = customer::where('id',$user_id)->first();
        if(!empty($user_id)){
            $d['professions'] = Profession::where('user_id',$user_id)->get();
            return view('userdashboard-new.professions.index',$d,compact('userdata'));
        }else{
             return redirect('Login');
        }  
    }
    
    
    
    
    public function addprofessions(Request $request){
        return view('userdashboard-new.professions.add');
    }
    
    public function saveprofessions(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
          $request->validate([
                'icon' => 'image|mimes:jpeg,png,jpg,webp|max:1024', // 1024 KB = 1 MB
        ], [
            'icon.image' => 'The file must be an image.',
            'icon.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
            'icon.max' => 'Profile image must not exceed 1 MB.',
        ]);
   
        if(!empty($user_id)){
            $profession = new Profession;
            $profession->user_id = $user_id;
            $profession->profession = $request->profession;
            $profession->phone = $request->phone;
            $profession->location = $request->location;
            $profession->website = $request->website;
            $profession->email = $request->email;
            $profession->description = $request->description;
            $profession->iframe = $request->iframe;
            $profession->designation = $request->designation;
            
            if($request->hasfile('icon'))
            {
                $file = $request->file('icon');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $destinationPath = public_path('frontend/profession_logo');
                $file->move($destinationPath, $filename);
                $profession->icon = $filename;
            }
            
            $profession->save();
            return redirect('myprofessions')->with('success','Profession Successfully Added');
        }else{
             return redirect('Login');
        }
    }
    
    public function editprofessions(Request $request ,$id){
        $datas = Profession::find($id);
        return view('userdashboard-new.professions.edit',['profession'=>$datas]);
    } 
    
    public function updateprofessions(request $request){
        $profession = Profession::find($request->id);
        $profession->profession = $request->profession;
        $profession->phone = $request->phone;
        $profession->location = $request->location;
        $profession->website = $request->website;
        $profession->email = $request->email;
        $profession->description = $request->description;
        $profession->iframe = $request->iframe;
        $profession->designation = $request->designation;

       if($request->hasfile('icon'))
            {
                $file = $request->file('icon');
                $extention = $file->getClientOriginalExtension();
                $filename = time().'.'.$extention;
                $destinationPath = public_path('frontend/profession_logo');
                $file->move($destinationPath, $filename);
                $profession->icon = $filename;
            }
            
        $profession-> save();
    
        return redirect('myprofessions')->with('success','Profession Successfully Updated');
    }
    
    public function deleteprofessions($id) {
        $profession = Profession::find($id);
        $profession->delete();
        return back()->with('error','Profession Successfully Deleted');
    }
    
    
    
     public function viewprofessions(Request $request ,$id){
        $datas = Profession::find($id);
        return view('userdashboard/profession/view_profession',['profession'=>$datas]);
    } 
    
    
    
    //my thought
    
     public function mythought(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
        $userdata = customer::where('id',$user_id)->first();
        if(!empty($user_id)){
            $d['thoughts'] = Thought::where('user_id',$user_id)->get();
            return view('userdashboard-new.thoughts.index',$d,compact('userdata'));
        }else{
             return redirect('Login');
        }  
    }
    
    public function addthought(Request $request){
        return view('userdashboard-new.thoughts.add');
    }
    
    public function savethought(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $qualification = new Thought;
            $qualification->user_id = $user_id;
            $qualification->thought = $request->thoughts;
            $qualification->description = $request->description;
            $qualification->save();
            return redirect('mythought')->with('success','Thought Successfully Added');
        }else{
             return redirect('Login');
        }
    }
    
    public function editthought(Request $request ,$id){
        $datas = Thought::find($id);
        return view('userdashboard-new.thoughts.edit',['thought'=>$datas]);
    } 
    
    public function updatethought(request $request){
        $qualification = Thought::find($request->id);
        $qualification->thought = $request->thoughts;
        $qualification->description = $request->description;
        $qualification -> save();

        return redirect('mythought')->with('success','Thought Successfully Updated');
    }
    
    public function deletethought($id) {
        $qualification = Thought::find($id);
        $qualification->delete();
        return back()->with('error','Thought Successfully Deleted');
    }
    
    //portfolio personal photos
    
    public function myportfolio(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
         $userdata = customer::where('id',$user_id)->first();
        if(!empty($user_id)){
            $d['portfolios'] = Portfolio::where('user_id',$user_id)->get();
            // Use redesigned photos page
            return view('userdashboard-new.photos.index',$d,compact('userdata'));
        }else{
             return redirect('Login');
        }
    }


    public function addportfolio(Request $request){
        // Use redesigned add photos page
        return view('userdashboard-new.photos.add');
    }
    
    public function saveportfolio(Request $request){
        // validate data
        
        $request->validate([
            'title' => 'required',
            'image' => 'required|array',
            'image.*' => 'image|mimes:jpeg,png,jpg,webp|max:1024',
        ], [
            'image.required' => 'At least one image is required.',
            'image.*.image' => 'Each file must be an image.',
            'image.*.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
            'image.*.max' => 'Each image must not exceed 1 MB.',
        ]);
        
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $portfolio = new Portfolio;
            $portfolio->user_id = $user_id;
            $portfolio->title = $request->title;
            $portfolio->description = $request->description;
            
            
            if(isset($request->image))   
            {
                // $file = $request->file('image');
                // $extention = $file->getClientOriginalExtension();
                // $filename = time().'.'.$extention;
                // $destinationPath = public_path('frontend/portfolio');
                // $file->move($destinationPath, $filename);
                // $portfolio->image = $filename;
                    foreach($request->file('image') as $file)
                    {
                         $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                         //$path = public_path() . '/uploads/product_images/product_multi_img//';
                         $path = public_path('frontend/portfolio');
                         $file->move($path, $name);
                         $Imgdata[] = $name;
                    }
                    $portfolio->image = json_encode($Imgdata);
            }
            
            $portfolio->save();
            return redirect('myportfolio')->with('success','Photo Successfully Added');
        }else{
             return redirect('Login');
        }
    }
    
    public function editportfolio(Request $request ,$id){
        $datas = Portfolio::find($id);
        // Use redesigned edit photos page
        return view('userdashboard-new.photos.edit',['portfolio'=>$datas]);
    } 
    
    public function updateportfolio(request $request){
        $portfolio = Portfolio::find($request->id);
        $portfolio->title = $request->title;
       
        $portfolio->description = $request->description;
        
        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $files = is_array($files) ? $files : [$files];
            $imgData = [];
            foreach ($files as $file) {
                $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                $path = public_path('frontend/portfolio');
                $file->move($path, $name);
                $imgData[] = $name;
            }
            if (!empty($imgData)) {
                $portfolio->image = json_encode($imgData);
            }
        }
        $portfolio->save();
    
        return redirect('myportfolio')->with('success','Photos Successfully Updated');
    }
    
    public function deleteportfolio($id) {
        $portfolio = Portfolio::find($id);
        $portfolio->delete();
        return back()->with('error','Photos Successfully Deleted');
    }
    
    /*anand start code */
        /* personal photos start */
        
        public function professional_photos(Request $request){
            $user_id = $request->session()->get('FRONT_USER_ID');
             $userdata = customer::where('id',$user_id)->first();
            if(!empty($user_id)){
                $d['professional_photos'] = Professional_photo::where('user_id',$user_id)->get();
                return view('userdashboard/professional_photos/index',$d,compact('userdata'));
            }else{
                 return redirect('Login');
            }
        }
        
        public function addprofessional_photo(Request $request){
            return view('userdashboard/professional_photos/add');
        }
    
        public function saveprofessional_photo(Request $request){
            
            $request->validate([
                'title' => 'required',
                'image' => 'required|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,webp|max:1024',
            ], [
                'image.required' => 'At least one image is required.',
                'image.*.image' => 'Each file must be an image.',
                'image.*.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
                'image.*.max' => 'Each image must not exceed 1 MB.',
            ]);
            
            $user_id = $request->session()->get('FRONT_USER_ID');
            if(!empty($user_id)){
                $professional_photo = new Professional_photo;
                
                $professional_photo->user_id = $user_id;
                $professional_photo->title = $request->title;
               // $professional_photo->description = $request->description;
               
                
                if(isset($request->image))
                {
                    foreach($request->file('image') as $file)
                    {
                         $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                         //$path = public_path() . '/uploads/product_images/product_multi_img//';
                         $path = public_path('frontend/professional_photos');
                         $file->move($path, $name);
                         $Imgdata[] = $name;
                    }
                    $professional_photo->image = json_encode($Imgdata);
                 }
                
                $professional_photo->save();
                return redirect('professional_photos')->with('success','Photo Successfully Added');
            }else{
                 return redirect('Login');
            }
        }
        
        public function editprofessional_photo(Request $request ,$id){
            $datas = Professional_photo::find($id);
            
            // echo "<pre>";
            // print_r($datas);
            // echo "</pre>";
            // die;
            return view('userdashboard/professional_photos/edit',['professional_photos'=>$datas]);
        } 
        
        public function updateprofessional_photo(request $request)
        {
            // dd($request->all());
            // die;
            $request->validate([
                'title' => 'required',
                'image' => 'nullable|array',
                'image.*' => 'image|mimes:jpeg,png,jpg,webp|max:1024',
            ], [
                'image.*.image' => 'Each file must be an image.',
                'image.*.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
                'image.*.max' => 'Each image must not exceed 1 MB.',
            ]);
        
            $professional_photo = Professional_photo::find($request->id);
            $professional_photo->title = $request->title;
           
            //$portfolio->description = $request->description;
            if(isset($request->image))
            {
                // if($request->hasfile('image'))
                // {
                    foreach($request->file('image') as $file)
                    {
                         $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                         //$path = public_path() . '/uploads/product_images/product_multi_img//';
                         $path = public_path('frontend/professional_photos');
                         $file->move($path, $name);
                         $Imgdata[] = $name;
                    }
                    $professional_photo->image = json_encode($Imgdata);
                //}
               
            }
                $professional_photo->save();
                return redirect('professional_photos')->with('success','Photos Successfully Updated');
        
        }
    
        public function deleteprofessional_photo($id) {
            $professional_photo = Professional_photo::find($id);
            $professional_photo->delete();
            return back()->with('error','Photos Successfully Deleted');
        }
        /* personal photos end */ 
    
    
    /* my videos */
        public function addmyvideo(Request $request){
            // Use redesigned add video page
            return view('userdashboard-new.videos.add');
        }
    
        public function savemyvideo(Request $request){
            
        //dd($request->all());

        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $myvideo = new Video;
            $myvideo->user_id = $user_id;
            $myvideo->video_link = $request->video_link;
            $myvideo->save();
            return redirect('myvideos')->with('success','Video Successfully Added');
        }else{
             return redirect('Login');
        }
    }
    
    public function editmyvideo(Request $request ,$id){
        $datas = Video::find($id);
        // Use redesigned edit video page
        return view('userdashboard-new.videos.edit',['video'=>$datas]);
    } 
    
    
    public function updatemyvideo(request $request){
        $myvideo = Video::find($request->id);
        $myvideo->video_link = $request->video_link;
        $myvideo->save();
    
        return redirect('myvideos')->with('success','Video Successfully Updated');
    }
    
        public function myvideos(Request $request){

        $user_id = $request->session()->get('FRONT_USER_ID');
         $userdata = customer::where('id',$user_id)->first();
        if(!empty($user_id)){
            $d['videos'] = Video::where('user_id',$user_id)->get();
            // Use redesigned videos page
            return view('userdashboard-new.videos.index',$d,compact('userdata'));
        }else{
             return redirect('Login');
        }
    }
    
    public function deletemyvideo($id) {
        $portfolio = Video::find($id);
        $portfolio->delete();
        return back()->with('error','Video Successfully Deleted');
    }
     
     
    /* my products section start */
     
    public function myproducts(Request $request){
        // echo "hello";
        // die;
        $user_id = $request->session()->get('FRONT_USER_ID');
         $userdata = customer::where('id',$user_id)->first();
        if(!empty($user_id)){
            $d['myproducts'] = Myproduct::where('user_id',$user_id)->get();
            return view('userdashboard-new.products.index',$d,compact('userdata'));
        }else{
             return redirect('Login');
        }
    }
    
    public function addmyproduct(Request $request){
            return view('userdashboard-new.products.add');
    }
     
    public function savemyproduct(Request $request){
        // dd($request->all());
        // return;
        
        $request->validate([
            'title' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:1024',
            'price' => 'required'
        ], [
            'images.required' => 'At least one image is required.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
            'images.*.max' => 'Each image must not exceed 1 MB.',
        ]);

        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $myproduct = new Myproduct;
            
            $myproduct->user_id = $user_id;
            $myproduct->title = $request->title;
            $myproduct->price = $request->price;
            $myproduct->sd = $request->description;
    
            if(isset($request->images))
            {
                foreach($request->file('images') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     //$path = public_path() . '/uploads/product_images/product_multi_img//';
                     $path = public_path('frontend/myproducts');
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
                $myproduct->images = json_encode($Imgdata);
             }
            
            $myproduct->save();
            return redirect('myproducts')->with('success','Product Successfully Added');
        }else{
             return redirect('Login');
        }
    }  
    
    public function editmyproduct(Request $request ,$id){
        $datas = Myproduct::find($id);
        return view('userdashboard-new.products.edit',['myproducts'=>$datas]);
    } 
    
    public function updatemyproduct(request $request)
    {
        //dd($request->all());
        // die;
        $request->validate([
            'title' => 'required',
            'images' => 'nullable',
            'price' => 'required'
        ]);
        $myproduct = Myproduct::find($request->id);
        $myproduct->title = $request->title;
        $myproduct->price = $request->price;
        $myproduct->sd = $request->description;

        if(isset($request->images))
        {
            foreach($request->file('images') as $file)
            {
                $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                //$path = public_path() . '/uploads/product_images/product_multi_img//';
                $path = public_path('frontend/myproducts');
                $file->move($path, $name);
                $Imgdata[] = $name;
            }
            $myproduct->images = json_encode($Imgdata);
        }
        $myproduct->save();
        return redirect('myproducts')->with('success','Product Successfully Updated');
    }
    
    public function deletemyproduct($id) {
    $myproduct = Myproduct::find($id);

    // Check if the product exists
    if (!$myproduct) {
        return back()->with('error', 'Product not found');
    }

    // Decode the JSON string to get an array of image filenames
    $imageFilenames = json_decode($myproduct->images, true);

    // Get the images path
    $imagesPath = public_path('frontend/myproducts');

    // Delete each image file
    foreach ($imageFilenames as $image) {
        $imagePath = $imagesPath . '/' . $image;

        // Check if the file exists before attempting to delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the product from the database
    $myproduct->delete();

    return back()->with('error', 'Product successfully deleted');
}



        
    /* my products section end */
    /*anand end code */
    
    
    
    
    
    public function changepassword(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $d['userdata'] = customer::where('id',$user_id)->first();
            return view('userdashboard-new.settings.change-password',$d);
        }else{
             return redirect('Login');
        }
    }

    // public function updatePassword(Request $request){
        
    //     // dd($request->all());
    //     // return;
        
    //     $user_id = $request->session()->get('FRONT_USER_ID');
    //     if(!empty($user_id))
    //     {
    //         request()->validate([
    //             'old_password' => 'required',
    //             'new_password' => 'required',
    //             'confirm_pass' => 'required|same:new_password',
    //         ]); 

    //         $data =  customer::find($user_id);
            
    //         // $dbpass = Crypt::decrypt($data->password);

    //         // if($dbpass == $request->old_password){
    //         //     $data->password =  Crypt::encrypt($request->new_password);
    //         //     $data->save(); 
    //         //     return redirect()->back()->with('success','Password update succesfully');
    //         // }
    //         // else{
    //         //     return redirect()->back()->with('error','Current Password is invalid');
    //         // }
            
    //             $oldPassword = $request->input('old_password');
    //             $newPassword = $request->input('new_password');
                
    //             // Validate old password
    //             if (!Hash::check($oldPassword, $data->password)) {
    //                 return redirect()->back()->withErrors(['old_password' => 'Incorrect old password']);
    //             }
                
    //             // Validate new password and confirmation
    //             $this->validate($request, [
    //                 'new_password' => 'required|confirmed',
    //             ]);
                
    //             // Update password
    //             $data->password = Hash::make($newPassword);
    //             $data->save();
    //             return redirect()->route('login')->with('success', 'Password changed successfully. Please log in.');
            
    //     }
        
    //     else{
    //          return redirect('Login');
    //     }
        
    // }
    
    
    public function updatePassword(Request $request)
    {
        $user_id = $request->session()->get('FRONT_USER_ID');
        
        if (!empty($user_id)) {
            $customer = Customer::find($user_id);
    
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_pass' => 'required|same:new_password',
            ]);
    
            $oldPassword = $request->input('old_password');
            $newPassword = $request->input('new_password');
            
            // Validate old password
            if (!Hash::check($oldPassword, $customer->password)) {
                return redirect()->back()->withErrors(['old_password' => 'Incorrect old password']);
            }
    
            // Update password
            $customer->password = Hash::make($newPassword);
            $customer->save();
    
            return redirect('Login')->with('success', 'Password changed successfully. Please log in.');
        } else {
            return redirect('Login'); // Assuming 'login' is the route name for your login page
        }
    }

    
    //---------------------------------------------------price plan start----------------------------------------------------//
    
     public function view_price_plan(){
        $data = Price::paginate(10);
       return view('admin/pricingplan/index',['price'=>$data]);
    }
    
    
     public function editprice($id){
        $datas = Price::find($id);
        return view('admin/pricingplan/edit',['price'=>$datas]);
    }
    
    
      public function updatetesprice(request $req){
          
       
          
       
        $price = Price::find($req->id);
        $price -> name=$req->name;
        $price -> price=$req->price;
                $price -> short_des=$req->editor1;
        $price -> long_des=$req->editor;
        
    if ($req->hasFile('image')) {
        $image = $req->file('image');
        $Extension = $image->getClientOriginalExtension();
        $filename =time().'.'.$Extension;
        $destinationPath = public_path('uploads/price');
        $imagePath = $destinationPath. "/".  $filename;
        $image->move($destinationPath, $filename);
        $price->image = $filename;
      }
      
     
if($req->hasfile('pro_multi_img'))
             {
                foreach($req->file('pro_multi_img') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/price';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
                $price->pro_multi_img = json_encode($Imgdata);
             }     
             
      
      
      $price -> save();
    
    return redirect('admin/view_price_plan')->with('success','Price Successfully Updated');
    
    }


public function pricedelete($id) {
   
    $price = Price::find($id);
    if (File::exists(public_path("uploads/price/{$price->image}"))) {
        File::delete([public_path("uploads/price/{$price->image}")]);
    }else{
        
      echo  'no File exists';
    }
    $price->delete();

      return back()->with('error','price Successfully Deleted');



}
     //---------------------------------------------------price plan end----------------------------------------------------//
     
     
     //---------------------------------------------------testimonial start----------------------------------------------------//
    public function testimoniallist(){
        $data = Testimonial::paginate(10);
       return view('admin-new.testimonial.index',['testimonial'=>$data]);
    }
    
    public function addtestimonial(){
        return view('admin-new.testimonial.add');
    }
    
    public function savetestimonial(request $req){
    
        $req->validate([
            'name'=>'required | unique:categories,categroy',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:1024', // 1024 KB = 1 MB
           ],
        [
            'image.required' => 'Image is required.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only jpeg, jpg, png, and webp formats are allowed.',
            'image.max' => 'Image must not exceed 1 MB.',
        ]
           );
           
           
           
            $testimonial = new Testimonial;
            $testimonial -> name=$req->name;
            $testimonial -> description=$req->description;
          
    
            if ($req->hasFile('image')) {
                $image = $req->file('image');
                $Extension = $image->getClientOriginalExtension();
                $filename =time().'.'.$Extension;
                $destinationPath = public_path('uploads/testimonial');
                $imagePath = $destinationPath. "/".  $filename;
                $image->move($destinationPath, $filename);
                $testimonial->image = $filename;
              }
      
      
      
            $testimonial -> save();
    
    return redirect('admin/testimonial')->with('success','Testimonial Successfully Added');
    
    }

    public function edittestimonial($id){
        $datas = Testimonial::find($id);
        return view('admin/testimonial/edit',['testimonial'=>$datas]);
    }

    public function updatetestimonial(request $req){
        
    
    
        $testimonial = Testimonial::find($req->id);
        $testimonial -> name=$req->name;
        $testimonial -> description=$req->description;
    
    
    
    
    if ($req->hasFile('image')) {
        $image = $req->file('image');
        $Extension = $image->getClientOriginalExtension();
        $filename =time().'.'.$Extension;
        $destinationPath = public_path('uploads/testimonial');
        $imagePath = $destinationPath. "/".  $filename;
        $image->move($destinationPath, $filename);
        $testimonial->image = $filename;
      }
      
      $testimonial -> save();
    
    return redirect('admin/testimonial')->with('success','Testimonial Successfully Updated');
    
    }




public function testimonialdelete($id) {
   
    $testimonial = Testimonial::find($id);
    if (File::exists(public_path("uploads/testimonial/{$testimonial->image}"))) {
        File::delete([public_path("uploads/testimonial/{$testimonial->image}")]);
    }else{
        
      echo  'no File exists';
    }
    $testimonial->delete();

      return back()->with('error','Testimonial Successfully Deleted');



}



function viewcontact(){
$data = Contact::paginate(10);
return view('admin-new.contact.index',['contactus'=>$data]);
}

  function view_corporate(){
$data = Corporate::paginate(10);
return view('admin-new.corporate',['corporate'=>$data]);
}  



function add_offer(request $req){
    
    $req->validate([
        
      'offer'=>'required'  
        
        ]);
    
    
    $offer = new offer;
    $offer->offer=$req->offer;
    $offer->save();
    return redirect('admin/view_offer')->with('success','Offer successfully Added');
    
}

function viewoffer(){
$data = offer::paginate(10);
return view('admin-new.offer.index',['view_offer'=>$data]);
}

function offerdelete($id){
    
  $off = offer::find($id);
  
  $off->delete();
  
  return back()->with('error','Offer Successfully deleted');
    
}


public function offerStatus(Request $request)
{
    $user = offer::findorfail($request->id);
        

    $user->status = $request->status;
    $user->save();

    return response()->json(['message' => 'Offer status successfully updated.']);
}


function offerdata($id){
$data = offer::find($id);
return view('admin/update_offer',['view_offer'=>$data]);
}

function update_offer(request $req){
    
    
    $offer = offer::find($req->id);
    $offer->offer=$req->offer;
    $offer->save();
    return redirect('admin/view_offer')->with('warning','Offer successfully updated');
    
}



    public function subscribeview(){
          
          
          $data['sub']= subscibe_channel::paginate(10);
          
          return view('admin/subscribe_channel',$data);
       
    }


    public function subdelete($id){
          
          
          $data= subscibe_channel::find($id);
          
          $data->delete();
          
          return back()->with('error','Successfully deleted');
       
    }
    
    
    
    // add social lick crud
    
     public function mysocial(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
         $userdata = customer::where('id',$user_id)->first();
        if(!empty($user_id)){
            $d['socials'] = Social::where('user_id',$user_id)->get();
            // Use redesigned social page
            return view('userdashboard-new.social.index',$d,compact('userdata'));
        }else{
             return redirect('Login');
        }
    }





    public function addsocial(Request $request){
        // Use redesigned add social page
        return view('userdashboard-new.social.add');
    }
    
    public function savesocial(Request $request){
        //dd($request->all());
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $social = new Social;
            
            //print_r($social); die;
            $social->user_id = $user_id;
            $social->youtube = $request->youtube;
            $social->snapchat = $request->snapchat;
            $social->facebook = $request->facebook;
            $social->instagram = $request->instagram;
            $social->twitter = $request->twitter;
            $social->linkdin = $request->linkdin;
            $social->pinterest = $request->pinterest;
            $social->google_review = $request->google_review;
            
            $social->save();
           return redirect('mysocial')->with('success','Social successfully Added');
        }else{
             return redirect('Login');
        }
    }
     
     public function deletesocial($id) {
        $portfolio = Social::find($id);
        $portfolio->delete();
        return back()->with('error','Social Successfully Deleted');
    }
    
    
    
     public function editsocial(Request $request ,$id){
        $datas = Social::find($id);
        // Use redesigned edit social page
        return view('userdashboard-new.social.edit',['social'=>$datas]);
    } 
    
    public function updatesocial(request $request){
        $social = Social::find($request->id);
        $social->youtube = $request->youtube;
        $social->snapchat = $request->snapchat;
        $social->facebook = $request->facebook;
        $social->instagram = $request->instagram;
        $social->twitter = $request->twitter;
        $social->linkdin = $request->linkdin;
        
        
        $social->save();
    
        return redirect('mysocial')->with('success','Social Successfully Updated');
    }
    
    
    
    function add_coupon(request $req){
        
        
        $req->validate([
            
         'name'=>'required|unique:coupons,name',
         'discount'=>'required'
            
            
            ]);
        
        $dis = new coupon;
        $dis->name = $req->name;
                $dis->discount = $req->discount;

        $dis->save();
        
        return redirect('admin/view_coupon')->with('success','coupon successfully added');
        
    }
    
    
    function view_coupon(){


        $data['cou'] = coupon::paginate(10);
        return view('admin-new.coupon.index',$data);
        
        
        
    }
    
    
    function edit_coupon($id){
        
        
        $data['cou'] = coupon::find($id);
        return view('admin/update_coupon',$data);
        
        
        
    }
    
    
    
       function update_coupon(request $req){
  
        
        $dis = coupon::find($req->id);
        $dis->name = $req->name;
                $dis->discount = $req->discount;

        $dis->save();
        
        return redirect('admin/view_coupon')->with('warning','coupon successully updated');
        
    }
    
    
     function delete_coupon($id){
        
        
        $data = coupon::find($id);
        
        $data->delete();
        
        return back()->with('error','coupon successully deleted');
        
        
        
    }
    
    
    
    public function couponStatus(Request $request)
{
    $user = coupon::findorfail($request->id);
        

    $user->status = $request->status;
    $user->save();

    return response()->json(['message' => 'coupon status successfully updated.']);
}  

public function Pricing_Plans()
{ 
    $data['sd']='1';
       return view('admin/Pricing_Plans',$data);
}





function add_Pricing_Plans(request $req){
    
    $req->validate([
        
        'cname'=>'required',
        'pro_single_img'=>'required',
        'pro_multi_img'=>'required',
        'Description1'=>'required',
        'editor'=>'required',

        

        ]);
        
        
        $p= new Pricing_Plans;
        $p->cname=$req->cname;
        $p->Description1=$req->Description1;
        $p->Description2=$req->editor;

 if ($req->hasFile('pro_single_img')) {
        $image = $req->file('pro_single_img');
        $Extension = $image->getClientOriginalExtension();
        $filename =time().'.'.$Extension;
        $destinationPath = public_path('uploads/Pricing_Plans');
        $imagePath = $destinationPath. "/".  $filename;
        $image->move($destinationPath, $filename);
        $p->pro_single_img = $filename;
      }
      
    
  

 if($req->hasfile('pro_multi_img'))
             {
                foreach($req->file('pro_multi_img') as $file)
                {
                     $name = uniqid() . '_' . time(). '.' . $file->getClientOriginalExtension();
                     $path = public_path() . '/uploads/Pricing_Plans/';
                     $file->move($path, $name);
                     $Imgdata[] = $name;
                }
                $p->pro_multi_img = json_encode($Imgdata);
             }
    
        
    
    $p->save();
    

    // print_r($p);
    // die;
    
    
    return back();
    
    
}

public function user_list()
{
    $users = customer::OrderBy('id','desc')->paginate(20);
    return view('admin-new.user.index',['users'=>$users]);
}


public function user_delete($id)
    {
      $delete = customer::find($id);
      if($delete->delete())
      {
          return back()->with('success','Delete User');
      }else{
          return back()->with('error','Error');
      }
      
  }


 public function order_delete($id)
  {
      $delete = Order::find($id);
      if($delete->delete())
      {
          return back()->with('success','Delete Order');
      }else{
          return back()->with('error','Error');
      }
      
  }
  
  public function update_profile_menu (Request $req){
      
      
      if($req->id =='profile'){
          
          if($req->status ==0){
              $pstatus = 1;
          }else{
              $pstatus = 0;
          }
          DB::table('profile_menu')->update(array('profile'=>$pstatus));
          
      }elseif($req->id =='quali'){
          
          if($req->status == 0){
              $qstatus = 1;
          }else{
              $qstatus = 0;
          }
          
          DB::table('profile_menu')->update(array('quali'=>$qstatus));
      }elseif($req->id =='service'){
          if($req->status == 0){
              $sstatus = 1;
          }else{
              $sstatus = 0;
          }
          DB::table('profile_menu')->update(array('service'=>$sstatus));
      }elseif($req->id =='thought'){
          if($req->status == 0){
              $tstatus = 1;
          }else{
              $tstatus = 0;
          }
          DB::table('profile_menu')->update(array('thought'=>$tstatus));
      }elseif($req->id =='personal_photos'){
          if($req->status == 0){
              $prostatus = 1;
          }else{
              $prostatus = 0;
          }
          DB::table('profile_menu')->update(array('personal'=>$prostatus));
      }elseif($req->id =='proffesional'){
          if($req->status == 0){
              $ptstatus = 1;
          }else{
              $ptstatus = 0;
          }
          DB::table('profile_menu')->update(array('profess'=>$ptstatus));
      }elseif($req->id =='videos'){
          if($req->status == 0){
              $vstatus = 1;
          }else{
              $vstatus = 0;
          }
          DB::table('profile_menu')->update(array('videos'=>$vstatus));
      }elseif($req->id =='products'){
          if($req->status == 0){
              $pdstatus = 1;
          }else{
              $pdstatus = 0;
          }
          DB::table('profile_menu')->update(array('product'=>$pdstatus));
      }elseif($req->id =='social_link'){
          if($req->status == 0){
              $sostatus = 1;
          }else{
              $sostatus = 0;
          }
          DB::table('profile_menu')->update(array('social_link'=>$sostatus));
      }elseif($req->id =='upload_file'){
          if($req->status == 0){
              $upstatus = 1;
          }else{
              $upstatus = 0;
          }
          DB::table('profile_menu')->update(array('upload_file'=>$upstatus));
      }elseif($req->id =='client'){
          if($req->status == 0){
              $cpstatus = 1;
          }else{
              $cpstatus = 0;
          }
          DB::table('profile_menu')->update(array('client'=>$cpstatus));
      }elseif($req->id =='block'){
          if($req->status == 0){
              $block = 1;
          }else{
              $block = 0;
          }
          DB::table('profile_menu')->update(array('block'=>$block));
      }elseif($req->id =='google_map'){
          if($req->status == 0){
              $google_map = 1;
          }else{
              $google_map = 0;
          }
          DB::table('profile_menu')->update(array('google_map'=>$google_map));
      }elseif($req->id =='download'){
          if($req->status == 0){
              $download = 1;
          }else{
              $download = 0;
          }
          DB::table('profile_menu')->update(array('download'=>$download));
      }elseif($req->id =='achievment'){
          if($req->status == 0){
              $achievment = 1;
          }else{
              $achievment = 0;
          }
          DB::table('profile_menu')->update(array('achievment'=>$achievment));
      }elseif($req->id =='ou_client'){
          if($req->status == 0){
              $ou_client = 1;
          }else{
              $ou_client = 0;
          }
          DB::table('profile_menu')->update(array('ou_client'=>$ou_client));
      }elseif($req->id =='animation'){
          if($req->status == 0){
              $animation = 1;
          }else{
              $animation = 0;
          }
          DB::table('profile_menu')->update(array('animation'=>$animation));
          //dd(Session::get('FRONT_USER_ID'));
          DB::table('customers')->where('id',Session::get('FRONT_USER_ID'))->update(array('animation'=>$animation));
      }
      
      
      /*$updateData = array(
          'profile'=>$pstatus,
          'quali'=>$qstatus,
          'service'=>$req->id =='service' && $req->status ==0 ? '1':'0',
          'thought'=>$req->id =='thought' && $req->status ==0 ? '1':'0',
          'personal'=>$req->id =='personal_photos' && $req->status ==0 ? '1':'0',
          'profess'=>$req->id =='proffesional' && $req->status ==0 ? '1':'0',
          'videos'=>$req->id =='videos' && $req->status ==0 ? '1':'0',
          'product'=>$req->id =='products' && $req->status ==0 ? '1':'0',
          'social_link'=>$req->id =='social_link' && $req->status ==0 ? '1':'0',
          'upload_file'=>$req->id =='upload_file' && $req->status ==0 ? '1':'0',
          //'client'=>$req->id =='profile' && $req->status ==0 ? '1':'0',
          //'block'=>$req->id =='profile' && $req->status ==0 ? '1':'0',
          //'google_map'=>$req->id =='profile' && $req->status ==0 ? '1':'0',
          );*/
          
          //DB::table('profile_menu')->update($updateData);
      
  }
  
  
  public function add_logo(Request $request){
      $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $user = customer::find($user_id);
            return view('userdashboard/logo/index',['user'=>$user]);
        }else{
             return redirect('Login');
        }
  }
  
  public function save_logo(Request $request){
      
      if ($request->hasFile('logo')) {
                  
        $file = $request->file('logo');
        $logo = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path('/images'), $logo);
        $logoa = $logo;
        

                
}else{
    
    $logoa = $request->oldlogo;
}
$user_id = $request->session()->get('FRONT_USER_ID');

if($request->id !=''){
   
    DB::table('logo')->where('uid',$user_id)->update(array('logo'=>$logoa));
}else{
   DB::table('logo')->insert(array('logo'=>$logoa,'uid'=>$user_id)); 
}

return back()->with('success','logo add successfully');



      
  }
  
  public function add_block(Request $request){
      $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $user = customer::find($user_id);
            return view('userdashboard/block/index',['user'=>$user]);
        }else{
             return redirect('Login');
        } 
  }


public function saveBlock(Request $request){
    
    if ($request->hasFile('image')) {
                  
        $file = $request->file('image');
        $image = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path('/images'), $image);
        $logoa = $image;
        

                
}else{
    
    $logoa = '';
}

$insertData = array(
    'uid'=>$request->session()->get('FRONT_USER_ID'),
    'title'=>$request->Block,
    'image'=>$logoa,
    'text'=>$request->description,
    );
    DB::table('blocks')->insert($insertData); 
return back()->with('success','Block add successfully');

}


public function add_google_map(Request $request){
      $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $user = customer::find($user_id);
            return view('userdashboard/map/index',['user'=>$user]);
        }else{
             return redirect('Login');
        } 
  }
  
  
  public function save_map(Request $request){
      $user_id = $request->session()->get('FRONT_USER_ID');
      
      if($request->id ==''){
          DB::table('map')->insert(array('map'=>$request->map,'uid'=>$user_id));
      }else{
           DB::table('map')->where('uid',$user_id)->delete();
      }
       DB::table('professions')->where('user_id',$user_id)->update(array('iframe'=>$request->map));
      
      return back()->with('success','Map Insert Successfully');
      
  }
  
  
  public function add_download(Request $request){
      $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $user = customer::find($user_id);
            return view('userdashboard/pdf/index',['user'=>$user]);
        }else{
             return redirect('Login');
        } 
  }
  
  
  public function save_pdf(Request $request){
      
    //   if ($request->hasFile('pdf')) {
                  
    //     $file = $request->file('pdf');
    //     $image = time().rand(1,100).'.'.$file->extension();
    //     $file->move(public_path('/images'), $image);
    //     $pdf = $image;
    //     }else{
            
    //         $pdf = '';
    //     }
    //   $user_id = $request->session()->get('FRONT_USER_ID');
    //   if($request->id ==''){
    //       DB::table('pdf')->insert(array('pdf'=>$pdf,'uid'=>$user_id));
    //   }else{
    //       DB::table('pdf')->where('uid',$user_id)->update(array('pdf'=>$pdf));
    //   }
    
      $user_id = $request->session()->get('FRONT_USER_ID');
    if ($request->hasFile('pdf')) {
        foreach ($request->file('pdf') as $file) {
            $image = time() . rand(1, 100) . '.' . $file->extension();
            $file->move(public_path('/images'), $image);

            DB::table('pdf')->insert([
                'uid'   => $user_id,
                'pdf' => $image,
                'created_at' => now()
            ]);
        }
    }
      
      return back()->with('success','Pdf Insert Successfully');
  }
  
    public function delete_pdf($id){
      
       $pdf = DB::table('pdf')->where('id', $id)->first();
        if ($pdf) {
            $file_path = public_path('/images/' . $pdf->pdf);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            DB::table('pdf')->where('id', $id)->delete();
        }
      
      return back()->with('success','Pdf Deleted Successfully');
  }
  
  
  
  public function update_Block(Request $request){
      
      if ($request->hasFile('image')) {
                  
        $file = $request->file('image');
        $image = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path('/images'), $image);
        $logoa = $image;
        

                
}else{
    
    $logoa = $request->oldimage;
}

$insertData = array(
    'uid'=>$request->session()->get('FRONT_USER_ID'),
    'title'=>$request->Block,
    'image'=>$logoa,
    'text'=>$request->description,
    );
    DB::table('blocks')->where('id',$request->id)->update($insertData); 
return redirect('/add_block')->with('success','Blogs update successfully');
      
      
      
  }
  
  
  public function add_achievment(Request $request){
      $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $user = customer::find($user_id);
            return view('userdashboard/achiev/index',['user'=>$user]);
        }else{
             return redirect('Login');
        } 
  }
  
  
    public function save_achievment(Request $request){
      
      
        // if ($request->hasFile('pdf')) {
                  
        //     $file = $request->file('pdf');
        //     $image = time().rand(1,100).'.'.$file->extension();
        //     $file->move(public_path('/images'), $image);
        //     $pdf = $image;
        // }else{
            
        //     $pdf = '';
        // }
        // $user_id = $request->session()->get('FRONT_USER_ID');
        //   if($request->id ==''){
        //       DB::table('achive')->insert(array('image'=>$pdf,'uid'=>$user_id));
        //   }else{
        //       DB::table('achive')->where('uid',$user_id)->update(array('image'=>$pdf));
        //   }
        
        $user_id = $request->session()->get('FRONT_USER_ID');

    if ($request->hasFile('pdf')) {
        foreach ($request->file('pdf') as $file) {
            $image = time() . rand(1, 100) . '.' . $file->extension();
            $file->move(public_path('/images'), $image);

            DB::table('achive')->insert([
                'uid'   => $user_id,
                'image' => $image,
                'created_at' => now()
            ]);
        }
    }
      
        return back()->with('success','Pdf Insert Successfully');
    }
  
  
  public function delete_achievment($id)
{
    $achiv = DB::table('achive')->where('id', $id)->first();
    if ($achiv) {
        $file_path = public_path('/images/' . $achiv->image);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        DB::table('achive')->where('id', $id)->delete();
    }

    return back()->with('success', 'File deleted successfully');
}
  public function edit_blogs(Request $request,$id){
    $user_id = $request->session()->get('FRONT_USER_ID');
	$blocks = DB::table('blocks')->where('uid',$user_id)->where('id',$id)->first();
	
        if(!empty($user_id)){
            $user = customer::find($user_id);
            return view('userdashboard/block/edit',['user'=>$user],compact('blocks'));
        }else{
             return redirect('Login');
        } 
	
	
	
  }
  
  public function delete_blogs($id){
      DB::table('blocks')->where('id',$id)->delete();
      return redirect('/add_block')->with('error','Delet Blogs successfully');
  }
  
  public function add_client(){
      return view('userdashboard/client/add_client');
  }
  
  public function saveClient(Request $req){
      
       if ($req->hasFile('image')) {
                  
        $file = $req->file('image');
        $image = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path('/images'), $image);
        $logoa = $image;
        }
        
        DB::table('clients')->insert(array('name'=>$req->Block,'image'=>$image,'text'=>$req->description,'uid'=>$req->session()->get('FRONT_USER_ID'),));
return back()->with('success','Client add successfully');

  }
  
  
  public function edit_client(Request $request,$id){
       $user_id = $request->session()->get('FRONT_USER_ID');
	  $blocks = DB::table('clients')->where('uid',$user_id)->where('id',$id)->first();
	
        if(!empty($user_id)){
            $user = customer::find($user_id);
            return view('userdashboard/client/edit',['user'=>$user],compact('blocks'));
        }else{
             return redirect('Login');
        } 
  }
  
  public function update_client(Request $req){
      
      if ($req->hasFile('image')) {
                  
        $file = $req->file('image');
        $image = time().rand(1,100).'.'.$file->extension();
        $file->move(public_path('/images'), $image);
        $logoa = $image;
        }else{
            $logoa = $req->oldimage;
        }
        
        DB::table('clients')->where('id',$req->id)->update(array('name'=>$req->Block,'image'=>$logoa,'text'=>$req->description));
return back()->with('success','Client add successfully');

  }
  
  public function delete_client($id){
      DB::table('clients')->where('id',$id)->delete();
      return back()->with('Client deleted successfully');
  }
  
  public function add_qual_hed(Request $request){
      $user_id = $request->session()->get('FRONT_USER_ID');
      $check = DB::table('headings')->where('userid',$user_id)->first();
      
     
      if($check!=''){
          if($request->type == 0){
          DB::table('headings')->where('id',$check->id)->update(array('qual'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 1){
          
          
           DB::table('headings')->where('id',$check->id)->update(array('service'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 2){
           DB::table('headings')->where('id',$check->id)->update(array('thought'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 3){
           DB::table('headings')->where('id',$check->id)->update(array('personal'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 4){
           DB::table('headings')->where('id',$check->id)->update(array('prefessional'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 5){
           DB::table('headings')->where('id',$check->id)->update(array('videos'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 6){
           DB::table('headings')->where('id',$check->id)->update(array('prdoducts'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 7){
           DB::table('headings')->where('id',$check->id)->update(array('links'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 8){
           DB::table('headings')->where('id',$check->id)->update(array('pdf'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 9){
           DB::table('headings')->where('id',$check->id)->update(array('logo'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 10){
           DB::table('headings')->where('id',$check->id)->update(array('blogs'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 11){
           DB::table('headings')->where('id',$check->id)->update(array('map'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 12){
           DB::table('headings')->where('id',$check->id)->update(array('resume'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 13){
           DB::table('headings')->where('id',$check->id)->update(array('achiev'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 14){
           DB::table('headings')->where('id',$check->id)->update(array('client'=>$request->heading,'userid'=>$user_id));
      }
      }else{
          
          
          if($request->type == 0){
          DB::table('headings')->insert(array('qual'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 1){
           DB::table('headings')->insert(array('service'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 2){
           DB::table('headings')->insert(array('thought'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 3){
           DB::table('headings')->insert(array('personal'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 4){
           DB::table('headings')->insert(array('prefessional'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 5){
           DB::table('headings')->insert(array('videos'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 6){
           DB::table('headings')->insert(array('prdoducts'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 7){
           DB::table('headings')->insert(array('links'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 8){
           DB::table('headings')->insert(array('pdf'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 9){
           DB::table('headings')->insert(array('logo'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 10){
           DB::table('headings')->insert(array('blogs'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 11){
           DB::table('headings')->insert(array('map'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 12){
           DB::table('headings')->insert(array('resume'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 13){
           DB::table('headings')->insert(array('achiev'=>$request->heading,'userid'=>$user_id));
      }elseif($request->type == 14){
           DB::table('headings')->insert(array('client'=>$request->heading,'userid'=>$user_id));
      }
          
          
      }
      
      
      
      return back()->with('success','Heading save Successfully');
  }


    // =============================================
    // COMPANY MANAGEMENT METHODS
    // =============================================

    /**
     * Display list of all companies
     */
    public function adminCompanies(Request $request)
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(20);
        return view('admin-new.company.index', compact('companies'));
    }

    /**
     * View single company details
     */
    public function adminViewCompany($id)
    {
        $company = Company::findOrFail($id);
        return view('admin-new.company.view', compact('company'));
    }

    /**
     * Edit company form
     */
    public function adminEditCompany($id)
    {
        $company = Company::findOrFail($id);
        return view('admin-new.company.edit', compact('company'));
    }

    /**
     * Update company details
     */
    public function adminUpdateCompany(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,'.$id,
            'card_limit' => 'required|integer|min:0',
        ]);

        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->website = $request->website;
        $company->address = $request->address;
        $company->city = $request->city;
        $company->state = $request->state;
        $company->industry = $request->industry;
        $company->profession_type = $request->profession_type;
        $company->card_limit = $request->card_limit;
        $company->subscription_tier = $request->subscription_tier;
        $company->subscription_start = $request->subscription_start;
        $company->subscription_end = $request->subscription_end;
        $company->status = $request->status;

        // Handle logo upload
        if($request->hasFile('logo')){
            // Delete old logo
            if($company->logo && File::exists(public_path('uploads/company/'.$company->logo))){
                File::delete(public_path('uploads/company/'.$company->logo));
            }

            $file = $request->file('logo');
            $filename = time().'_'.rand(1000,9999).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/company'), $filename);
            $company->logo = $filename;
        }

        $company->save();

        return redirect('admin/companies/'.$id)->with('success', 'Company updated successfully');
    }

    /**
     * Toggle company status
     */
    public function adminToggleCompanyStatus(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->status = $request->status;
        $company->save();

        return response()->json(['success' => true, 'status' => $company->status]);
    }

    /**
     * Update company card limit
     */
    public function adminUpdateCompanyLimit(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->card_limit = $request->card_limit;
        $company->save();

        return back()->with('success', 'Card limit updated successfully');
    }

    /**
     * Delete company
     */
    public function adminDeleteCompany($id)
    {
        $company = Company::findOrFail($id);

        // Delete staff records
        CompanyStaff::where('company_id', $id)->delete();

        // Delete logo
        if($company->logo && File::exists(public_path('uploads/company/'.$company->logo))){
            File::delete(public_path('uploads/company/'.$company->logo));
        }

        $company->delete();

        return redirect('admin/companies')->with('success', 'Company deleted successfully');
    }

    /**
     * View company staff
     */
    public function adminCompanyStaff($id)
    {
        $company = Company::findOrFail($id);
        $staff = CompanyStaff::where('company_id', $id)->paginate(20);
        return view('admin-new.company.staff', compact('company', 'staff'));
    }

    /**
     * Company subscription management
     */
    public function adminCompanySubscription($id)
    {
        $company = Company::findOrFail($id);
        return view('admin-new.company.subscription', compact('company'));
    }

    /**
     * Export companies to CSV
     */
    public function adminExportCompanies(Request $request)
    {
        $companies = Company::orderBy('created_at', 'desc')->get();

        $filename = 'companies_export_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($companies) {
            $file = fopen('php://output', 'w');

            // CSV Header
            fputcsv($file, [
                'ID',
                'Name',
                'Email',
                'Phone',
                'Industry',
                'Profession Type',
                'Website',
                'Address',
                'City',
                'State',
                'Country',
                'Subscription Tier',
                'Card Limit',
                'Cards Used',
                'Status',
                'Created At',
                'Staff Count'
            ]);

            // CSV Data
            foreach ($companies as $company) {
                $professionTypes = [
                    1 => 'Business',
                    2 => 'Medical',
                    3 => 'Legal',
                    4 => 'Education',
                    5 => 'Technology',
                    6 => 'Creative',
                    7 => 'Finance',
                    8 => 'Real Estate',
                    9 => 'Hospitality',
                    10 => 'Restaurant',
                    11 => 'Retail',
                    12 => 'Non-Profit',
                    13 => 'Other'
                ];

                fputcsv($file, [
                    $company->id,
                    $company->name,
                    $company->email,
                    $company->phone,
                    $company->industry,
                    $professionTypes[$company->profession_type] ?? 'Unknown',
                    $company->website,
                    $company->address,
                    $company->city,
                    $company->state,
                    $company->country,
                    $company->subscription_tier ?? 'free',
                    $company->card_limit,
                    $company->cards_used,
                    $company->status ? 'Active' : 'Inactive',
                    $company->created_at->format('Y-m-d H:i:s'),
                    $company->staff()->count()
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // =============================================
    // PROFESSION THEMES MANAGEMENT
    // =============================================

    /**
     * Display all profession themes
     */
    public function adminProfessionThemes()
    {
        $themes = ProfessionTheme::orderBy('sort_order')->get();
        return view('admin-new.themes.index', compact('themes'));
    }

    /**
     * Toggle theme active status
     */
    public function adminToggleTheme($id)
    {
        $theme = ProfessionTheme::findOrFail($id);
        $theme->is_active = !$theme->is_active;
        $theme->save();

        return back()->with('success', 'Theme status updated successfully');
    }

    /**
     * Analytics Dashboard
     */
    public function adminAnalytics()
    {
        // Company Stats
        $totalCompanies = Company::count();
        $activeCompanies = Company::where('status', 'active')->count();
        $newCompaniesThisMonth = Company::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Staff Card Stats
        $totalStaffCards = CompanyStaff::count();
        $activeStaffCards = CompanyStaff::where('card_enabled', 1)->count();
        $newCardsThisMonth = CompanyStaff::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // User Stats (Individual users)
        $totalUsers = \DB::table('users')->count();
        $activeUsers = \DB::table('users')->where('status', 1)->count();
        $newUsersThisMonth = \DB::table('users')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        // Subscription Distribution
        $subscriptionTiers = Company::selectRaw('COALESCE(subscription_tier, "free") as tier, COUNT(*) as count')
            ->groupBy('tier')
            ->pluck('count', 'tier')
            ->toArray();

        // Profession Type Distribution
        $professionTypes = [
            1 => 'Business', 2 => 'Medical', 3 => 'Legal', 4 => 'Education',
            5 => 'Technology', 6 => 'Creative', 7 => 'Finance', 8 => 'Real Estate',
            9 => 'Hospitality', 10 => 'Restaurant', 11 => 'Retail', 12 => 'Non-Profit', 13 => 'Other'
        ];

        $professionDistribution = Company::selectRaw('profession_type, COUNT(*) as count')
            ->whereNotNull('profession_type')
            ->groupBy('profession_type')
            ->pluck('count', 'profession_type')
            ->toArray();

        // Monthly Registrations (Last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('M Y');

            $monthlyData[$monthKey] = [
                'companies' => Company::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'staff' => CompanyStaff::whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
                'users' => \DB::table('users')
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->count(),
            ];
        }

        // Recent Companies
        $recentCompanies = Company::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Recent Staff Cards
        $recentStaff = CompanyStaff::with('company')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Card Usage Stats
        $totalCardsLimit = Company::sum('card_limit');
        $totalCardsUsed = Company::sum('cards_used');
        $cardUsagePercent = $totalCardsLimit > 0 ? round(($totalCardsUsed / $totalCardsLimit) * 100, 1) : 0;

        // Companies near limit (>80% usage)
        $companiesNearLimit = Company::whereRaw('cards_used >= card_limit * 0.8')
            ->where('card_limit', '>', 0)
            ->count();

        return view('admin-new.analytics.index', compact(
            'totalCompanies', 'activeCompanies', 'newCompaniesThisMonth',
            'totalStaffCards', 'activeStaffCards', 'newCardsThisMonth',
            'totalUsers', 'activeUsers', 'newUsersThisMonth',
            'subscriptionTiers', 'professionTypes', 'professionDistribution',
            'monthlyData', 'recentCompanies', 'recentStaff',
            'totalCardsLimit', 'totalCardsUsed', 'cardUsagePercent', 'companiesNearLimit'
        ));
    }

    /**
     * Live preview of theme with user's actual data
     */
    public function themeLivePreview(Request $request, $themeId)
    {
        $user_id = $request->session()->get('FRONT_USER_ID');

        if (empty($user_id)) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $theme = ProfessionTheme::find($themeId);
        if (!$theme) {
            return response()->json(['error' => 'Theme not found'], 404);
        }

        // Load user's actual data
        $d['userdata'] = customer::where('id', $user_id)->first();
        $d['qualifications'] = Qualification::where('user_id', $user_id)->orderby('id', 'DESC')->get();
        $d['professions'] = Profession::where('user_id', $user_id)->orderby('id', 'DESC')->get();
        $d['thoughts'] = Thought::where('user_id', $user_id)->orderby('id', 'DESC')->get();
        $d['portfolios'] = Portfolio::where('user_id', $user_id)->orderby('id', 'DESC')->get();
        $d['social'] = Social::where('user_id', $user_id)->first();
        $d['videos'] = Video::where('user_id', $user_id)->orderby('id', 'DESC')->get();
        $d['professional_photos'] = Professional_photo::where('user_id', $user_id)->orderby('id', 'DESC')->get();
        $d['myproducts'] = Myproduct::where('user_id', $user_id)->orderby('id', 'DESC')->get();
        $d['theme'] = $theme;
        $d['isLivePreview'] = true; // Flag for compact preview mode

        // Restaurant-specific data (Theme ID 13)
        if ($themeId == 13) {
            $d['menuCategories'] = MenuCategory::where('customer_id', $user_id)
                ->where('is_active', 1)
                ->orderBy('sort_order')
                ->with(['items' => function($q) {
                    $q->where('is_available', 1)->orderBy('sort_order');
                }])
                ->get();
            $d['restaurantInfo'] = RestaurantInfo::where('customer_id', $user_id)->first();
        }

        // Return rendered HTML for iframe
        return view('frontend.profile-themes.preview-wrapper', $d);
    }

    /**
     * Show visibility settings page
     */
    public function visibilitySettings(Request $request)
    {
        $user_id = $request->session()->get('FRONT_USER_ID');

        if (empty($user_id)) {
            return redirect()->route('login');
        }

        $d['user'] = customer::findOrFail($user_id);
        $d['visibility_settings'] = $d['user']->visibility_settings ?? $d['user']->getDefaultVisibilitySettings();

        return view('userdashboard-new.settings.visibility', $d);
    }

    /**
     * Update visibility settings
     */
    public function updateVisibilitySettings(Request $request)
    {
        $user_id = $request->session()->get('FRONT_USER_ID');

        if (empty($user_id)) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $user = customer::findOrFail($user_id);

        // Get all submitted settings
        $settings = $request->input('visibility', []);

        // Convert checkbox values to boolean
        $visibilitySettings = [];
        $allFeatures = $user->getDefaultVisibilitySettings();

        foreach ($allFeatures as $feature => $defaultValue) {
            $visibilitySettings[$feature] = isset($settings[$feature]) ? true : false;
        }

        // Update the user's visibility settings
        $user->visibility_settings = $visibilitySettings;
        $user->save();

        return redirect()->back()->with('success', 'Visibility settings updated successfully!');
    }

    /**
     * Reset visibility settings to defaults
     */
    public function resetVisibilitySettings(Request $request)
    {
        $user_id = $request->session()->get('FRONT_USER_ID');

        if (empty($user_id)) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        $user = customer::findOrFail($user_id);
        $user->resetVisibilityToDefaults();

        return redirect()->back()->with('success', 'Visibility settings reset to defaults!');
    }

}

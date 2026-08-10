<?php

namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
use App\Models\Order;   
use App\Models\OrderMeta;  
use App\Models\OrderProduct;  
use App\Models\Faq; 
use App\Models\Cart; 
use App\Models\Message;     
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

use App\Models\Agent;

use App\Models\Preorder;

use App\Models\Video;
use App\Models\Professional_photo;
use App\Models\Myproduct;
use App\Models\ProfessionTheme;
use App\Models\ProfileLocationTrack;
use App\Models\ProfileEngagement;
use App\Models\ProductionService;
use App\Models\ProductionPortfolio;
use App\Models\ProductionTeam;
use App\Models\JewelleryProduct;
use App\Models\MetalRate;
use App\Models\TechService;
use App\Models\TechCaseStudy;
use App\Models\TourPackage;
use App\Models\FitnessProgram;
use App\Models\FitnessTrainer;
use App\Models\FitnessMembership;
use App\Models\FitnessClass;
use App\Models\TransformationGallery;
use App\Models\DietPlan;
use App\Models\LegalService;
use App\Models\SalonService;
use App\Models\SalonArtist;
use App\Models\SalonPackage;
use App\Models\SalonPortfolio;
use App\Models\SalonProduct;
use App\Models\PoliticalProfile;
use App\Models\PublicService;
use App\Models\DevelopmentProject;
use App\Models\PublicEvent;
use App\Models\InteriorService;
use App\Models\InteriorProject;
use App\Models\InteriorPortfolio;
use App\Models\DesignConsultation;
use App\Models\EducationCourse;
use App\Models\EducationFaculty;
use App\Models\EducationResult;
use App\Models\CaService;
use App\Models\CaClientCase;
use App\Models\CaConsultation;
use App\Models\ComplianceDeadline;
use App\Models\AstroService;
use App\Models\AstroConsultation;
use App\Models\AstroClientData;
use App\Models\SecurityProduct;
use App\Models\SecuritySiteSurvey;
use App\Models\SecurityProject;
use App\Models\SecurityAmc;
use App\Models\SolarSolution;
use App\Models\SolarProject;
use App\Models\SolarMonitoring;
use App\Models\SolarAmc;
use App\Models\CreatorStat;
use App\Models\BrandCollaboration;
use App\Models\CreatorPortfolio;
use App\Models\SubsidyApplication;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Crypt;
use Session;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;
use File;
use Illuminate\Support\Facades\Auth;
use App\Mail\Ieltmail;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\Process\Process;
use App\Models\ProfilePdfJob;
use App\Jobs\GenerateProfilePdf;
use Illuminate\Support\Facades\Storage;

/*anand start code */
use Illuminate\Support\Facades\Hash;

// for phone pay
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
//

/* anand end code */

class FrontendController extends Controller
{
 

// public function raf_create_vcard($cust)
// {
//     $res=customer::where('mobile',$cust)->first();
    
//     // echo "<pre>";
//     // print_r($res);
//     // echo "</pre>";
//     // die;
    
//     if($res){
//     $name=$res->name;
//     $company_name='FASTAP';
//     $email=$res->email;
//     $mobile_no=$res->mobile;
//     $headers=['Content-Type'=>'text/x-vcard'];  
//     $vCard = "BEGIN:VCARD\r\n";
//     $vCard .= "VERSION:3.0\r\n";
//     $vCard .= "FN:" . $res->name . "\r\n";
//     $vCard .= "TITLE:" . 'FASTAP' . "\r\n";

//   if($email){
//     $vCard .= "EMAIL;TYPE=internet,pref:" . $email . "\r\n";
//   }
// //   if(isset($getPhoto)){
// //     $vCard .= "PHOTO;ENCODING=b;TYPE=JPEG:";
// //     $vCard .= $photo . "\r\n";
// //   }

// // anand start code for image //

//     // Add an image (base64-encoded) to the vCard
//     $imageData = file_get_contents(public_path("frontend/user_images',$res->profile")); // Replace with the actual image path


//     $NoimageData = file_get_contents(public_path("frontend/images/img_avatar3.png")); // Replace with the actual image path


//     if($res->profile)
//     {
//         $base64Image = base64_encode($imageData);
//         $vCard .= "PHOTO;TYPE=JPEG;ENCODING=BASE64:" . $base64Image . "\n";
//     }
//     else{
//         $Nobase64Image = base64_encode($NoimageData);
//         $vCard .= "PHOTO;TYPE=JPEG;ENCODING=BASE64:" . $Nobase64Image . "\n";
//     }

// // anand end code for image //

//   if($mobile_no){
//     $vCard .= "TEL;TYPE=work,voice:" . $mobile_no . "\r\n"; 
//   } 

//   $vCard .= "END:VCARD\r\n"; 
 
//         $filename=rand(0,99).time();
//         $f=File::put(public_path($filename.'.vcf'),$vCard);
//         // return $f;
//         return response()->download(public_path($filename.'.vcf'))->deleteFileAfterSend(true);
// }


// return redirect()->back();
//             // return download()->$vcard;
// }

public function raf_create_vcard($cust)
{
    $res = Customer::where('mobile', $cust)->first();
    
    if ($res) {
        $name = $res->name;
        $company_name = 'FASTAP';
        $email = $res->email;
        $mobile_no = $res->mobile;
        
        $vCard = "BEGIN:VCARD\r\n";
        $vCard .= "VERSION:3.0\r\n";
        $vCard .= "FN:" . $res->name . "\r\n";
        $vCard .= "TITLE:" . 'FASTAP' . "\r\n";
        
        if ($email) {
            $vCard .= "EMAIL;TYPE=internet,pref:" . $email . "\r\n";
        }
        
        // Add an image to the vCard
        if ($res->profile) {
            $imageData = file_get_contents(public_path("frontend/user_images/{$res->profile}"));
        } else {
            // Use a default image if no profile image is available
            $filePath = base_path('frontend/images/img_avatar3.png');
            if (file_exists($filePath)) {
                $imageData = file_get_contents($filePath);
            }
            //$imageData = file_get_contents(public_path("frontend/images/img_avatar3.png"));
        }

        $base64Image = base64_encode($imageData);
        $vCard .= "PHOTO;TYPE=JPEG;ENCODING=BASE64:" . $base64Image . "\n";
        
        if ($mobile_no) {
            $vCard .= "TEL;TYPE=work,voice:" . $mobile_no . "\r\n"; 
        }
        
        $vCard .= "END:VCARD\r\n"; 
        
        $filename = rand(0, 99) . time();
        File::put(public_path($filename . '.vcf'), $vCard);
        
        return response()->download(public_path($filename . '.vcf'))->deleteFileAfterSend(true);
    }
    
    return response()->json(['message' => 'Customer not found'], 404);
}




    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact-new');
    }
    
    public function corporate(){
        return view('frontend.corporate-new');
    }
    
    public function jointeam(){
        return view('frontend.join_team');
    }
  
    public function login()
    {
        return view('frontend.login-new');
    }
    
    // for gold login
    public function logingold()
    {
        return view('frontend.logingold');
    }
    //
    
    public function signin()
    {
        
        return view('frontend.signin');
    }
    
    // Forgot Password
    public function forgot_password()
    {
        return view('frontend.forgot_password');
    }
    
    function set_forgot_password(){
        $user=Customer::where('id',session()->get('FRONT_USER_ID'))->first();
        return view('userdashboard.set_forgot_password',compact('user'));
    } 
    
    public function update_forget_password(Request $request)
    {
        
        // dd($request->all());
        // return;
        
        $user_id = $request->session()->get('FRONT_USER_ID');
        
        if (!empty($user_id)) {
            $customer = Customer::find($user_id);
    
            $request->validate([
                //'old_password' => 'required',
                'new_password' => 'required',
                'confirm_pass' => 'required|same:new_password',
            ]);
    
            //$oldPassword = $request->input('old_password');
            $newPassword = $request->input('new_password');
            
            // Validate old password
            // if (!Hash::check($oldPassword, $customer->password)) {
            //     return redirect()->back()->withErrors(['old_password' => 'Incorrect old password']);
            // }
    
            // Update password
            $customer->password = Hash::make($newPassword);
            $customer->save();
    
            return redirect('Login')->with('success', 'Password changed successfully. Please log in.');
        } else {
            return redirect('Login'); // Assuming 'login' is the route name for your login page
        }
    }
    
    //
    
    // anand start code forgot password 
    public function forgot_password_email(Request $request)
    {
        //   dd($request->all());
        // return;
        
        $customer = Customer::where('email', $request->email)->first();
    
        if ($customer) {

            /* user mail start */
                $data = ['email'=>"$request->email"];
                $user['to'] = "$request->email";



                //Mail::send('frontend.forgot_password_mail' , $data,function($messages)  use ($user){
                   // $messages->to($user['to']);
                  //  $messages->subject('Change Password');
                //})
                // \Mail::send([], [], function ($message)use($request) {
                //     $message->to($request->email) ->subject('Change password')
                //     ->html(view('frontend.forgot_password_mail', ['email' => $request->email])->render());
                    
                // });
                
    //              $email = $request->email;

    // Mail::send('frontend.forgot_password_mail', ['email' => $email], function ($message) use ($email) {
    //     $message->to($email)
    //             ->subject('Change Password');
    // });
                
            /* user mail end */
        
            return back()->withSuccess("We have e-mailed your password reset link!");
            
        } else {
            // Customer not found
            //echo "We can't find a user with that email address.";
            return back()->withError("We can't find a user with that email address.");
        }
    }
    
    public function passwordReset($encodedEmail)
    {   
        // Decode the email
        $email = base64_decode($encodedEmail);
        //echo $email;
        return view('frontend.passwordreset_form',compact('email'));
    }
    
    // Reset Password form  
    public function forgot_reset_password(Request $request)
    {
        // dd($request->all());
        // return;
        $request->validate([
            'pwd' => 'required', // Adjust the minimum length as needed
            'cpwd' => 'required|same:pwd', // Ensure cpwd is the same as pwd
        ], [
            'pwd.required' => 'The password field is required.',
            'cpwd.required' => 'The confirm password field is required.',
            'cpwd.same' => 'The confirm password and password must match.',
        ]);
    
       // Find the customer by email
        $customer = Customer::where('email', $request->email)->first();
        
        // Check if the customer exists
        if (!$customer) {
            return back()->withError("Customer not found.");
        }
        
        // Update password
        $customer->password = Hash::make($request->pwd);
        $customer->save();
        
        return redirect('Login')->with('success', 'Password changed successfully. Please log in.');
        
    }
    //
    
    // anand end code forgot password
    
     public function teams()
    {
        return view('frontend.team');
    }
    
    
    public function products($type=null)
    {
        $product=product::where('status','1')->orderBy('id')->paginate(8);
        return view('frontend.products-new',compact('product','type'));
    } 
    


    public function faq()
    {
        $show_info = Faq::orderBy('id','asc')->get()->all();
        return view('frontend.faq-new',compact('show_info'));
    }
  
    
    public function blog_list()
    {
        return view('frontend-new.blog-list');
    }

    public function blog_details()
    {
        return view('frontend/blog-details');
    }

    // Pre order start 
    
    public function preorder()
    {
        return view('frontend/preorder');
    }
    
    function savepreorder(request $request){
    
        // dd($request->all());
        // die;
        
        $request->validate([
        'card_type'=>'required',
        'transaction_id'=>'required',
        'name'=>'required',
        'phone'=>'required',
        'email'=>'required',
        'image'=>'required',
        ]);
        
        // upload image
        
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/preorder/images'),$imageName);


        $preorder = new Preorder;
        $preorder->image = $imageName;
        $preorder->card_type=$request->card_type;
        $preorder->transaction_id=$request->transaction_id;
        $preorder->name=$request->name;
        $preorder->phone=$request->phone;
        $preorder->email=$request->email;
        
        $preorder->address=$request->address;
        
        $preorder->employee_code=$request->employee_code;
        
        $preorder->save();
          
        // return back()->with('message_contact','Message Send Successfully...');
        return back()->withSuccess('Message Send Successfully !!!!');
    }
    
    // Pre order end
    
    public function registration(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN')!=null){
            return redirect('');
        }
        
        $result=[];
        return view('frontend.registration',$result);
    }


    
    public function registration_process(Request $request)
    {
       $valid=Validator::make($request->all(),[
            "name"=>'required',
            "email"=>'required|email|unique:customers,email',
            "password"=>'required',
            "mobile"=>'required|numeric|digits:10|unique:customers',
            "cpassword"=>'required',

       ]);

       if(!$valid->passes()){
            return response()->json(['status'=>'error','error'=>$valid->errors()->toArray()]);
       }else{
            $arr=[
                "name"=>$request->name,
                "email"=>$request->email,
                "password"=>Crypt::encrypt($request->password),
                "mobile"=>$request->mobile,
                "status"=>1,
                "created_at"=>date('Y-m-d h:i:s'),
                "updated_at"=>date('Y-m-d h:i:s')
            ];
            $query=DB::table('customers')->insert($arr);
            if($query){
                
                // $request->session('Login')->flash('success', 'Registration successfully');

                return response()->json(['status'=>'success','msg'=>"Registration successfully"]);
            }

       }
    }
    
    
   public function login_process(Request $request)
    {
        
        
        if($request->phone){
            $result=customer::firstOrCreate(['mobile'=>$request->phone],[
                'mobile'=>$request->phone,
                ]);
                
        
                if($result){
                   
                    $request->session()->put('FRONT_USER_LOGIN',true);
                $request->session()->put('FRONT_USER_ID',$result->id);
                $request->session()->put('FRONT_USER_NAME',$result->name??'Update Your name');
                $status="success";
                $msg="";
                return response()->json(['status'=>$status,'msg'=>$msg]); 
                }
               else{
                     $status="error";
                $msg="Please enter valid Mobile";
                return response()->json(['status'=>$status,'msg'=>$msg]); 
               }
           
            
        }
        $result=DB::table('customers')  
            ->where(['email'=>$request->str_login_email])
            ->get(); 
        
        if(isset($result[0])){
            $db_pwd=Crypt::decrypt($result[0]->password);
            if($db_pwd==$request->str_login_password){
                $request->session()->put('FRONT_USER_LOGIN',true);
                $request->session()->put('FRONT_USER_ID',$result[0]->id);
                $request->session()->put('FRONT_USER_NAME',$result[0]->name);
                $status="success";
                $msg="";
            }else{
                $status="error";
                $msg="Please enter valid password";
            }
        }else{
            $status="error";
            $msg="Please enter valid email id";
        }
       return response()->json(['status'=>$status,'msg'=>$msg]); 
       //$request->password
    }
    

    public function productshow()
    {
        $products['pro'] = Product::all()->where('status','=','1');
      
         
       return view('',$products);
    }
    
    
    public function allproductshow(Request $request, $id)
    {
        $products['allpro'] = Product::where('status','=','1')->where('catagory_id',$id)->get();
   
       return view('frontend.products',$products);

    }
    
    public function showproduct(Request $request)
    {
        $products['allpro'] = Product::where('status','=','1')->get();
       
         
       return view('frontend.products',$products);
    }

    
function viewcategroy_list(){


    $data['viewcategroylist'] = category::all();
    
   return view('frontend.index',$data);
}




    // public function shoping_cart(Request $request,$id){
   
    //                 $user_id = $request->session()->get('FRONT_USER_ID');
                    
    //                 if(!empty($user_id)){
                    
    //                 $cart = new Cart;
    //                 $cart->user_id = $user_id;
    //                 $cart->product_id =$id;
    //                 $cart->quantity =   $request->quantity;
    //                 $cart->save();
                    
    //                 return redirect()->back()->with('alert','Your Product Succssessfully Added in Cart');
                    
                    
    //                 }else{
    //                 return redirect('Login');
    //                 }
                    
    //                 } 
   
    public function shoping_cart(Request $request,$id,$internal=false){
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            // $cartdata = Cart::where('user_id',$user_id)->where('product_id',$id)->first();
            // if(!empty($cartdata)){
            //     return redirect()->back();
            // }else{
                /*$request->validate([
                    'name'=>'required',
                    'designation'=>'required',
                    //'email'=>'required',
                ]);*/
                $cart = new Cart;
                $cart->user_id = $user_id;
                $cart->product_id =$id;
                $cart->quantity = 1;
                $cart->name = $request->name;
                $cart->mobile = $request->phone;
                //$cart->email = $request->email;
                $cart->designation = $request->designation;
                $cart->logo_status = $request->vehicle3;
                
                if($request->hasfile('image'))
                {
                    $file = $request->file('image');
                    $extention = $file->getClientOriginalExtension();
                    $filename = time().'.'.$extention;
                    $destinationPath = public_path('frontend/portfolio');
                    $file->move($destinationPath, $filename);
                    $cart->image = $filename;
                }
               
                $cart->save();
                
                customer::firstOrCreate([
                    'mobile'=>$request->phone,
                ],[
                    'name'=> $request->name,
                    'mobile'=>$request->phone,
                    'profession'=>$request->designation
                ]);
            if(!empty($internal)){
                return true;
            }
            return redirect('new-cart');
        }else{
            return redirect('Login');
        }
    }
    public function cartlist(Request $request){

        $user_id = $request->session()->get('FRONT_USER_ID');
        $d['coupon']= (int)$request->session()->get('coupondata') ?? 0;
        if(!empty($user_id)){
            $d['cartdata'] = Cart::join('products', 'products.id', '=', 'carts.product_id')
                ->where('carts.user_id', $user_id)
                ->get();
            $d['data'] = Cart::where('user_id',$user_id)->where('logo_status',1)->get();

           session()->forget('coupon');
            return view('frontend.cart-new',$d);
        }else{
             return redirect('Login');
        }

    }
    
    // public function applycoupon(Request $request){
    //     $total = $request->coupontotal;
    //     $couponcode = $request->couponcode;
    //     $coupondata = coupon::where('name',$couponcode)->first();
    //     if(!empty($coupondata)){
    //         $discount = $coupondata->discount;
    //         $asd = $discount/100;
           
    //         $d['total'] = $asd*$total;
    //         return view('frontend.shoping_cart',$d);
    //     }
        
    // }
    
public function setcoupon(Request $request){
 
// return Session::get('coupon');


        if(!empty($request->coupon)){
        
          $couponvalue=coupon::where('name',$request->coupon)->first();
          if(!empty($couponvalue)){
              $coupon=$couponvalue->discount;
              $request->session()->put('coupondata',$coupon);
              $request->session()->put('isCouponData',$couponvalue);
          
              return redirect()->back();
           
             
          }else{
             return redirect()->back()->with('error', 'Coupon code invalid');
          }
          
        }else{
            return redirect()->back()->with('error', 'Coupon code invalid');
        }

      
    }
    
/* anand start code */
    
    public function setagentcode(Request $request){
 
 //dd($request->all());
       // return;
    // return Session::get('coupon');


        if(!empty($request->agent_code)){
        
          $agentcodevalue=Agent::where('agent_code',$request->agent_code)->first();
          if(!empty($agentcodevalue)){
              $coupon=$agentcodevalue->commission;
              $request->session()->put('agentcodedata',$coupon);
              $request->session()->put('isAgentcodeData',$agentcodevalue);
          
              return redirect()->back();
           
             
          }else{
             return redirect()->back()->with('error', 'Agent code invalid');
          }
          
        }else{
            return redirect()->back()->with('error', 'Agent code invalid');
        }

      
    }
    
    public function removeAgentCode(Request $request){
        session()->forget('agentcodedata');
        session()->forget('isAgentcodeData');
        return redirect()->back();
    }
    
    public function getTitles(Request $request)
    {
     // Fetch individual title values from the customers table
        $title1 = Customer::pluck('title1')->first();
        $title2 = Customer::pluck('title2')->first();
        $title3 = Customer::pluck('title3')->first();
        $title4 = Customer::pluck('title4')->first();

        return response()->json(compact('title1', 'title2', 'title3', 'title4'));
        
    }
/* anand end code */
    
    
    public function removeCouponCode(Request $request){
        session()->forget('coupondata');
        session()->forget('isCouponData');
        return redirect()->back();
    }
    public function cartdelete(Request $request,$id){
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            Cart::where('product_id',$id)->where('user_id',$user_id)->delete();
            return redirect()->back();
        }else{
             return redirect('Login');
        }
    }
    public function cartupdate(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        //$price = $request->price;
         $status = false;
        if(!empty($user_id)){
            $status = true;
            $data = Cart::where('product_id',$product_id)->where('user_id',$user_id)->first();
            $data->quantity = $quantity;
            $data->save();
            return response()->json(['status' => $status]);
        }else{
             return response()->json(['status' => $status]);
        }
    }
    
    public function checkout(Request $request)
    {
      
        $d['coupon']= (int)$request->session()->get('coupondata') ?? 0;
        $user_id = $request->session()->get('FRONT_USER_ID');
        if(!empty($user_id)){
            $d['cartdata'] = Cart::join('products','products.id','=','carts.product_id')->where('user_id',$user_id)->get();
            return view('frontend.checkout',$d);
        }else{
             return redirect('Login'); 
        }
    }
    
    /* anand start code for send and get request to new-checkout page   */
    
        // public function processForm(Request $request)
        // {
        //     $request->validate([
        //         'first_name' => 'required|string|max:100',
        //         'last_name'  => 'required|string|max:100',
        //         'company_name' => 'required|string|max:100',
        //         'message' => 'required',
        //         'city' => 'required',
        //         'pincode' => 'required',
        //         'country' => 'required|not_in:select',
        //         'email' => 'required|email',
        //         'phone' => 'required',
        //     ]);
        
        //     // dd($request->all());
        //     // die();
        //     // Retrieve form data
        //     $first_name = $request->input('first_name');
        //     $last_name = $request->input('last_name');
            
        //     $company_name = $request->input('company_name');
        //     $message = $request->input('message');
        //     $city = $request->input('city');
        //     $pincode = $request->input('pincode');
        //     $country = $request->input('country');
        //     $email = $request->input('email');
        //     $phone = $request->input('phone');
            
        //     $total = $request->input('total');
        
        //     // session ids 
        //     $user_id = Session::get('FRONT_USER_ID');
            
        //     $coupondata = Session::get('coupondata');
        //     $isCouponData = Session::get('isCouponData');
            
        //     $agentcodedata = Session::get('agentcodedata');
        //     $isAgentcodeData = Session::get('isAgentcodeData');
        //     //
            
        //     // You can process the data here as needed
        //     // For this example, we'll just display it on the next page
        //     return view('frontend.shipping', ['first_name' => $first_name, 'last_name' => $last_name , 'company_name' => $company_name , 'message' => $message, 'city' => $city, 'pincode' => $pincode, 'country' => $country, 'email' => $email, 'phone' => $phone , 'total'=>$total , 'user_id'=>$user_id , 'coupondata'=>$coupondata , 'isCouponData'=>$isCouponData , 'agentcodedata'=>$agentcodedata , 'isAgentcodeData'=>$isAgentcodeData ]);
        // }
    
    /* anand end code for send and get request to new-checkout page  */
    
    
    /* anand start code for phone pay payment gatway */
    
    public function phonePe(Request $request)
    {
        $formData = $request->all();
        // dd($request->all());
        // return;
        
        $amount = $formData['total'];
        //$amount = 1;
        
        $user_id = $request->session()->get('FRONT_USER_ID');
        
        $data = array (
            'merchantId' => 'M1AWS0DPICNV', //<PRODUCTION MID>
            //'merchantId' => 'MERCHANTUAT', //<TESTING MID>
            'merchantTransactionId' => uniqid(),
            'merchantUserId' => 'MUID123',
              'amount' => $amount*100,
            //'amount' => 1*100,
            // 'amount' => $amount,
            "currency"=> "INR",
            // 'firstName' => 'John',
            // 'lastName' => 'Doe',
            // 'companyName' => 'ABC Company',
            // 'address' => '123 Main Street',
            // 'city' => 'City',
            // 'pincode' => '12345',
            // 'country' => 'Country',
            // 'email' => 'john@example.com',
            // 'phone' => '1234567890',

            // 'param1' => 'John',
            // 'param2' => 'Doe',
            // 'param3' => 'ABC Company',
            // 'param4' => '123 Main Street',
            // 'param5' => 'City',
            // 'param6' => '12345',
            // 'param7' => 'Country',
            // 'param8' => 'john@example.com',
            // 'param9' => '1234567890',

            'redirectUrl' => route('response'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('response'),
            // 'mobileNumber' => '9999999999',
            'mobileNumber' => $formData['phone'],
            'paymentInstrument' =>
            array (
            'type' => 'PAY_PAGE',
            ),
        );
        
        $encode = base64_encode(json_encode($data));

        $saltKey = '2519dafc-af00-4f73-b5e3-22f56e18283b'; //<PRODUCTION Salt Keys>
        //$saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399'; //<TESTING Salt Keys>
        $saltIndex = 1;

        $string = $encode.'/pg/v1/pay'.$saltKey;
        $sha256 = hash('sha256',$string);

        $finalXHeader = $sha256.'###'.$saltIndex;

        $url = "https://api.phonepe.com/apis/hermes/pg/v1/pay"; //<PRODUCTION URL>
        //$url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay"; // <TESTING URL>

        $response = Curl::to($url)
                ->withHeader('Content-Type:application/json')
                
                //
                ->withHeader("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->withHeader("Access-Control-Allow-Methods", config('cors.allowed_methods'))
                //
                
                ->withHeader('X-VERIFY:'.$finalXHeader)
                ->withData(json_encode(['request' => $encode]))
                ->post();
                
        $rData = json_decode($response);
        
        // echo "Test211";
        // echo "<br/>";
        
        // echo $rData->data->merchantTransactionId;
        // echo "<br/>";
        
        // dd($rData);
        // die();

        $merchantTransactionId = $rData->data->merchantTransactionId; // we can say this also payment_id
        
        // Insert data into the database with a "pending" status
        
        $order = new Order();
        $order->user_id = $user_id;
        $order->order_status = 'inactive';
        $order->total_amount = $formData['total'];
        $order->payment_type = 'PAY_PAGE'; // Modify this based on your payment mode
        $order->merchantTransactionId = $merchantTransactionId; 
        $order->payment_status = 'pending'; // Set as pending initially
        $order->coupon = 0; // Initialize with default values, adjust as needed
        $order->agent_code = 0; // Initialize with default values, adjust as needed
        $order->agent_commission = 0; // Initialize with default values, adjust as needed
        $order->save();

        // Insert order metadata
        $ordermeta = new OrderMeta();
        $ordermeta->order_id = $order->id;
        $ordermeta->billing_first_name = $formData['first_name'];
        $ordermeta->billing_last_name = $formData['last_name'];
        $ordermeta->billing_company_name = $formData['company_name'];
        $ordermeta->billing_address = $formData['message'];
        $ordermeta->billing_city = $formData['city'];
        $ordermeta->billing_country = $formData['country'];
        $ordermeta->billing_email = $formData['email'];
        $ordermeta->billing_phone = $formData['phone'];
        
        $ordermeta->shipping_first_name = $formData['first_name'];
        $ordermeta->shipping_last_name = $formData['last_name'];
        $ordermeta->shipping_company_name = $formData['company_name'];
        $ordermeta->shipping_address = $formData['message'];
        $ordermeta->shipping_city = $formData['city'];
        $ordermeta->shipping_country = $formData['country'];
        $ordermeta->shipping_email = $formData['email'];
        $ordermeta->shipping_phone = $formData['phone'];
      
        $ordermeta->save();
        //
        $emailData  = $formData['email'];
         $nameData  = $formData['first_name'];
        Session::put('client_name',$nameData);
        Session::put('email',$emailData);
        
        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
        
    }
    public function response(Request $request)
    {
        $input = $request->all();
        //dd($input); 
            
        //die();  
        
        $saltKey = '2519dafc-af00-4f73-b5e3-22f56e18283b'; //<PRODUCTION Salt Keys>
        //$saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399'; //<TESTING Salt Keys>
        $saltIndex = 1;

        $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;

        $url = 'https://api.phonepe.com/apis/hermes/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId']; //<PRODUCTION URL>

        //$url = 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/' . $input['merchantId'] . '/' . $input['transactionId']; // <TESTING URL>
        $response = Curl::to($url)
                ->withHeader('Content-Type:application/json')
                ->withHeader('accept:application/json')
                
                //
                ->withHeader("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->withHeader("Access-Control-Allow-Methods", config('cors.allowed_methods'))
                //
                
                
                ->withHeader('X-VERIFY:'.$finalXHeader)
                // ->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
                ->withHeader('X-MERCHANT-ID:'.$input['merchantId'])
                ->get();

        // if ($response === false) {
        //     // Handle cURL or request error
        //     $error = Curl::error($ch);
        //     // Log or return the error
        //     return response()->json(['error' => $error], 500);
        // }
        
        $response_hwe = json_decode($response);
        
        // echo "<pre>";
        // print_r($response_hwe);
        // echo "</pre>";
       // die;
        // echo "<br/>";
        // echo "success=".  $response_hwe->success;
        // echo "<br/>"; 
        // echo "code=".  $response_hwe->code;
        // echo "<br/>"; 
        // echo "message=".  $response_hwe->message;
        //  echo "<br/>"; 
        // echo "amount=". $response_hwe->data->amount;
        //  echo "<br/>"; 
        // echo "merchantTransactionId=". $response_hwe->data->merchantTransactionId;
        // echo "<br/>"; 
        // echo "transactionId=". $response_hwe->data->transactionId;
        // echo "<br/>";
        // echo "format amount=" . number_format($response_hwe->data->amount / 100, 2);
        // echo "<br/>"; 
        // echo "state="  .$response_hwe->data->state;
        // echo "<br/>";
        // echo "responseCode="  .$response_hwe->data->responseCode;
        // echo "<br/>";
        // echo "paymentInstrument=". $response_hwe->data->paymentInstrument->type;
        // die;
        
        $code = $response_hwe->code;
        $amount = $response_hwe->data->amount;
        $state = $response_hwe->data->state;
        $merchantTransactionId = $response_hwe->data->merchantTransactionId;
        $transactionId = $response_hwe->data->transactionId;
        $responseCode = $response_hwe->data->responseCode;
        $payment_type = $response_hwe->data->paymentInstrument->type;
        
       
        $emailData = array(
            'mid'=>$merchantTransactionId,
            'tid'=>$transactionId,
            'amount'=>$amount,
            'client_name'=> Session::get('client_name'),
            
            //'ptype'=>$payment_type,
            
            );
    
     if ($code === 'PAYMENT_SUCCESS' && $state === 'COMPLETED' && $responseCode === 'SUCCESS')  
     {
        // Payment is successful, insert data into cart and order_product

        // Retrieve cart items 
        //$user_id = $input['data']['merchantId']; // Use the appropriate key based on your response structure
        
        // $user_id = $request->session()->get('FRONT_USER_ID');
        //$user_id = 23;
        
        

        // Create a new order record
        // $order = new Order();
        // $order->user_id = $user_id;
        // $order->order_status = 'active'; // Adjust as needed
        // $order->total_amount = $amount; // Use the appropriate key based on your response structure
        // $order->payment_type = $payment_type; // Use the appropriate key based on your response structure
        // $order->payment_status = 'SUCCESS'; // Set payment status as successful
        // $order->coupon = 0; // Initialize with default values, adjust as needed
        // $order->agent_code = 0; // Initialize with default values, adjust as needed
        // $order->agent_commission = 0; // Initialize with default values, adjust as needed
        // $order->save();
        
        $order = Order::where('merchantTransactionId',$merchantTransactionId)->first();
         
        $order->order_status = 'active'; // Adjust as needed
        $order->payment_type = $payment_type; // Use the appropriate key based on your response structure
        $order->transactionId = $transactionId; // Use the appropriate key based on your response structure
        $order->payment_status = 'SUCCESS'; // Set payment status as successful
        $order->save();
        
        /* user mail start */
                
                $email =  Session::get('email');
                Mail::to($email)->Send(new Ieltmail($emailData));
            /* user mail end */
        //if(!isset($_SESSION['FRONT_USER_ID'])){
        

        if (!session()->has('FRONT_USER_ID')) 
        {
            $order = Order::where('merchantTransactionId', $merchantTransactionId)->first();
            if ($order)
            {
                $user_id = $order->user_id;
                // put the session id in the FRONT_USER_ID
                Session::put('FRONT_USER_ID', $user_id);
            }
            
            $carts = Cart::where('user_id', $user_id)->get();
            
            foreach ($carts as $cart) {
                $product = \App\Models\product::find($cart->product_id);
     
                // Insert order products
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id; // Set the order_id
                $orderProduct->product_id = $cart->product_id;
                $orderProduct->quantity = $cart->quantity;
                $orderProduct->price = $product->pro_price;
                $orderProduct->name = $cart->name;
                $orderProduct->mobile = $cart->mobile;
                $orderProduct->email = $cart->email;
                $orderProduct->designation = $cart->designation;
                $orderProduct->logo_status = $cart->logo_status;
                $orderProduct->image = $cart->image;
                $orderProduct->agent_code = session()->get('isAgentcodeData')->agent_code;
                $orderProduct->commission = session()->get('agentcodedata');
                
                $orderProduct->save();
    
                // Delete cart item
                $cart->delete();
            }
    
            // Clear session data
            session()->forget('coupondata');
            session()->forget('isCouponData');
            session()->forget('agentcodedata');
            session()->forget('isAgentcodeData');
             
            return view('frontend.thankyou');
             
        }
        //
    }
    else 
    {
        echo "Payment faild please try again";
        // Payment failed or not successful, you can decide whether to keep the order record or delete it.
    }
        
        //dd(json_decode($response));
    }    
    
    
    /* anand end code for phone pay payment gatway */ 
    
    
    public function confirmorder(Request $request){
   // return $request;
        if ($request->isMethod('post')) {
                $validator = \Validator::make($request->all(), [
                    'first_name' => 'required|string|max:100',
                    'last_name'  => 'required|string|max:100',
                    'company_name' => 'required|string|max:100',
                    'message' => 'required',
                    'city' => 'required',
                    'country' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                ]);
                
                if ($validator->fails())
                {
                    return response()->json(['errors'=>$validator->errors(),"status"=>false,'validation'=>false]);
                }
                
            
                if($request->ispayment == false){
                    return response()->json(["status"=>true,'validation'=>true], 200);
                }
        }

       
        if ($request->isMethod('get') && !empty($request->payment_id)) {
        
         $user_id = $request->session()->get('FRONT_USER_ID');
        $carts = Cart::where('user_id', $user_id)->get();
        
        if(count($carts) == 0) {
          return view('frontend.checkout');
        }
        }

        $total = $request->total; 
        $order = new Order(); 
       // $order->order_id = '#'.$order->id;
        $order->user_id = $user_id; 
        $order->order_status = 'inactive'; 
        $order->total_amount = $total;
        $order->payment_type = $request->payment_methode;
        $order->payment_status = 'success'; 
        $order->coupon=session()->get('isCouponData')!=null?session()->get('isCouponData')->id:0;
        
        $order->agent_code=session()->get('isAgentcodeData')!=null?session()->get('isAgentcodeData')->id:0;

        $order->agent_commission=session::get('agentcodedata');

        $order->save(); 
        $ordermeta = new OrderMeta(); 
        $ordermeta->order_id = $order->id;
        $ordermeta->billing_first_name = isset($request->first_name)?$request->first_name:'';
        $ordermeta->billing_last_name = isset($request->last_name)?$request->last_name:'';
        $ordermeta->billing_company_name = isset($request->company_name)?$request->company_name:'';
        $ordermeta->billing_address	 = isset($request->message)?$request->message:'';
        $ordermeta->billing_city= isset($request->city)?$request->city:'';
        $ordermeta->billing_country= isset($request->country)?$request->country:'';
        $ordermeta->billing_email= isset($request->email)?$request->email:'';
        $ordermeta->billing_phone= isset($request->phone)?$request->phone:'';
        $ordermeta->shipping_first_name = isset($request->first_name)?$request->first_name:'';
        $ordermeta->shipping_last_name = isset($request->last_name)?$request->last_name:'';
        $ordermeta->shipping_company_name = isset($request->company_name)?$request->company_name:'';
        $ordermeta->shipping_address = isset($request->message)?$request->message:'';
        $ordermeta->shipping_city = isset($request->city)?$request->city:'';
        $ordermeta->shipping_country =isset($request->country)?$request->country:'';
        $ordermeta->shipping_email = isset($request->email)?$request->email:'';
        $ordermeta->shipping_phone =isset($request->phone)?$request->phone:'';
        $ordermeta->save();
        foreach ($carts as $k => $cart) {
            $product = product::where('id', $cart->product_id)->first(); 
            $order_products = OrderProduct::create([
                'order_id' => $order->id, 
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $product->pro_price,
                'name'  => $cart->name,
                'mobile'=> $cart->mobile,
                'agent_code' => session()->get('isAgentcodeData')->agent_code,
                'email'=> $cart->email,
                'designation'=> $cart->designation,
                'commission' =>  session()->get('agentcodedata'),
                'logo_status'=> $cart->logo_status,
                'image'=> $cart->image,
                
            ]);

            if($order_products) {
                Cart::where('id', $cart->id)->delete();
            }
        }

        $request->session()->forget('coupondata');  
        $request->session()->forget('isCouponData');  
        
        $request->session()->forget('agentcodedata');  
        $request->session()->forget('isAgentcodeData');  
        
        return redirect('new-cart')->with('message','Your product ordered successfully!');
    }
    
    
  
    
    
    public function confirmorderr(Request $request){
        $user_id = $request->session()->get('FRONT_USER_ID');
        $carts = Cart::where('user_id', $user_id)->get();
        
        if(count($carts) == 0) {
           return view('frontend.checkout');
        }
        
        
 $total = $request->total; 
        $order = new Order; 
        //$order->order_id = '#'.$order->id;
        $order->user_id = $user_id; 
        $order->order_status = 'inactive'; 
        $order->total_amount = $total;
        $order->payment_type = $request->payment_methode;
        $order->payment_status = 'success'; 
        $order->save();

        foreach ($carts as $k => $cart) {
            $product = product::where('id', $cart->product_id)->first(); 
            $order_products = OrderProduct::create([
                'order_id' => $order->id, 
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $product->pro_price,
                'name'  => $cart->name,
                'mobile'=> $cart->mobile,
                'email'=> $cart->email,
                'pincode'=>$cart->pincode,
                'designation'=> $cart->designation,
                'logo_status'=> $cart->logo_status,
                'image'=> $cart->image,
                
            ]);

            if($order_products) {
                Cart::where('id', $cart->id)->delete();
            }
        }
        
        
        
       $ordermeta = new OrderMeta(); 
        $ordermeta->order_id = $order->id;
        $ordermeta->billing_first_name = isset($request->name)?$request->name:'';
      
        $ordermeta->shipping_address = isset($request->address1)?$request->address1:'';
        $ordermeta->shipping_city = isset($request->city)?$request->city:'';
        $ordermeta->shipping_country =isset($request->country)?$request->country:'';
        $ordermeta->shipping_email = isset($request->email)?$request->email:'';
        $ordermeta->shipping_phone =isset($request->phone)?$request->phone:'';
        $ordermeta->save();
        $request->session()->forget('coupondata');  
        $request->session()->forget('isCouponData');  
        
        $request->session()->forget('agentcodedata');  
        $request->session()->forget('isAgentcodeData');  
        
        return redirect('new-cart')->with('message','Your product ordered successfully!');
    }
    
 
    
    public function profileindex(Request $request){
      
        $user_id = $request->session()->get('FRONT_USER_ID');
        
        if(!empty($user_id)){
            
            $type = Customer::where('id',$user_id)->first();
            
            $d['qualifications'] =   Qualification::where('user_id',$user_id)->orderby('id','DESC')->get();
            
            $d['professions'] =      Profession::where('user_id',$user_id)->orderby('id','DESC')->get();
            foreach ($d['professions'] as $profession) {
                if (empty($profession->iframe)) {
                    // Check if map exists for this user
                    $map = DB::table('map')->where('uid', $user_id)->first();
                    if ($map) {
                        $profession->iframe = $map->map;
                    }
                }
            }
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
        
            // echo "<pre>";
            // print_r($d);
            // echo "</pre>";
            
            // Check for profession theme first
            if($type->profession_type && $type->profession_type > 0){
                $theme = \App\Models\ProfessionTheme::find($type->profession_type);
                if($theme && view()->exists($theme->view_path)){
                    // Add theme data to view
                    $d['theme'] = $theme;
                    // Add menu/restaurant data for restaurant theme
                    if($type->profession_type == 13){
                        $d['menuCategories'] = \App\Models\MenuCategory::where('customer_id', $user_id)
                            ->where('is_active', 1)
                            ->ordered()
                            ->with(['items' => function($q) {
                                $q->where('is_available', 1)->ordered();
                            }])
                            ->get();
                        $d['restaurantInfo'] = \App\Models\RestaurantInfo::where('customer_id', $user_id)->first();
                    }
                    return view($theme->view_path, $d);
                }
            }

            // Fallback to panel_status based views
            if($type->panel_status == 1){
                return view('golden/index',$d);
            }else{
                return view('frontend.profile-new.index',$d);
            }


        }else{
             return redirect('Login');
        }
    }

    public function profilenumberindex(Request $request,$number){
        $user = customer::where('mobile',$number)->first();
        session()->put('FRONT_USER_ID',$user->id);
        
        //dd($user);
        
        if(!empty($user)){
            $user_id = $user->id;
            $type = Customer::where('id',$user_id)->first();
            $d['qualifications'] =   Qualification::where('user_id',$user_id)->get();
            //dd($d['qualifications']);
            $d['professions'] =      Profession::where('user_id',$user_id)->get();
            foreach ($d['professions'] as $profession) {
                if (empty($profession->iframe)) {
                    // Check if map exists for this user
                    $map = DB::table('map')->where('uid', $user_id)->first();
                    if ($map) {
                        $profession->iframe = $map->map;
                    }
                }
            }

            $d['thoughts'] =         Thought::where('user_id',$user_id)->get();
            $d['portfolios'] =       Portfolio::where('user_id',$user_id)->get();
            
            $d['userdata'] =         customer::where('id',$user_id)->first();
            $d['social'] =          Social::where('user_id',$user_id)->first();
            
            /* anand start code */
             $d['videos'] =          Video::where('user_id',$user_id)->get();
            $d['clients'] =         
DB::table('clients')->where('uid',$user_id)->get();
            $d['myfiles'] =     Customer::where('id',$user_id)->first()->document??NULL;
            
            // $d['professional_photos'] =      Professional_photo::where('user_id',$user_id)->first();
            $d['professional_photos'] =      Professional_photo::where('user_id',$user_id)->take(3)->get();
            $d['myproducts'] =               Myproduct::where('user_id',$user_id)->get();
            /* anand end code */

            $user1=customer::where('mobile',$number)->first()->increment('leadcount',1);

            // Check for profession theme first
            if($type->profession_type && $type->profession_type > 0){
                $theme = \App\Models\ProfessionTheme::find($type->profession_type);
                if($theme && view()->exists($theme->view_path)){
                    // Add theme data to view
                    $d['theme'] = $theme;
                    // Add menu/restaurant data for restaurant theme
                    if($type->profession_type == 13){
                        $d['menuCategories'] = \App\Models\MenuCategory::where('customer_id', $user_id)
                            ->where('is_active', 1)
                            ->ordered()
                            ->with(['items' => function($q) {
                                $q->where('is_available', 1)->ordered();
                            }])
                            ->get();
                        $d['restaurantInfo'] = \App\Models\RestaurantInfo::where('customer_id', $user_id)->first();
                    }
                    return view($theme->view_path, $d);
                }
            }

            // Fallback to panel_status based views
            if($type->panel_status == 1){
                return view('golden/index',$d);
            }else{
                return view('frontend.profile-new.index',$d);
            }
        }else{
             return redirect('/notexist');
        }
    }

    public function loadMorePortfolios(Request $request)
    {
        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $activeCategory = $request->category;
    
        $user_id = $request->input('user_id');

        if($activeCategory=="category_mockups"){
            $portfolios = Professional_photo::where('user_id',$user_id)->skip($offset)->take($limit)->get();
        }
        else{
            $portfolios = Portfolio::where('user_id', $user_id)->skip($offset)->take($limit)->get();
        }

        foreach ($portfolios as $portfolio) {
            $imageUrls = [];
            $images = json_decode($portfolio->image, true); // Decode images JSON

            if (is_array($images)) {
                foreach ($images as $image) {
                    $folder = ($activeCategory == "category_mockups") ? "professional_photos" : "portfolio";
                    $imageUrls[] = url('public/frontend/' . $folder . '/' . $image);
                }
            }

            $portfolio->image_urls = $imageUrls;
        }

       return response()->json($portfolios);
    }

    public function notexist(){
         return view('frontend.notexist');
    }

    /**
     * Track profile tap location (NFC/QR)
     */
    public function trackProfileLocation(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'profile_slug' => 'required|string',
            'tap_source' => 'nullable|string',
            'location_status' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'accuracy_m' => 'nullable|numeric',
        ]);

        $customer = customer::where('id', $request->customer_id)
            ->where('slug', $request->profile_slug)
            ->first();

        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Profile not found'], 404);
        }

        $allowedSources = ['nfc', 'qr', 'link'];
        $tapSource = in_array($request->tap_source, $allowedSources, true) ? $request->tap_source : 'unknown';

        $allowedStatus = ['granted', 'denied', 'unavailable', 'unsupported', 'unknown'];
        $locationStatus = in_array($request->location_status, $allowedStatus, true) ? $request->location_status : 'unknown';

        ProfileLocationTrack::create([
            'customer_id' => $customer->id,
            'profile_slug' => $customer->slug,
            'theme_id' => $customer->profession_type,
            'tap_source' => $tapSource,
            'location_status' => $locationStatus,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'accuracy_m' => $request->accuracy_m,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
            'referrer' => $request->headers->get('referer'),
        ]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Track profile engagement actions (views/shares/contacts).
     */
    public function trackProfileEngagement(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer',
            'action' => 'required|string',
            'source' => 'nullable|string',
        ]);

        $customer = customer::find($request->customer_id);
        if (!$customer) {
            return response()->json(['status' => 'error', 'message' => 'Profile not found'], 404);
        }

        $allowedActions = ['view', 'share', 'contact_save'];
        if (!in_array($request->action, $allowedActions, true)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid action'], 422);
        }

        $source = $request->source ? substr($request->source, 0, 50) : null;

        ProfileEngagement::create([
            'customer_id' => $customer->id,
            'action' => $request->action,
            'source' => $source,
        ]);

        return response()->json(['status' => 'ok']);
    }

    /**
     * Display user profile by slug
     */
    public function profileBySlug(Request $request, $slug){
        $user = customer::where('slug', $slug)->first();

        if(!empty($user)){
            [$viewPath, $data] = $this->buildProfileViewPayload($user, true);
            return view($viewPath, $data);
        }else{
             return redirect('/notexist');
        }
    }

    public function profilePdf(Request $request, $slug)
    {
        $user = customer::where('slug', $slug)->first();

        if (!$user) {
            return redirect('/notexist');
        }

        [$viewPath, $data] = $this->buildProfileViewPayload($user, false);
        $data['isPdf'] = true;

        $html = view($viewPath, $data)->render();
        $chromePath = $this->resolveChromePath();
        if ($chromePath) {
            $tempPdf = tempnam(sys_get_temp_dir(), 'fastap-profile-') . '.pdf';
            $tempHtml = tempnam(sys_get_temp_dir(), 'fastap-profile-') . '.html';
            $htmlForFile = $this->convertProfileHtmlToFileUrls($html, $request);
            file_put_contents($tempHtml, $htmlForFile);

            $process = new Process([
                $chromePath,
                '--headless',
                '--disable-gpu',
                '--no-sandbox',
                '--disable-dev-shm-usage',
                '--allow-file-access-from-files',
                '--print-to-pdf-no-header',
                '--print-to-pdf=' . $tempPdf,
                'file:///' . str_replace('\\', '/', $tempHtml),
            ]);
            $process->setTimeout(90);
            $process->run();

            @unlink($tempHtml);

            if ($process->isSuccessful() && file_exists($tempPdf)) {
                $filename = ($user->slug ?: 'profile') . '-profile.pdf';
                return response()->download($tempPdf, $filename)->deleteFileAfterSend(true);
            }
        }

        $pdf = Pdf::loadHTML($html);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'defaultFont' => 'DejaVu Sans',
        ]);

        $filename = ($user->slug ?: 'profile') . '-profile.pdf';
        return $pdf->download($filename);
    }

    public function profilePdfRequest(Request $request, $slug)
    {
        $user = customer::where('slug', $slug)->first();
        if (!$user) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $profileUrl = url($user->slug);
        $job = ProfilePdfJob::create([
            'customer_id' => $user->id,
            'slug' => $user->slug,
            'profile_url' => $profileUrl,
            'status' => 'queued',
        ]);

        dispatch((new GenerateProfilePdf($job->id))->onConnection('database'));

        return response()->json([
            'status' => 'queued',
            'job_id' => $job->id,
        ]);
    }

    public function profilePdfStatus($id)
    {
        $job = ProfilePdfJob::find($id);
        if (!$job) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $downloadUrl = null;
        if ($job->status === 'ready' && $job->file_path) {
            $downloadUrl = route('profile.pdf.download', $job->id);
        }

        return response()->json([
            'status' => $job->status,
            'download_url' => $downloadUrl,
            'error' => $job->error_message,
        ]);
    }

    public function profilePdfDownload($id)
    {
        $job = ProfilePdfJob::find($id);
        if (!$job || $job->status !== 'ready' || !$job->file_path) {
            return redirect()->back();
        }

        if (!Storage::disk('public')->exists($job->file_path)) {
            return redirect()->back();
        }

        $filename = ($job->slug ?: 'profile') . '-profile.pdf';
        return Storage::disk('public')->download($job->file_path, $filename);
    }

    private function resolveChromePath(): ?string
    {
        $envPath = env('PDF_CHROME_PATH');
        if ($envPath && file_exists($envPath)) {
            return $envPath;
        }

        $candidates = [
            'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files\\Microsoft\\Edge\\Application\\msedge.exe',
            'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
        ];

        foreach ($candidates as $candidate) {
            if (file_exists($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    private function convertProfileHtmlToFileUrls(string $html, Request $request): string
    {
        $docRoot = str_replace('\\', '/', base_path());
        $fileBase = 'file:///' . ltrim($docRoot, '/');
        $hosts = array_filter([
            rtrim(config('app.url') ?? '', '/'),
            rtrim($request->getSchemeAndHttpHost() ?? '', '/'),
        ]);

        $html = preg_replace_callback('/\b(src|href)=\"([^\"]+)\"/i', function ($matches) use ($fileBase, $hosts) {
            $attr = $matches[1];
            $url = $matches[2];

            if (preg_match('/^https?:\\/\\//i', $url)) {
                foreach ($hosts as $host) {
                    if ($host !== '' && str_starts_with($url, $host)) {
                        $path = parse_url($url, PHP_URL_PATH) ?? '';
                        $path = ltrim($path, '/');
                        return $attr . '="' . $fileBase . '/' . $path . '"';
                    }
                }
                return $matches[0];
            }

            if (str_starts_with($url, '/')) {
                return $attr . '="' . $fileBase . $url . '"';
            }

            if (str_starts_with($url, 'public/') || str_starts_with($url, 'frontend/')) {
                return $attr . '="' . $fileBase . '/' . $url . '"';
            }

            return $matches[0];
        }, $html) ?? $html;

        $html = preg_replace_callback('/url\\(([^)]+)\\)/i', function ($matches) use ($fileBase, $hosts) {
            $raw = trim($matches[1], " \t\n\r\0\x0B'\"");
            if (preg_match('/^https?:\\/\\//i', $raw)) {
                foreach ($hosts as $host) {
                    if ($host !== '' && str_starts_with($raw, $host)) {
                        $path = parse_url($raw, PHP_URL_PATH) ?? '';
                        $path = ltrim($path, '/');
                        return 'url(' . $fileBase . '/' . $path . ')';
                    }
                }
                return $matches[0];
            }

            if (str_starts_with($raw, '/')) {
                return 'url(' . $fileBase . $raw . ')';
            }

            if (str_starts_with($raw, 'public/') || str_starts_with($raw, 'frontend/')) {
                return 'url(' . $fileBase . '/' . $raw . ')';
            }

            return $matches[0];
        }, $html) ?? $html;

        return $html;
    }

    private function buildProfileViewPayload(customer $user, bool $incrementLead)
    {
        $user_id = $user->id;
        $type = Customer::where('id',$user_id)->first();
        $d['qualifications'] =   Qualification::where('user_id',$user_id)->get();
        $d['professions'] =      Profession::where('user_id',$user_id)->get();

        foreach ($d['professions'] as $profession) {
            if (empty($profession->iframe)) {
                // Check if map exists for this user
                $map = DB::table('map')->where('uid', $user_id)->first();
                if ($map) {
                    $profession->iframe = $map->map;
                }
            }
        }

        $d['thoughts'] =         Thought::where('user_id',$user_id)->get();
        $d['portfolios'] =       Portfolio::where('user_id',$user_id)->get();

        $d['userdata'] =         customer::where('id',$user_id)->first();
        $d['social'] =          Social::where('user_id',$user_id)->first();
        if (!$d['social']) {
            $d['social'] = new Social();
            $d['social']->user_id = $user_id;
        }
        if (empty($d['social']->whatsapp) && !empty($d['userdata']->whatsapp)) {
            $d['social']->whatsapp = $d['userdata']->whatsapp;
        }

        $d['videos'] =          Video::where('user_id',$user_id)->get();
        $d['clients'] = DB::table('clients')->where('uid',$user_id)->get();
        $d['myfiles'] =     Customer::where('id',$user_id)->first()->document??NULL;

        $d['professional_photos'] =      Professional_photo::where('user_id',$user_id)->take(3)->get();
        $d['myproducts'] =               Myproduct::where('user_id',$user_id)->get();

        if ($incrementLead) {
            $user->increment('leadcount', 1);
        }

        // Check for profession theme first
        if($type->profession_type && $type->profession_type > 0){
            $theme = \App\Models\ProfessionTheme::find($type->profession_type);
            if($theme && view()->exists($theme->view_path)){
                // Add theme data to view
                $d['theme'] = $theme;
                // Add menu/restaurant data for restaurant theme
                if($type->profession_type == 13){
                    $menuQuery = \App\Models\MenuCategory::where('customer_id', $user_id);
                    if (\Illuminate\Support\Facades\Schema::hasColumn('menu_categories', 'is_active')) {
                        $menuQuery->where('is_active', 1);
                    } elseif (\Illuminate\Support\Facades\Schema::hasColumn('menu_categories', 'status')) {
                        $menuQuery->where('status', 1);
                    }
                    $menuQuery->ordered()
                        ->with(['items' => function($q) {
                            if (\Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'is_available')) {
                                $q->where('is_available', 1);
                            } elseif (\Illuminate\Support\Facades\Schema::hasColumn('menu_items', 'status')) {
                                $q->where('status', 1);
                            }
                            $q->ordered();
                        }]);
                    $d['menuCategories'] = $menuQuery->get();
                    $d['restaurantInfo'] = \App\Models\RestaurantInfo::where('customer_id', $user_id)->first();
                }
                if ($type->profession_type == 8) {
                    $d['productionServices'] = ProductionService::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('service_name')
                        ->get();
                    $d['productionPortfolios'] = ProductionPortfolio::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['productionTeam'] = ProductionTeam::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('display_order')
                        ->get();
                }
                if ($type->profession_type == 10) {
                    $d['jewelleryProducts'] = JewelleryProduct::where('customer_id', $user_id)
                        ->where('is_available', 1)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['metalRates'] = MetalRate::where('customer_id', $user_id)
                        ->orderByDesc('rate_date')
                        ->get();
                }
                if ($type->profession_type == 11) {
                    $d['techServices'] = TechService::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('service_name')
                        ->get();
                    $d['techCaseStudies'] = TechCaseStudy::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                }
                if ($type->profession_type == 14) {
                    $d['tourPackages'] = TourPackage::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderByDesc('is_featured')
                        ->orderBy('package_name')
                        ->get();
                }
                if ($type->profession_type == 15) {
                    $d['fitnessPrograms'] = FitnessProgram::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('program_name')
                        ->get();
                    $d['fitnessTrainers'] = FitnessTrainer::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('trainer_name')
                        ->get();
                    $d['fitnessMemberships'] = FitnessMembership::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('price')
                        ->get();
                    $d['fitnessClasses'] = FitnessClass::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('schedule_day')
                        ->orderBy('start_time')
                        ->get();
                    $d['fitnessTransformations'] = TransformationGallery::where('customer_id', $user_id)
                        ->orderByDesc('is_featured')
                        ->orderByDesc('created_at')
                        ->get();
                    $d['dietPlans'] = DietPlan::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('plan_name')
                        ->get();
                }
                if ($type->profession_type == 16) {
                    $d['educationCourses'] = EducationCourse::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('course_name')
                        ->get();
                    $d['educationFaculty'] = EducationFaculty::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('faculty_name')
                        ->get();
                    $d['educationResults'] = EducationResult::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                }
                if ($type->profession_type == 17) {
                    $d['legalServices'] = LegalService::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('practice_area')
                        ->get();
                }
                if ($type->profession_type == 18) {
                    $d['caServices'] = CaService::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('service_name')
                        ->get();
                    $d['caCases'] = CaClientCase::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['caConsultations'] = CaConsultation::where('customer_id', $user_id)
                        ->orderByDesc('appointment_date')
                        ->orderByDesc('created_at')
                        ->get();
                    $d['caDeadlines'] = ComplianceDeadline::where('customer_id', $user_id)
                        ->orderBy('due_date')
                        ->get();
                }
                if ($type->profession_type == 19) {
                    $d['salonServices'] = SalonService::where('customer_id', $user_id)
                        ->where('is_available', 1)
                        ->orderBy('service_name')
                        ->get();
                    $d['salonArtists'] = SalonArtist::where('customer_id', $user_id)
                        ->where('is_available', 1)
                        ->orderBy('artist_name')
                        ->get();
                    $d['salonPackages'] = SalonPackage::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['salonPortfolio'] = SalonPortfolio::where('customer_id', $user_id)
                        ->orderByDesc('is_featured')
                        ->orderByDesc('created_at')
                        ->get();
                    $d['salonProducts'] = SalonProduct::where('customer_id', $user_id)
                        ->where('is_available', 1)
                        ->orderBy('product_name')
                        ->get();
                }
                if ($type->profession_type == 24) {
                    $d['politicalProfile'] = PoliticalProfile::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderByDesc('created_at')
                        ->first();
                    $d['publicServices'] = PublicService::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('display_order')
                        ->orderBy('service_name')
                        ->get();
                    $d['developmentProjects'] = DevelopmentProject::where('customer_id', $user_id)
                        ->orderByDesc('is_featured')
                        ->orderByDesc('created_at')
                        ->get();
                    $d['publicEvents'] = PublicEvent::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderByDesc('event_date')
                        ->get();
                }
                if ($type->profession_type == 20) {
                    $d['interiorServices'] = InteriorService::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('service_name')
                        ->get();
                    $d['interiorProjects'] = InteriorProject::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['interiorPortfolio'] = InteriorPortfolio::where('customer_id', $user_id)
                        ->orderByDesc('is_featured')
                        ->orderByDesc('created_at')
                        ->get();
                }
                if ($type->profession_type == 23) {
                    $d['astroServices'] = AstroService::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('service_name')
                        ->get();
                    $d['astroConsultations'] = AstroConsultation::where('customer_id', $user_id)
                        ->orderByDesc('appointment_date')
                        ->orderByDesc('created_at')
                        ->get();
                    $d['astroReports'] = AstroClientData::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                }
                if ($type->profession_type == 22) {
                    $d['securityProducts'] = SecurityProduct::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('product_name')
                        ->get();
                    $d['securitySurveys'] = SecuritySiteSurvey::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['securityProjects'] = SecurityProject::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['securityAmc'] = SecurityAmc::where('customer_id', $user_id)
                        ->orderByDesc('amc_end_date')
                        ->orderByDesc('created_at')
                        ->get();
                }
                if ($type->profession_type == 21) {
                    $d['solarSolutions'] = SolarSolution::where('customer_id', $user_id)
                        ->where('is_active', 1)
                        ->orderBy('solution_name')
                        ->get();
                    $d['solarProjects'] = SolarProject::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['solarMonitoring'] = SolarMonitoring::where('customer_id', $user_id)
                        ->orderByDesc('last_updated')
                        ->orderByDesc('created_at')
                        ->get();
                    $d['solarAmc'] = SolarAmc::where('customer_id', $user_id)
                        ->orderByDesc('amc_end_date')
                        ->orderByDesc('created_at')
                        ->get();
                    $d['solarSubsidies'] = SubsidyApplication::where('customer_id', $user_id)
                        ->orderByDesc('application_date')
                        ->orderByDesc('created_at')
                        ->get();
                }
                if ($type->profession_type == 25) {
                    $d['creatorStats'] = CreatorStat::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['brandCollaborations'] = BrandCollaboration::where('customer_id', $user_id)
                        ->orderByDesc('created_at')
                        ->get();
                    $d['creatorPortfolio'] = CreatorPortfolio::where('customer_id', $user_id)
                        ->orderByDesc('is_featured')
                        ->orderByDesc('created_at')
                        ->get();
                }
                return [$theme->view_path, $d];
            }
        }

        // Fallback to panel_status based views
        if($type->panel_status == 1){
            return ['golden/index', $d];
        }

        return ['frontend.profile-new.index', $d];
    }

    public function profilenumberindex1(Request $request,$number){
        $user = customer::where('mobile',$number)->first();
        if(!empty($user)){
            $user_id = $user->id;
            $d['qualifications'] =   Qualification::where('user_id',$user_id)->get();
            $d['professions'] =      Profession::where('user_id',$user_id)->get();
            $d['thoughts'] =         Thought::where('user_id',$user_id)->get();
            $d['portfolios'] =       Portfolio::where('user_id',$user_id)->get();
            $d['userdata'] =         customer::where('id',$user_id)->first();
            $d['social'] =          Social::where('user_id',$user_id)->first();
            
            /* anand start code */
             $d['videos'] =          Video::where('user_id',$user_id)->get();
           
             $d['myfiles'] =     Customer::where('id',$user_id)->first()->document??NULL;
             
            //  $d['professional_photos'] =      Professional_photo::where('user_id',$user_id)->first();
                $d['professional_photos'] =      Professional_photo::where('user_id',$user_id)->get();
                $d['myproducts'] =               Myproduct::where('user_id',$user_id)->get();
            /* anand end code */
            
            return view('frontend.profile-new.index',$d);
        }else{
             return redirect('/');
        }
    }
    
    
     public function blogpage(){
         return view('frontend.profile.blog-page');
    }
    
     public function portfoliodetails(){
         return view('frontend.profile.portfolio-details');
    }
   
    
    
    // ========pooduct-details
    
    public function product_details(Request $request ,$id){

        Session::put('url',$request->fullUrl());

        $data['product'] = product::where('status','1')->where('url',$id)->first();
        return view('frontend.product-details',$data);

        /*$user_id = $request->session()->get('FRONT_USER_ID');
        if (!empty($user_id)) {
            $data['product']= product::where('status','1')->where('id',$id)->first();
            return view('frontend.product-details',$data);
        }
		else {
            return redirect('Login'); 
        }
        */
        
    }
   
    
function contectus(request $req){

$req->validate([
'name'=>'required',
'email'=>'required',
'sub'=>'required',
'msg'=>'required',

]);


   
   
      
         


$contact = NEW contact;
$contact->name=$req->name;
$contact->email=$req->email;
$contact->sub=$req->sub;
$contact->msg=$req->msg;
$contact->updated_at;
$contact->created_at;
  
//   $details = [
//         'title' => 'Mail from ItSolutionStuff.com',
//         'body' => 'This is for testing email using smtp'
//     ];
  
//     \Mail::to($contact->email=$req->email)->send(new \App\Mail\MyTestMail($details));
    
          $contact->save();
  
  
return back()->with('message_contact','Thanks for Enquiry...');


}







function corporates(request $req){



$contact = NEW corporate;
$contact->fname=$req->fname;
$contact->email=$req->email;
$contact->lname=$req->lname;
$contact->cname=$req->cname;
$contact->city=$req->city;
$contact->state=$req->state;
$contact->country=$req->country;
$contact->description=$req->description;


$result= $contact->save();

   return back()->with('message_corporate','Thanks for Corporates Enquiry');
}


    
      public function testimonialview(){
          // Use the new redesigned landing page
          return view('frontend.index-new-test');
    }
   
  
      public function ABoutview(){
          // Use redesigned about page
          return view('frontend.about-new');
    }
    
    
    
function subscribe(request $req){
    
    $req->validate([
        
      'name'=>'required'  ,
            'email'=>'required'  ,
      'mobile'=>'required'  

        
        ]);
    
    
    $offer = new subscibe_channel;
    $offer->name=$req->name;
        $offer->email=$req->email;
    $offer->mobile=$req->mobile;

    $offer->save();
    return back()->with('alert','Thanks for Subscribe!');
    
}

function mydocument(){
    $myfiles=Customer::where('id',Session()->get('FRONT_USER_ID'))->first()->document??NULL;
    $userid=Customer::where('id',Session()->get('FRONT_USER_ID'))->first()->id;
    return view('userdashboard.uploadfile.add_upload',compact('myfiles','userid'));
}

function uploaddoc(Request $req){
   
    $req->validate([
    'profile.*' => 'required|mimes:pdf|max:20480', // 20480 KB = 20MB
], [
    'profile.*.mimes' => 'Only PDF files are allowed',
    'profile.*.max' => 'Each file must not exceed 20MB',
]);
        
        
    if(count($req->profile)>12){
       
        return redirect()->back()->with('error','Maximum 12 Document Allow');
    }      
    
    if(session()->has('FRONT_USER_LOGIN')){
        $files=[];
         // Fetch existing customer
         $customer = Customer::find(Session()->get('FRONT_USER_ID'));
        $existingFiles = json_decode($customer->document ?? '[]', true);

    // Check if new files are uploaded
    if ($req->hasFile('profile')) {
        $upfiles = $req->file('profile');
        foreach ($upfiles as $prof) {
            $name = 'doc' . time() . rand(0, 999) . '.' . $prof->extension();
            $prof->move(public_path('uploads/document'), $name);
            $files[] = 'uploads/document/' . $name;
        }
    }

    // Merge old + new files
    $allFiles = array_merge($existingFiles, $files);

    // Save back to customer
    $customer->update(['document' => json_encode($allFiles)]);

//     $upfiles=$req->file('profile');
//   foreach($upfiles as $prof){
//      $name='doc'.time().rand(0,999).'.'.$prof->extension();
//      $res=$prof->move(public_path('uploads/document'),$name);
//      $files[]='uploads/document/'.$name;
//   }
  
//   Customer::find(Session()->get('FRONT_USER_ID'))->update(['document'=>json_encode($files)]);
    
   return redirect()->back()->with('success','File Uploaded Sucessfully');
    }
    else{
        return redirect()->back()->with('session not found');
    }
}
 
 function message(Request $req){
      //dd($req->all());
    $res=Message::create([
        'Message'=>$req->text,
        'user_id'=>$req->uid,
        'mobile'=>$req->mobile,
        'name'=>$req->name
        ]);
       
        return redirect()->back()->with('success','message send successfully');
        
 }
    function leads(){
        $user=customer::where('id',session()->get('FRONT_USER_ID'))->first();
        //$messages =Message::where('user_id',$user->id)->get();
        //return $messages;
        return view('userdashboard.leads',compact('user'));
    } 
    
    
    
public function document_download($uid){
            $zip = new \ZipArchive();
        $fileName = 'zipFile.zip';
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE)== TRUE)
        {
            $files = json_decode(customer::find($uid)->document);
            if(empty($files)){
                return response()->with('error','No Data');
            }
           // return $files;
            foreach ($files as $key => $value){
                $relativeName = basename($value);
                //return $value;
                $zip->addFile(public_path($value), $relativeName);
            }
            $zip->close();
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);

   // return response()->download($uid);
}
    public function redirect()
    {
    return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {

      try{
            $google_user = Socialite::driver('google')->user();
            $user = customer::where('google_id',$google_user->getId())->first();
            if(!$user){
                // dd($google_user->getId());
                    $new_user = customer::updateOrCreate(['email'=>$google_user->getEmail()],[
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId()
                    ]);

                   session()->put('FRONT_USER_LOGIN',true);
                   session()->put('FRONT_USER_ID',$new_user->id);
                   session()->put('FRONT_USER_NAME',$new_user->name);
                    return redirect()->intended('/');
            }else{
                
                session()->put('FRONT_USER_LOGIN',true);
                session()->put('FRONT_USER_ID',$user->id);
                session()->put('FRONT_USER_NAME',$user->name);
                // Auth::login($user);
                    return redirect()->intended('/');
            }

      } catch(Exception $th){
        return $th->getMessage();
        //return redirect()->back();
      }
    }
  public function deletefile($id,$file)
  {
    $decodedFile = urldecode($file);

    // Delete the file
    $filePath = public_path($decodedFile);
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Update user's document list
    $user = Customer::find($id);
    $documents = json_decode($user->document ?? '[]', true);
    $updated = array_filter($documents, fn($doc) => $doc !== $decodedFile);

    $user->document = json_encode(array_values($updated));
    $user->save();

    // Customer::find($id)->update([
    //   'document'=>Null,
    //   ]);
   return redirect()->back()->with('File deleted Sucessfully');
  }
  
  /*anand start code register user */
  
    public function register_store(Request $request)
    {
    
        // return;

        // validate data
        $request->validate([
            // 'name' =>'required',
            // 'email' => 'required|email',
            // 'mobile' =>'required',
            // 'password' => 'required'
            
            'name' =>'required',
            "email"=>'required|email|unique:customers,email',
            "mobile"=>'required|numeric|digits:10|unique:customers',
            'password' => 'required'
        ]);
        
        $customer = new Customer;
        
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->country_code = $request->country_code ?? null;
        
        $password = $request->password;
        $hashedPassword = Hash::make($password);

        $customer->password = $hashedPassword;
        $customer->save();
        
        $email = $request->input('email');
        $password = $request->input('password');

        $user = customer::where('email', $email)->first();

        if ($user) {
            // Check if the provided password matches the hashed password in the database
            if (Hash::check($password, $user->password)) {
                // Successfully logged in, handle the session or JWT token creation
                // return redirect()->route('/userdashboard');
                
                session()->put('FRONT_USER_LOGIN',true);
                session()->put('FRONT_USER_ID',$user->id);  
                session()->put('FRONT_USER_NAME',$user->name);
                 session()->put('panel',$user->panel_status);
                session()->put('theme',$user->theme_color);
                session()->put('theme_profile',$user->themeprofile);
                Auth::guard('customer')->login($user);
                 //return redirect()->intended('/');
                 
                 $redirectUrl = Session::get('url');
                 if (empty($redirectUrl) || !is_string($redirectUrl)) {
                     Session::forget('url');
                     return redirect()->intended('/');
                 }

                 return redirect($redirectUrl);
                 
                
            }
        }
        
        return redirect('/Login')->withSuccess('User Registered !!!!');
    }
  

    public function login_store(Request $request)
    {
        //dd($request->fullUrl());
        // return; 

        $email = $request->input('email');
        $password = $request->input('password');

        $user = customer::where('email', $email)->first();

        if ($user) {
            // Check if the provided password matches the hashed password in the database
            if (Hash::check($password, $user->password)) {
                // Successfully logged in, handle the session or JWT token creation
                // return redirect()->route('/userdashboard');
                
                session()->put('FRONT_USER_LOGIN',true);
                session()->put('FRONT_USER_ID',$user->id);  
                session()->put('FRONT_USER_NAME',$user->name);
                 session()->put('panel',$user->panel_status);
                session()->put('theme',$user->theme_color);
                session()->put('theme_profile',$user->themeprofile);
                Auth::guard('customer')->login($user);
                 //return redirect()->intended('/');
                 
                $redirectUrl = Session::get('url');
                if (empty($redirectUrl) || !is_string($redirectUrl)) {
                    Session::forget('url');
                    return redirect()->intended('/');
                } else {
                    $productId = $request->input('product_id');
                    if(!empty($productId)){
                        $checkoutPage = $this->shoping_cart($request,$productId,true);
                        return redirect('new-cart');
                    }

                    return redirect($redirectUrl);
                }
            } else {
                // Incorrect password, show an error message
                return redirect()->back()->with('error', 'Incorrect password.');
            }
        } else {
            // User not found, show an error message
            return redirect()->back()->with('error', 'User not found.');
        }
        
    }
    
    
    /*-------------------- anand start code for normal and gold user --------------------*/
    
        // public function login_store(Request $request)
        // {
        //     $email = $request->input('email');
        //     $password = $request->input('password');
        
        //     // Check for a normal user
        //     $user = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 0)
        //         ->first();
        
        //     // Check for a gold user
        //     $gold = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 1)
        //         ->first();
        
        //     if ($user) {
        //         // Check if the provided password matches the hashed password in the database
        //         if (Hash::check($password, $user->password)) {
        //             // Successfully logged in as a normal user, handle the session or JWT token creation
        //             session()->put('FRONT_USER_LOGIN', true);
        //             session()->put('FRONT_USER_ID', $user->id);
        //             session()->put('FRONT_USER_NAME', $user->name);
        //             return redirect('/userdashboard');
        //         } else {
        //             // Incorrect password, show an error message
        //             return redirect()->back()->with('error', 'Incorrect password.');
        //         }
        //     } elseif ($gold) {
        //         // Check if the provided password matches the hashed password in the database
        //         if (Hash::check($password, $gold->password)) {
        //             // Successfully logged in as a gold user, handle the session or JWT token creation for gold panel
        //             session()->put('FRONT_USER_LOGIN', true);
        //             session()->put('FRONT_USER_ID', $gold->id);
        //             session()->put('FRONT_USER_NAME', $gold->name);
        //             return redirect('/goldpaneldashboard');
        //         } else {
        //             // Incorrect password, show an error message
        //             return redirect()->back()->with('error', 'Incorrect password.');
        //         }
        //     } else {
        //         // User not found, show an error message
        //         return redirect()->back()->with('error', 'User not found.');
        //     }
        // }
    
        // public function login_store(Request $request)
        // {
        //     $email = $request->input('email');
        //     $password = $request->input('password');
        
        //     // Check for a normal user
        //     $user = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 0)
        //         ->first();
        
        //     // Check for a gold user
        //     $gold = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 1)
        //         ->first();
        
        //     if ($user || $gold) {
        //         // Check if the provided password matches the hashed password in the database
        //         $foundUser = $user ? $user : $gold;
        
        //         if (Hash::check($password, $foundUser->password)) {
        //             // Successfully logged in, handle the session or JWT token creation
        //             session()->put('FRONT_USER_LOGIN', true);
        //             session()->put('FRONT_USER_ID', $foundUser->id);
        //             session()->put('FRONT_USER_NAME', $foundUser->name);
        
        //             // Redirect based on panel_status
        //             if ($foundUser->panel_status == 0) {
        //                 return redirect('/userdashboard');
        //             } elseif ($foundUser->panel_status == 1) {
        //                 return redirect('/goldpaneldashboard');
        //             }
        //         } else {
        //             // Incorrect password, show an error message
        //             return redirect()->back()->with('error', 'Incorrect password.');
        //         }
        //     } else {
        //         // User not found, show an error message
        //         return redirect()->back()->with('error', 'User not found.');
        //     }
        // }
    
    
        // public function login_store(Request $request)
        // {
        //     $email = $request->input('email');
        //     $password = $request->input('password');
        
        //     // Check for a normal user
        //     $user = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 0)
        //         ->first();
        
        //     // Check for a gold user
        //     $gold = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 1)
        //         ->first();
        
        //     // Check if either a normal or gold user is found
        //     if ($user || $gold) {
        //         // Choose the user based on priority (gold user first)
        //         $foundUser = $gold ?? $user;
        
        //         // Check if the provided password matches the hashed password in the database
        //         if (Hash::check($password, $foundUser->password)) {
        //             // Successfully logged in, handle the session or JWT token creation
        //             session()->put('FRONT_USER_LOGIN', true);
        //             session()->put('FRONT_USER_ID', $foundUser->id);
        //             session()->put('FRONT_USER_NAME', $foundUser->name);
        
        //             // Redirect based on panel_status
        //             return redirect($foundUser->panel_status == 1 ? '/goldpaneldashboard' : '/userdashboard');
        //         } else {
        //             // Incorrect password, show an error message
        //             return redirect()->back()->with('error', 'Incorrect password.');
        //         }
        //     } else {
        //         // User not found, show an error message
        //         return redirect()->back()->with('error', 'User not found.');
        //     }
        // }
        
        // public function login_store(Request $request)
        // {
        //     $email = $request->input('email');
        //     $password = $request->input('password');
        
        //     // Check for a user with panel_status 1 (gold user)
        //     $gold = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 1) 
        //         ->first(); 
          
        //     // If a gold user is found, check the password
        //     if ($gold && Hash::check($password, $gold->password)) {
        //         // Successfully logged in as a gold user, handle the session or JWT token creation
        //         session()->put('FRONT_USER_LOGIN', true);
        //         session()->put('FRONT_USER_ID', $gold->id);
        //         session()->put('FRONT_USER_NAME', $gold->name);
        //         return redirect('/goldpaneldashboard');
        //     }
        
        //     // If no gold user is found or the password doesn't match, check for a normal user
        //     $user = DB::table('customers')
        //         ->where('email', $email)
        //         ->where('panel_status', 0)
        //         ->first();
        
        //     // If a normal user is found, check the password
        //     if ($user && Hash::check($password, $user->password)) {
        //         // Successfully logged in as a normal user, handle the session or JWT token creation
        //         session()->put('FRONT_USER_LOGIN', true);
        //         session()->put('FRONT_USER_ID', $user->id);
        //         session()->put('FRONT_USER_NAME', $user->name);
        //         return redirect('/userdashboard');
        //     }
          
        //     // If no user is found or the password doesn't match, show an error message
        //     return redirect()->back()->with('error', 'User not found or incorrect password.');
        // }


    /*-------------------- anand end code for normal and gold user --------------------*/









    /* annad start code for gold user */
    public function login_gold_store(Request $request)
    {
        // dd($request->all());
        // return; 
           
        $email = $request->input('email'); 
        $password = $request->input('password');
  
        //$user = DB::table('customers')->where('email', $email)->first();
          
        $user = DB::table('customers')     
        ->where('email', $email)
        ->where('panel_status', 1) // Adding a condition for panel_status
        ->first(); 

        if ($user) {
            // Check if the provided password matches the hashed password in the database
            if (Hash::check($password, $user->password)) {
                // Successfully logged in, handle the session or JWT token creation
                // return redirect()->route('/userdashboard');
                
                session()->put('FRONT_USER_LOGIN',true);
                session()->put('FRONT_USER_ID',$user->id);
                session()->put('FRONT_USER_NAME',$user->name);
                 //return redirect()->intended('/');
                return redirect('/gold');
            } else {
                // Incorrect password, show an error message
                return redirect()->back()->with('error', 'Incorrect password.');
            }
        } else {
            // User not found, show an error message
            // return redirect()->back()->with('error', 'User not found.');
             return redirect()->back()->with('error', 'Incorrect login details.');
        }
        
    }
    
    
    
    public function theme_change(){
        
       $status = Session::get('theme');
       
       if($status == 0){
           session()->put('theme',1);
           $status = 1;
       }else{
           session()->put('theme',0);
           $status = 0; 
       }
       
      
       DB::table('customers')->where('id',Session::get('FRONT_USER_ID'))->update(array('theme_color'=>$status));
       return back();
       
    }
    
    public function theme_change_profile(){
        
       $status = Session::get('theme_profile');
       
       if($status == 0){
           session()->put('theme_profile',1);
           $status = 1;
       }else{
           session()->put('theme_profile',0);
           $status = 0; 
       }
       
      
       DB::table('customers')->where('id',Session::get('FRONT_USER_ID'))->update(array('themeprofile'=>$status));
       return back();
       
    }
    
    
    
    
    
    /* annad end code for gold user */
    
    
    /* If no have order in order table so redirect error page, No access userpanel until user purchase any order */
    
    // public function login_store(Request $request)
    // {
    //     $email = $request->input('email');
    //     $password = $request->input('password');
    
    //     $user = DB::table('customers')->where('email', $email)->first();
    
    //     if ($user) {
    //         // Check if the provided password matches the hashed password in the database
    //         if (Hash::check($password, $user->password)) {
    //             // Check if the user has a successful and active order
    //             $hasActiveOrder = DB::table('orders')
    //                 ->where('user_id', $user->id)
    //                 ->where('order_status', 'active')
    //                 ->where('payment_status', 'SUCCESS')
    //                 ->exists();
    
    //             if ($hasActiveOrder) {
    //                 // User has an active order, allow access to the user panel
    //                 session()->put('FRONT_USER_LOGIN', true);
    //                 session()->put('FRONT_USER_ID', $user->id);
    //                 session()->put('FRONT_USER_NAME', $user->name);
    
    //                 return redirect('/userdashboard');
    //             } else {
    //                 // No active order found, show a message and prevent access to the user panel
    //                 //return redirect('/userdashboard')->with('error', 'Please Purchase a Card to use User Panel.');
    //                 // return redirect()->back()->with('error', 'Please Purchase a Card to use User Panel.');
                     
    //                 //return redirect('frontend.purchase_error');
                    
    //                 session()->put('PURCHASE_ERROR', true); 
    //                 return view('frontend.purchase_error');
    //             }
    //         } else {
    //             // Incorrect password, show an error message
    //             return redirect()->back()->with('error', 'Incorrect password.');
    //         }
    //     } else {
    //         // User not found, show an error message
    //         return redirect()->back()->with('error', 'User not found.');
    //     }
    // }
    
    /* ---------------- */
    
  
  /* anand end code */
  
  
  function product_enquery(Request $request){
      $inserrtyData = array(
          'pid'=>$request->proid,
          'name'=>$request->name,
          'city'=>$request->area,
          'mobile'=>$request->phone,
          'user_id'=>session::get('FRONT_USER_ID'),
          );

          DB::table('product_lead')->insert($inserrtyData);
          return 0;
  }

  /**
   * Display theme preview with sample data
   */
  public function themePreview($slug)
  {
      if ($slug === 'ca') {
          $slug = 'accountant';
      }

      // Find theme by slug
      $theme = ProfessionTheme::where('slug', $slug)
                              ->where('status', 1)
                              ->first();

      if (!$theme) {
          abort(404, 'Theme not found');
      }

      // Load sample data from config
      $sampleData = config('theme-samples.' . $slug, config('theme-samples.default'));

      if (!$sampleData) {
          $sampleData = config('theme-samples.default');
      }

      // Create mock userdata model so theme helpers (e.g. isFeatureVisible) work
      $d['userdata'] = new customer();
      $d['userdata']->forceFill($sampleData['user']);
      $d['userdata']->visibility_settings = $sampleData['visibility_settings'] ?? [];
      $d['userdata']->id = 0; // Mock ID for compatibility

      $d['qualifications'] = collect($sampleData['qualifications'] ?? []);
      $d['professions'] = collect($sampleData['professions'] ?? []);
      $d['thoughts'] = collect($sampleData['thoughts'] ?? []);
      $d['portfolios'] = collect($sampleData['portfolios'] ?? []);
      $d['social'] = $sampleData['social'] ?? (object)[];
      $d['videos'] = collect($sampleData['videos'] ?? []);
      $d['professional_photos'] = collect($sampleData['professional_photos'] ?? []);
      $d['myproducts'] = collect($sampleData['myproducts'] ?? []);
      $d['theme'] = $theme;
      $d['isPreview'] = true; // Flag to show "This is a preview" banner
      $d['politicalProfile'] = $sampleData['politicalProfile'] ?? null;
      $d['publicServices'] = collect($sampleData['publicServices'] ?? []);
      $d['developmentProjects'] = collect($sampleData['developmentProjects'] ?? []);
      $d['publicEvents'] = collect($sampleData['publicEvents'] ?? []);
      $d['interiorServices'] = collect($sampleData['interiorServices'] ?? []);
      $d['interiorProjects'] = collect($sampleData['interiorProjects'] ?? []);
      $d['interiorPortfolio'] = collect($sampleData['interiorPortfolio'] ?? []);
      $d['educationCourses'] = collect($sampleData['educationCourses'] ?? []);
      $d['educationFaculty'] = collect($sampleData['educationFaculty'] ?? []);
      $d['educationResults'] = collect($sampleData['educationResults'] ?? []);
      $d['solarSolutions'] = collect($sampleData['solarSolutions'] ?? []);
      $d['solarProjects'] = collect($sampleData['solarProjects'] ?? []);
      $d['solarMonitoring'] = collect($sampleData['solarMonitoring'] ?? []);
      $d['solarAmc'] = collect($sampleData['solarAmc'] ?? []);
      $d['solarSubsidies'] = collect($sampleData['solarSubsidies'] ?? []);
      $d['caServices'] = collect($sampleData['caServices'] ?? []);
      $d['caCases'] = collect($sampleData['caCases'] ?? []);
      $d['caConsultations'] = collect($sampleData['caConsultations'] ?? []);
      $d['caDeadlines'] = collect($sampleData['caDeadlines'] ?? []);
      $d['astroServices'] = collect($sampleData['astroServices'] ?? []);
      $d['astroConsultations'] = collect($sampleData['astroConsultations'] ?? []);
      $d['astroReports'] = collect($sampleData['astroReports'] ?? []);
      $d['securityProducts'] = collect($sampleData['securityProducts'] ?? []);
      $d['securitySurveys'] = collect($sampleData['securitySurveys'] ?? []);
      $d['securityProjects'] = collect($sampleData['securityProjects'] ?? []);
      $d['securityAmc'] = collect($sampleData['securityAmc'] ?? []);
      $d['creatorStats'] = collect($sampleData['creatorStats'] ?? []);
      $d['brandCollaborations'] = collect($sampleData['brandCollaborations'] ?? []);
      $d['creatorPortfolio'] = collect($sampleData['creatorPortfolio'] ?? []);

      // Restaurant-specific data (Theme ID 13)
      if ($slug == 'restaurant') {
          $d['menuCategories'] = collect($sampleData['menuCategories'] ?? []);
          $d['restaurantInfo'] = $sampleData['restaurantInfo'] ?? (object)[];
      }

      // Use the model's view_path accessor
      $viewPath = $theme->view_path;

      // Check if theme view exists
      if (!view()->exists($viewPath)) {
          abort(404, 'Theme template not found: ' . $viewPath);
      }

      return view($viewPath, $d);
  }

}

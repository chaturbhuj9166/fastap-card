<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\customer;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\Profession;
use App\Models\Cart;
use App\Models\coupon;
use App\Models\Order;
class ProfileController extends Controller
{
 
    public function getprofile($userid){
        $user=customer::find($userid);
        if($user){
            
            $user->makeHidden('password');
            $res=[
                'data'=>$user,
                'message'=>'User Fetch Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'User Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
    }

    public function getmessages($userid){
        $user=customer::find($userid);
        if($user){
            $res=[
                'data'=>$user->messages,
                'message'=>'User Fetch Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'User Data  Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
        
    }
    
    public function profileupdate(Request $req){
       $res= customer::find($req->user_id)->update([
            'name'=>$req->name,
            'email'=>$req->email,
            'mobile'=>$req->mobile,
            'profession'=>$req->occupation,
            'city'=>$req->city,
            'state'=>$req->state,
            ]);
            if($res){
                 $res=[
                'data'=>customer::find($req->user_id),
                'message'=>'User Update Successfully',
                'error'=>null,
                ];
            }
            else
            {
                 $res=[
            'data'=>NULL,
            'message'=>'User Data  Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
            }
            return response()->json($res);
    }
    
    public function getsmartcards(){
        $user=product::where('catagory_id',6)->orwhere('catagory_id',9)->get();
           if($user){
            $res=[
                'data'=>$user,
                'message'=>'Smart Card Fetch Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'Smart Card Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
        
    }
    
    
      public function getprofessionalcards(){
        $user=product::where('catagory_id',7)->get();
           if($user){
            $res=[
                'data'=>$user,
                'message'=>'Professional Card Fetch Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'Professional Card Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
        
    }
    
    public function getprofession(){
        $user=profession::get();
           if($user){
            $res=[
                'data'=>$user,
                'message'=>'Professional  Fetch Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'Professional  Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
    }
    
    
     public function shoping_cart(Request $request,$id){
         
         $user_id=NULL;
         if($request->user_id){
            $user_id=customer::find($request->user_id)->id??null;
         }
            // $user_id = $request->session()->get('FRONT_USER_ID');
           
            if(!empty($user_id)){
               
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
                    
                        
    
                   return response()->json([
                       'data'=>$cart,
                       'message'=>'cart Added',
                       'error'=>NULL
                       ]);
                
            }else{
                return response()->json(
                    [
                    'data'=>NULL,
                    'error'=>[
                    'message'=>'User Not Authorised',
                    'error'=>503,
                    ]]);
            }
        
        
        }
    public function product($id){
        $user=Product::find($id);
         if($user){
            $res=[
                'data'=>$user,
                'message'=>' Card Fetch Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'Card Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
    }
    
    public function googlelogin(Request $req){
        if(customer::where('email',$req->email)->exists()){
            return response()->json(['message'=>'Email Already Exist']);
        }
        $user=customer::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'google_id'=>$req->google_id,
            ]);
             if($user){
            $res=[
                'data'=>$user,
                'message'=>'User Add Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'User Not Regsiter',
            'error'=>[
                'message'=>'Something went wrong',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
    }
    public function couponlist(){
        $user=coupon::get();
         if($user){
            $res=[
                'data'=>$user,
                'message'=>' Coupon Fetch Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'Coupan Not Found',
            'error'=>[
                'message'=>'Coupon Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
    }
    
    public function getlink($userid){
        $user=customer::find($userid);
       
        if($user){
             $user=$user->mobile;
        $link=url('/profile').'/'.$user;
            $res=[
                'data'=>$link,
                'message'=>'User Link Successfully',
                'error'=>null,
                ];
        }
        else{
            $res=[
            'data'=>NULL,
            'message'=>'User Not Found',
            'error'=>[
                'message'=>'Data Not Found',
                'code'=>'503'
                ]
                ];
        }
        return response()->json($res);
    }
    
    public function orderlist($id){
        $data=Order::with('products')->where('user_id',$id)->get();
        if($data){
            $res=['data'=>$data,'message'=>'order found','error'=>NULL];
        }
        else
        {
            $res=['data'=>NULL,'message'=>'orders not available','error'=>['message'=>'Orders Not available','code'=>503]];
            
        }
        return response()->json($res);
        
    }
    
    
    
      
    public function confirmorderr(Request $request){
    
        $user_id = customer::find($user_id);
        if(!$user_id  || empty($user_id)){
            return response()->json(['data'=>null,'message'=>'No user Found']);
        }
        $carts = Cart::where('user_id', $user_id)->get();
        
        if(count($carts) == 0) {
            return response()->json(['data'=>null,'message'=>'No cart Found']);
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
        return response()->json(['data'=>$order,'message'=>'Product order Successfully']);
    }
    
 
    
    
    
    
    }


   
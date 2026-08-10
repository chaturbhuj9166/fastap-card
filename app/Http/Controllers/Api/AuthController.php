<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\customer;
use App\Http\Controllers\Controller;
use App\Models\product;
use App\Models\Profession;
use App\Models\Cart;
use App\Models\coupon;
use Illuminate\Support\Facades\Validator;
use Hash;
class AuthController extends Controller
{
 
 public function login(Request $req)
 {
    $customer=customer::where('palarun933@gmail.com',$req->email)->first();
    // return $customer;
    // if($customer){
       
    //   if(Hash::check($req->password,$customer->password)){
    //       $res=[
    //           'data'=>$customer,
    //           'message'=>'Login done',
    //           'error'=>NULL
    //           ];
    //   }
    //   else
    //   {
    //       $res=[
    //           'data'=>NULL,
    //           'message'=>'Invalid Credential',
    //           'error'=>[
    //               'message'=>'password not match',
    //               'code'=>503
    //               ]
    //           ];
    //   }
    // }
    // else
    // {
    //     $res=[
    //           'data'=>NULL,
    //           'message'=>'Invalid Credential',
    //           'error'=>[
    //               'message'=>'password not match',
    //               'code'=>503
    //               ]
    //           ]; 
    // }
    
               $res=[
              'data'=>$customer,
              'message'=>'Login done',
              'error'=>NULL
              ];
    return response()->json($res);
     
 }
 
 public function register(Request $req){
  $customer=Customer::firstOrCreate(['mobile'=>$req->mobile],['mobile'=>$req->mobile]);
  if($customer)
  {
      $res=[
          'data'=>$customer,
          'message'=>'Account Found',
          'error'=>NULL
          ];
  }
  else
  {
      $res=[
              'data'=>NULL,
              'message'=>'Some Error',
              'error'=>[
                  'message'=>'Account Not created',
                  'code'=>503,
                  ]
              ];
  }
  
         return response()->json($res);
 } 
    
    public function changepassword(Request $req)
    {
        
       $validator=Validator::make($req->all(),[
            'user_id'=>'required',
            'old_password'=>'required',
            'new_password'=>'required',
            'confirm_new_password'=>'required|same:new_password',
        ]);
        if($validator->fails()){
            $re= [
                'message'=>'Validation fails',
                'data'=>$validator->errors(),
                ];
        }else{
            $customer=customer::find($req->user_id);
           
            if($customer){
                
                if(Hash::check($req->old_password, $customer->password))
                {
                      $re=$customer->update([
                       'password' => Hash::make($req->new_password)
                       ]);
                        if($re){
                                 $re=[
                                     'data'=>$re,
                                     'message'=>'password updated Sucessfully',
                                     'error'=>null,
                                     ];
                                 }
                                 else
                                 {
                                 $re=[
                                     'data'=>NULL,
                                     'message'=>'Something went wrong',
                                     'error'=>[
                                         'message'=>'password not updated Sucessfully',
                                         'code'=>503
                                         ]
                                     ];
                                 }
                }
                else{
                    $re=[
                         'message'=>'old password not exist',
                         ];
                           
                    }
            }
            else{
                $re= [
                'message'=>'user not found',
                ];
            }
            
        }
          return response()->json($re);
    }
    
    
}


   
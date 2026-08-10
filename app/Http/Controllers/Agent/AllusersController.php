<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Notification;

use App\Models\Buyservice;
use App\Models\Service;

use App\Models\Mydocument;

use App\Models\Order;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// for upload csv file
use Illuminate\Support\Facades\Validator;
//

class AllusersController extends Controller
{
    public function index()
    {
        return view('agent-new.allusers' ,['users'=> User::latest()->paginate(10) ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'name' =>'required',
            'email' => 'required|email',
            'phone' =>'required',
           // 'password' => 'required',
            //'services' =>'required',
            //'services_expiry_date' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'
        ]);


        // upload image
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('admin\assets\img\avatars\users'),$imageName);

        $user = new User;
        $user->image = $imageName;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
       // $user->password = $request->password;
       // $user->services = $request->services;
       // $user->services_expiry_date = $request->services_expiry_date;
        $user->description = $request->description;

        $user->save();
        return redirect('/admin/allusers')->withSuccess('User Created !!!!');
    }

    public function edituser($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.edituser' , ['user'=> $user]);
    }

    public function update(Request $request ,$id)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'name' =>'required',
            'email' => 'required|email',
            'phone' =>'required',
          //  'password' => 'required',
           // 'services' =>'required',
           // 'services_expiry_date' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'
        ]);


        $user = User::where('id',$id)->first();

        if(isset($request->image))
        {
            // upload image
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('admin\assets\img\avatars\users'),$imageName);
            $user->image = $imageName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
       // $user->password = $request->password;
        //$user->services = $request->services;
       // $user->services_expiry_date = $request->services_expiry_date;
        $user->description = $request->description;

        $user->save();
        return redirect('/admin/allusers')->withSuccess('User Updated !!!!');
    }

    public function viewuser($id)
    {
        $user = User::where('id',$id)->first();
        return view('admin.viewuser' , ['user'=> $user]);
    }

    //
    public function manageuser($id)
    {
        $user = User::where('id',$id)->first();
        $notification = Notification::where('user_id',$id)->latest()->paginate(10);
        // Services Card start
        $buyservice = Buyservice::where('user_id',$id)->paginate(10);
        $service = Service::all();
        // Services Card end

        // Documents Card start
        $mydocument = Mydocument::where('user_id',$id)->paginate(10);
        //  Documents Card end


        // FOR EXPIRY DATE
            // $expiredDate = DB::table('buyservices')
            // ->where('validity_date', '<', Carbon::now())
            // ->get();

            // $nearExpireDate = Buyservice::where('validity_date', '>=', Carbon::now()->subDays(90))
            // ->get();

            // $newDate = Buyservice::where('created_at', '>=', Carbon::now()->subDays(7))
            // ->get();

        //

        // return view('admin.manageuser' , ['user'=> $user , 'notification'=> $notification , 'buyservice'=> $buyservice , 'service' =>$service ,'mydocument' =>$mydocument ,'expiredDate'=>$expiredDate ,'nearExpireDate'=>$nearExpireDate ,'newDate'=>$newDate]);

        return view('admin.manageuser' , ['user'=> $user , 'notification'=> $notification , 'buyservice'=> $buyservice , 'service' =>$service ,'mydocument' =>$mydocument ]);
    }

    public function storenotification(Request $request)
    {
        // dd($request->all());
        // return;
        // validate data
        $request->validate([
            'title' =>'required',
            'user_id'=>'required',
            'description' => 'required',
        ]);
        $notification = new Notification;
        $notification->title = $request->title;
        $notification->user_id = $request->user_id;
        $notification->description = $request->description;

        $notification->save();
        //return redirect('/admin/allusers')->withSuccess('User Created !!!!');
        return back()->withSuccess('Notification Created !!!!');
    }

    public function destroynotification($id)
    {
        $notification = Notification::where('id',$id)->first();
        $notification->delete();

        return back()->withSuccess('Notification Deleted !!!!');
    }

    public function editnotification($id , $user_id)
    {
        $user = User::where('id',$user_id)->first();
        $notification = Notification::where('id',$id)->first();

        return view('admin.editnotification' , ['user'=> $user , 'notification'=> $notification]);
    }

    public function updatenotification(Request $request ,$id)
    {
        // dd($request->all());
        // return;

        // validate data
        $request->validate([
            'title' =>'required',
            'user_id'=>'required',
            'description' => 'required'
        ]);

        $notification = Notification::where('id',$id)->first();

        $notification->title = $request->title;
        $notification->user_id = $request->user_id;
        $notification->description = $request->description;

        $notification->save();
        // return redirect('/admin/allusers')->withSuccess('User Updated !!!!');
        return back()->withSuccess('Notification Updated !!!!');
    }


    public function workprgress(Request $request ,$id)
    {
        // dd($request->all());
        // return;
        // validate data
        $request->validate([
            'work_prgress' =>'required',
        ]);

        $buyservice = Buyservice::where('id',$id)->first();

        $buyservice->work_prgress = $request->work_prgress;

        $buyservice->save();
        return back()->withSuccess('Work Progress Added !!!!');
    }

    public function validity_date(Request $request ,$id)
    {
        // dd($request->all());
        // return;
        // validate data
        $request->validate([
            'validity_date' =>'required',
        ]);

        $buyservice = Buyservice::where('id',$id)->first();

        $buyservice->validity_date = $request->validity_date;

        $buyservice->save();
        return back()->withSuccess('Validity Date Added !!!!');
    }

    // clear dues to order table

    // public function clear_dues(Request $request)
    // {
    //     //$existingItem = Cart::where('user_id', $user_id)->where('service_id', $request->service_id)->first();
    //     $order_id = $request->order_id;

    //     $clear_dues = Order::where('order_id',$order_id)->first();
    //     $clear_dues->payment_id = $request->payment_id;
    //     $clear_dues->payment_status = "complete";
    //     $clear_dues->save();
    // }
    //



    ////  Add bulk user in database


    public function bulkUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $existingPhoneNumbers = User::pluck('phone')->toArray();
        $createdCount = 0;

        foreach ($data as $row) {
            $phoneNumber = $row[2]; // Assuming phone number is in the third column
            $formattedPhoneNumber = $this->formatPhoneNumber($phoneNumber);

            if ($formattedPhoneNumber && !in_array($formattedPhoneNumber, $existingPhoneNumbers)) {
                // Create a new user with the formatted phone number
                // User::create([
                //     'phone' => $formattedPhoneNumber,
                //     'name' => $row[0], // Assuming name is in the first column
                //     'email' => $row[1], // Assuming email is in the second column
                //     'image' => $row[3], // Assuming email is in the four column
                //     'description' => $row[4], // Assuming email is in the five column
                //     'status' => $row[5], // Assuming email is in the six column

                // ]);

                // $bluk_user_hwe = new User;
                // $bluk_user_hwe->phone = $formattedPhoneNumber;
                // $bluk_user_hwe->name = $row[0];
                // $bluk_user_hwe->email =  $row[1];
                // $bluk_user_hwe->image =  $row[3];
                // $bluk_user_hwe->description =  $row[4];
                // $bluk_user_hwe->status =  $row[5];
                // $bluk_user_hwe->save();

                $user = new User();
                $user->name = $row[0]; // Assuming name is in the first column
                $user->email = $row[1]; // Assuming email is in the second column
                $user->phone = $formattedPhoneNumber;
                $user->image = $row[3]; // Assuming image URL is in the fourth column
                $user->description = $row[4]; // Assuming description is in the fifth column
                $user->status = $row[5]; // Assuming status is in the sixth column
                $user->save();


                $createdCount++;
                $existingPhoneNumbers[] = $formattedPhoneNumber;
            }
        }

        return redirect()->back()->with('success', "Successfully created $createdCount users.");
    }

    private function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        if (strlen($phoneNumber) == 10) {
            $phoneNumber = '+91' . $phoneNumber;
            return $phoneNumber;
        }

        return null;
    }


    /////
}

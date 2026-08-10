<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Agent;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('agent-new.login');
    }

    public function auth(Request $request)
    {
          $request->validate([
            'email' =>'required',
            'password' => 'required'
        ]);

        $email = $request->post('email');
        $password = $request->post('password');

        $result = Agent::where(['email'=>$email,'password'=>$password])->get();

        // echo "<pre>";
        //  echo $result[0]->id;
        // echo $result[0]->username;
        // echo "<br/>";
        // echo $result[0]->email;
        //  echo "<hr/>";
        // echo "<pre>";
        //     print_r($result);
        //       echo "</pre>";
        //      die;
    
        if(isset($result[0]->id)){
            $request->session()->put('AGENT_LOGIN',true);
            $request->session()->put('AGENT_ID',$result[0]->id);
            
            // for show username in header menu top
            $request->session()->put('AGENT_NAME',$result[0]->name);
            $request->session()->put('AGENT_EMAIL',$result[0]->email);
            $request->session()->put('ROLE',$result[0]->role);
            //
            return redirect('agent/dashboard');
        }else{
            $request->session()->flash('error','Please enter valid login details');
            return redirect('agent/login');
        }

    }

    public function logout()
    {
        Session::flush();

        return redirect('agent/login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CustomerController extends Controller
{
    public function save(Request $r)
    {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'email' => $r->email,
            'phone' => $r->phone,
            'username' => $r->username,
            'password' => bcrypt($r->password)
        );
        if($r->password!=$r->cpassword)
        {
            $r->session()->flash('sms1', 'The password and confirm password is not matched!');
            return redirect('/customer/sign-up')->withInput();
        }
        $user = DB::table('customers')->where('username', $r->username)->first();
        if($user!=null)
        {
            $r->session()->flash('sms1', 'The username already exist. Please use a different one!');
            return redirect('/customer/sign-up')->withInput();
        }
        $i = DB::table('customers')->insert($data);
        $r->session()->flash('sms', "You already register. Please login!");
        return redirect('/customer/login');
    }
    public function login(Request $r)
    {
        $username = $r->username;
        $pass = $r->password;
        $user = DB::table('customers')->where('username', $username)->first();
        if($user!=null)
        {
            if(password_verify($pass, $user->password))
            {
                if($r->session()->get('customer')!=NULL)
                {
                    $r->session()->forget('customer');
                    $r->session()->flush();
                }
                // save user to session
                $r->session()->put('customer', $user);
              
                return redirect('/');
            }
            else{
                $r->session()->flash('sms1', "Invalid email or password!");
                return redirect('/customer/login');
            }
        }
        else{
            $r->session()->flash('sms1', "Invalid username or password!");
            return redirect('/customer/login');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->forget('customer');
        $request->session()->flush();
        return redirect('/');
    }
}

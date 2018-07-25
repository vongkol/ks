<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class FrontShopOwnerController extends Controller
{

    public function index()
    {
        $data['shops'] = DB::table('shops')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(30);
        $data['shop_categories'] = DB::table('shop_categories')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
        return view('fronts.shops.shop-lists', $data);
    }
    public function shop_by_category($id)
    {
        $data['shops'] = DB::table('shops')
            ->where('active', 1)
            ->where('shop_category', $id)
            ->orderBy('id', 'desc')
            ->paginate(30);
        $data['shop_categories'] = DB::table('shop_categories')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
        $data['shop_category'] = DB::table('shop_categories')
            ->where('id',$id)
            ->first();
        
        return view('fronts.shops.shop-by-category', $data);
    }
    public function shop_detail($id) {
        $data['shop'] = DB::table('shops')
            ->where('active', 1)
            ->where('id', $id)
            ->first();
        $shop_owner =  $data['shop']->shop_owner;
        $data['shop_owner'] = DB::table('shop_owners')
            ->where('id', $shop_owner)
            ->first();
        $data['shop_categories'] = DB::table('shop_categories')
            ->where('active',1)
            ->get();
        return view('fronts.shops.shop-detail', $data);
    }

    public function register(){
        return view('fronts.owners.register');
    }
    public function do_register(Request $r)
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
        $counter = DB::table('shop_owners')
            ->where('username', $r->username)
            ->where('active', 1)
            ->count();
        if($counter>0)
        {
            $r->session()->flash('sms1', "Username is already in used. Please use a different one!");
            return redirect('/shop-owner/register')->withInput();
        }
        else if($r->password!=$r->cpassword)
        {
            $r->session()->flash('sms1', "The password and confirm password is not matched!");
            return redirect('/shop-owner/register')->withInput();
        }
        else{
            $i = DB::table('shop_owners')
                ->insertGetId($data);
            // send email to confirm
            $link = url('/') . "/confirm/".md5($i);
               
            $sms =<<<EOT
                <h2>Sign Up Verification</h2>
                <hr>
                <p>
                    Please click the link below to complete your registration.
                </p>
                <p>
                    <a href="{$link}" target="_blank">{$link}</a>
                </p>
EOT;
                // send email confirmation
                Right::sms($r->email, $sms);
            return view('fronts.owners.confirm');
        }
    }
    public function confirm($id)
    {
        DB::statement("UPDATE shop_owners set is_verified=1 where md5(id)='{$id}'");
        return redirect('/shop-owner/login');
    }
    public function login(){
        return view('fronts.owners.login');
    }
    public function do_login(Request $r)
    {
        $username = $r->username;
        $pass = $r->password;
        $user = DB::table('shop_owners')->where('username', $username)->first();
        if($user!=null)
        {
            if(password_verify($pass, $user->password) && $user->is_verified==1)
            {
                if($r->session()->get('user')!=NULL)
                {
                    $r->session()->forget('user');
                    $r->session()->flush();
                }
                // save user to session
                $r->session()->put('user', $user);
              
                return redirect('/owner');
            }
            else{
                $r->session()->flash('sms1', "Invalid email or password!");
                return redirect('/shop-owner/login');
            }
        }
        else{
            $r->session()->flash('sms1', "Invalid username or password!");
            return redirect('/shop-owner/login');
        }
    }
}

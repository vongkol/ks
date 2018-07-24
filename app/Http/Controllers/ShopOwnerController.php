<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ShopOwnerController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        $data['shop_owners'] = DB::table("shop_owners")
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view("shop-owners.index", $data);
    }

    public function create()
    {
        return view("shop-owners.create");
    }

    public function store(Request $request)
    {
        // check the email if it is valid or not
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $r->session()->flash('sms1', "Your email is invalid. Check it again!");
            return redirect('/admin/shop-owner/create')->withInput();
        }
        $email = DB::table('shop_owners')
            ->where('email', $request->email)
            ->where('active', 1)
            ->count();
        $username = DB::table('shop_owners')
            ->where('username', $request->username)
            ->where('active', 1)
            ->count();
        if($email === 0 && $username === 0) {
            $data = array(
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "gender" => $request->gender,
                "phone" => $request->phone,
                "address" => $request->address,
                "email" => $request->email,
                "username" => $request->username,
                "password" => password_hash($request->password, PASSWORD_BCRYPT),
            );
            $i = DB::table('shop_owners')->insertGetId($data);
            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'uploads/shop_owners/profile/'; // usually in public folder
                $file->move($destinationPath, $i.$file_name);
                $data['photo'] = $i.$file_name;
            
                $i = DB::table('shop_owners')->where('id', $i)->update($data);
            }
            if ($i)
            {
                $request->session()->flash("sms", "New shop owner has been created successfully!");
                return redirect("/admin/shop-owner/create");
            }
            else
            {
                $request->session()->flash("sms1", "Fail to create new shop owner!");
                return redirect("/admin/shop-owner/create")->withInput();
            }
        } else { 
            // check only email already exist
            if($email > 0 ) {
                $sms1 = "Your '{$request->email}' already exist. Please use a different one!";
            } 
            // check only username  already exist
            if($username > 0 ) {
                $sms1 = "Your '{$request->username}' already exist. Please use a different one!";
            } 
            // check username and email already exist
            if($username > 0 && $email > 0 ) {
                $sms1 = "Your '{$request->email}' and '{$request->username}' already exist. Please use a different one!";
            } 
           
            $request->session()->flash('sms1', $sms1);
            return redirect('/admin/shop-owner/create')->withInput();
        }
    }

    public function edit($id)
    {
        $data['shop_owner'] = DB::table("shop_owners")
            ->where("id", $id)
            ->first();

        return view("shop-owners.edit", $data);
    }

    public function update(Request $request)
    {
        // check the email if it is valid or not
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $r->session()->flash('sms1', "Your email is invalid. Check it again!");
            return redirect('/shop-owner/create')->withInput();
        }
        $email = DB::table('shop_owners')
            ->where('id', "!=", $request->id)
            ->where('email', $request->email)
            ->where('active', 1)
            ->count();
        $username = DB::table('shop_owners')
            ->where('id', "!=", $request->id)
            ->where('username', $request->username)
            ->where('active', 1)
            ->count();
        if($email === 0 && $username === 0) {
            // update data into shop owner 
            $data = array(
                "first_name" => $request->first_name,
                "last_name" => $request->last_name,
                "gender" => $request->gender,
                "phone" => $request->phone,
                "address" => $request->address,
                "email" => $request->email,
                "username" => $request->username,
            );
            if($request->hasFile('photo'))
            {
                $file = $request->file('photo');
                $file_name = $file->getClientOriginalName();
                $destinationPath = 'uploads/shop_owners/profile/'; // usually in public folder
                $file->move($destinationPath, $request->id.$file_name);
                $data['photo'] = $request->id.$file_name;
            }
            $i = DB::table('shop_owners')->where("id", $request->id)->update($data);
            if($i)
            {
                $request->session()->flash("sms", "All changes have been saved successfully!");
                return redirect("/admin/shop-owner/edit/". $request->id);
            }
            else{
                $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
                return redirect("/admin/shop-owner/edit/". $request->id);
            }
        } else {
             // check only email already exist
             if($email > 0 ) {
                $sms1 = "Your '{$request->email}' already exist. Please use a different one!";
            } 
            // check only username  already exist
            if($username > 0 ) {
                $sms1 = "Your '{$request->username}' already exist. Please use a different one!";
            } 
            // check username and email already exist
            if($username > 0 && $email > 0 ) {
                $sms1 = "Your '{$request->email}' and '{$request->username}' already exist. Please use a different one!";
            } 
           
            $request->session()->flash('sms1', $sms1);
            return redirect('/admin/shop-owner/edit/'. $request->id);
        }
    }

    public function reset_password($id)
    {
        $data['shop_owner'] = DB::table("shop_owners")
            ->where("id", $id)
            ->first();

        return view("shop-owners.reset-password", $data);
    }
    
    public function reset(Request $request)
    {
        // update data into shop owner 
        $data = array(
            "password" =>  password_hash($request->password, PASSWORD_BCRYPT),
        );
        $i = DB::table('shop_owners')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "Reset new password has been successfully!");
            return redirect("/shop-owner/reset-password/". $request->id);
        }
        else{
            $request->session()->flash("sms1", "Fail to reset new password. You might not change any thing!");
            return redirect("/shop-owner/reset-password/". $request->id);
        }
    }


     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['shop_owner'] = DB::table("shop_owners")
            ->where("id", $id)
            ->first();
            
        return view("shop-owners.detail", $data);
    }

    public function destroy($id)
    {
        DB::table('shop_owners')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0) {
            return redirect('/admin/shop-owner?page='.$page);
        }

        return redirect('/admin/shop-owner');
    }
}

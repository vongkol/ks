<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // function to load profile view
    public  function index()
    {
        $data['users'] = DB::table('users')
            ->join("roles", "users.role_id","=", "roles.id")
            ->select("users.*", "roles.name as role_name")
            ->paginate(12);
        return view("users.index", $data);
    }
    // function to load user profile
    public function load_profile()
    {
        $data['user'] = DB::table('users')->where('id', Auth::user()->id)->first();
        $data['role_name'] = DB::table('roles')->where('active',1)->where('id', $data['user']->role_id)->first();
        return view('users.profile', $data);
    }
    // load create user form
    public function create()
    {
        $data['roles'] = DB::table('roles')->get();
        return view('users.create', $data);
    }
    public function edit($id)
    {
//        if(!Right::check('User', 'u')){
//            return view('permissions.no');
//        }
        $data['user'] = DB::table('users')->where('id', $id)->first();
        $data['roles'] = DB::table('roles')->get();
        if(Auth::user()->role_id>1)
        {
            $data['roles'] = DB::table('roles')->where("company_id", Auth::user()->company_id)->get();
        }
        return view('users.edit', $data);
    }
    // delete a user by his/her id
    public function delete($id)
    {
//        if(!Right::check('User', 'd')){
//            return view('permissions.no');
//        }
        DB::table('users')->where('id', $id)->delete();
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/user?page='.$page);
        }
        return redirect('/user');
    }
    // function to upload photo
    public function update_profile(Request $r)
    {

        $lang = Auth::user()->language;
        if($lang=='kh')
        {
            $sms = "ពត៌មានប្រូហ្វាល់ត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ។";
            $sms1 = "ពត៌មានប្រូហ្វាល់មិនអាចធ្វើការផ្លាស់ប្តូរបានទេ, សូមត្រួតពិនិត្យម្តងទៀត!";
        }
        else{
            $sms = "All changes have been saved!";
            $sms1 = "Fail to save changes. Please check your entry again!";
        }
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'profile/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            // update data in table
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'language' => $r->language,
                'role_id' => $r->role,
                'photo' => $file_name
            );
            $i = DB::table('users')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/user/profile');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/user/profile');
            }
        }
        else{
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'language' => $r->language,
                'role_id' => $r->role
            );
            $i = DB::table('users')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/user/profile');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/user/profile');
            }
        }
    }
    // save user
    public function save(Request $r)
    {
        $sms = "New user has been created successfully!";
        $sms1 = "Fail to create new user. Please check your entry again!";

        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'username' => $r->name,
            'email' => $r->email,
            'phone' => $r->phone,
            'gender' => $r->gender,
            'password' => bcrypt($r->password),
            'role_id' => $r->role
        );
        $i = DB::table('users')->insertGetId($data);
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $i . '-' .$file->getClientOriginalName();
            $destinationPath = 'profile/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            DB::table("users")->where("id", $i)->update(["photo"=>$file_name]);
        }
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/user/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/user/create');
        }
    }
    // update user
    public function update(Request $r)
    {
        $sms = "All changes have been saved successfully.";
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'username' => $r->name,
            'email' => $r->email,
            'phone' => $r->phone,
            'gender' => $r->gender,
            'role_id' => $r->role
        );
        if($r->photo)
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'profile/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            $data['photo'] = $file_name;
        }
        $i = DB::table('users')->where('id', $r->id)->update($data);
        $r->session()->flash('sms', $sms);
        return redirect('/user/edit/'.$r->id);

    }
    // load reset password form
    public function reset_password()
    {
        return view('users.reset-password');
    }
    public function change_password(Request $r)
    {
        $id = Auth::user()->id;
        $new_password = $r->new_password;
        $confirm_password = $r->confirm_password;
        if ($new_password!=$confirm_password)
        {
                $r->session()->flash('sms1',"The password is not matched, please check again.");
                return redirect('/user/update-password/'.$id)->withInput();
        }
        else{
            $data = array(
                'password' => bcrypt($new_password)
            );
            $i = DB::table('users')->where('id', $id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms',"New password has been changed!");
                return redirect('/user/update-password/'.$id);
            }
           else{
               $r->session()->flash('sms1',"Fail to change password!");
               return redirect('/user/update-password/'.$id);
           }
        }
    }
    public function load_password($id)
    {
        $data['user'] = DB::table('users')->where('id', $id)->first();
        return view('users.change-password', $data);
    }
    // update password for other users by admin
    public function update_password(Request $r)
    {
        $id = $r->id;
        $lang = Auth::user()->language;
        $new_password = $r->new_password;
        $confirm_password = $r->confirm_password;

        $sms = "The password has been changed successfully.";
        $sms1 = "The password is not matched. Please check again!";

        if ($new_password!=$confirm_password)
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/user/update-password/'.$r->id)->withInput();
        }
        else{
            $data = array(
                'password' => bcrypt($new_password)
            );
            $i = DB::table('users')->where('id', $id)->update($data);
            $r->session()->flash('sms', $sms);
            return redirect('/user/update-password/'.$r->id);
        }
    }
    // load final page of change password success
    public function finish_page()
    {
        return view('users.finish-page');
    }

}

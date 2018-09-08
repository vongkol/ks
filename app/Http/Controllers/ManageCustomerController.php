<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ManageCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['customers'] = DB::table('customers')->orderBy('id', 'desc')->paginate(18);
        return view('customers.list', $data);
    }
    public function create()
    {
        return view('customers.create');
    }
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
        $customer = DB::table('customers')->where('username', $r->username)->first();
        if($customer!=null)
        {
            $r->session()->flash('sms1', "Username already in use, please use a different one!");
            return redirect('/admin/customer/create')->withInput();
        }
        $i = DB::table('customers')->insert($data);
        if($i)
        {
            $r->session()->flash('sms', "New customer has been created successfully!");
            return redirect('/admin/customer/create');
        }
        else{
            $r->session()->flash('sms1', "Fail to create customer. Please check your input again!");
            return redirect('/admin/customer/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['customer'] = DB::table('customers')->where('id', $id)->first();
        return view('customers.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'email' => $r->email,
            'phone' => $r->phone,
            'username' => $r->username
        );
        if($r->password)
        {
            $data['password'] = bcrypt($r->password);
        }
        $i = DB::table('customers')->where('id',$r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', "All changes have been saved!");
            return redirect('/admin/customer/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', "Fail to save changes. You might not make any change!");
            return redirect('/admin/customer/edit/'.$r->id);
        }
    }
    public function delete($id)
    {
        DB::table('customers')->where('id', $id)->delete();
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/customer?page='.$page);
        }
        return redirect('/admin/customer');
    }
}

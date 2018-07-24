<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index()
    {
        $data['roles'] = DB::table("roles")->where("active",1)->orderBy("name")->paginate(12); 
        return view("roles.index", $data);
    }
    // create
    public function create()
    {
        return view("roles.create");
    }
    // edit
    public function edit($id)
    {
        $data['role'] = DB::table("roles")->where("id", $id)->first();
        return view("roles.edit", $data);
    }
    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('roles')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New role has been created successfully!");
            return redirect("/role/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new role!");
            return redirect("/role/create")->withInput();
        }
    }
    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name
        );
        $i = DB::table('roles')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/role/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/role/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('roles')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/role?page='.$page);
        }
        return redirect('/role');
    }
}

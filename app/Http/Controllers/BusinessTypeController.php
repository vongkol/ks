<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class BusinessTypeController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        $data['business_types'] = DB::table("business_types")
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view("business-types.index", $data);
    }

    public function create()
    {
        return view("business-types.create");
    }

    public function store(Request $r)
    {
        $data = array(
            "name" => $r->name
        );

        $i = DB::table("business_types")->insert($data);
        if ($i)
        {
            $r->session()->flash("sms", "New business type has been created successfully!");
            return redirect("/admin/business-type/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new business type!");
            return redirect("/admin/business-type/create");
        }
    }

    public function edit($id)
    {
        $data['business_type'] = DB::table("business_types")
            ->where("id", $id)
            ->first();

        return view("business-types.edit", $data);
    }

    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name
        );
        $i = DB::table("business_types")->where("id", $r->id)->update($data);
        if ($i) {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/admin/business-type/edit/". $r->id);
        } else {
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/admin/business-type/edit/". $r->id);
        }
    }

    public function destroy($id)
    {
        DB::table('business_types')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/business-type?page='.$page);
        }
        
        return redirect('/admin/business-type');
    }
}

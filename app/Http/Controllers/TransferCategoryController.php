<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class TransferCategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        $data['transfers_categories'] = DB::table("transfers_categories")
            ->where('active',1)
            ->orderBy('name')
            ->paginate(12);

        return view("transfers-categories.index", $data);
    }

    public function create(Request $r)
    {
        return view("transfers-categories.create");
    }

    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name
        );
        $i = DB::table("transfers_categories")->insert($data);
        if ($i) {
            $r->session()->flash("sms", "New business transfer category has been created successfully!");
            return redirect("/admin/transfer-category/create");
        } else {
            $r->session()->flash("sms1", "Fail to create new business transfer category!");
            return redirect("/admin/transfer-category/create");
        }
    }

    public function edit($id)
    {
        $data['transfer_category'] = DB::table("transfers_categories")
            ->where("id", $id)
            ->first();
        return view("transfers-categories.edit", $data);
    }

    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name
        );
        $i = DB::table("transfers_categories")->where("id", $r->id)->update($data);
        if ($i) {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/admin/transfer-category/edit/". $r->id);
        } else {
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/admin/transfer-category/edit/". $r->id);
        }
    }

    public function delete($id)
    {
        DB::table('transfers_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/transfer-category?page='.$page);
        }

        return redirect('/admin/transfer-category');
    }
}

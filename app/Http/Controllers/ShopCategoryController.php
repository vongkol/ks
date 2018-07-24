<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ShopCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['shop_categories'] = DB::table('shop_categories')
            ->orderBy('id', 'desc')
            ->where('active',1)
            ->paginate(12);

        return view("shop-categories.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view("shop-categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            "name" => $request->name,
        );
        $i = DB::table('shop_categories')->insert($data);
        if ($i) {
            $request->session()->flash("sms", "New shop category has been created successfully!");
            return redirect("/admin/shop-category/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new shop category!");
            return redirect("/admin/shop-category/create")->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['shop_category'] = DB::table('shop_categories')
            ->where('active',1)
            ->where('id', $id)
            ->first();

        return view("shop-categories.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = array(
            "name" => $request->name,
        );
        $i = DB::table('shop_categories')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/shop-category/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/shop-category/edit/". $request->id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('shop_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0) {
            return redirect('/admin/shop-category?page='.$page);
        }

        return redirect('/admin/shop-category');
    }
}

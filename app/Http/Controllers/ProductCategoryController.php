<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select self join company categories
        $data['categories'] = DB::table('product_categories as a')
        ->leftjoin('product_categories as b','b.id','=','a.parent_id')
        ->select('a.*', 'b.name as parent_name')
        ->orderBy('id', 'desc')
        ->where('a.active',1)
        ->paginate(18);

        return view("product-categories.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // select self join company categories
        $data['categories'] = DB::table('product_categories')
            ->where('parent_id', 0)
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        
        return view("product-categories.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        // save data into company categories
        $data = array(
            "name" => $request->name,
            "parent_id" => $request->parent,
            'type' => $request->type
        );
        $i = DB::table('product_categories')->insertGetId($data);
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/product-categories/'; // usually in public folder
            $file->move($destinationPath, $i.$file_name);
            $data['icon'] = $i.$file_name;
          
            $i = DB::table('product_categories')->where('id', $i)->update($data);
        }
        if ($i)
        {
            $request->session()->flash("sms", "New product category has been created successfully!");
            return redirect("/admin/product-category/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new event category!");
            return redirect("/admin/product-category/create")->withInput();
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
        // select self join company categories
        $data['categories'] = DB::table('product_categories')
            ->where('parent_id', 0)
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['category'] = DB::table('product_categories')
            ->where('id', $id)
            ->first();
        return view("product-categories.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // update data into company categories
        $data = array(
            "name" => $request->name,
            "parent_id" => $request->parent,
            'type' => $request->type
        );
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/product-categories/'; // usually in public folder
            $file->move($destinationPath, $request->id.$file_name);
            $data['icon'] = $request->id.$file_name;
        }
        $i = DB::table('product_categories')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/product-category/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/product-category/edit/". $request->id);
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
        DB::table('product_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/product-category?page='.$page);
        }
        return redirect('/product-category');
    }
}

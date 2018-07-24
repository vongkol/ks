<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CompanyCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select self join company categories
        $data['company_categories'] = DB::table('company_categories as a')
            ->leftjoin('company_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->orderBy('id', 'desc')
            ->where('a.active',1)
            ->paginate(12);

        return view("company-categories.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // select self join company categories
        $data['company_categories'] = DB::table('company_categories as a')
            ->leftjoin('company_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active', 1)
            ->get();
        
        return view("company-categories.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save data into company categories
        $data = array(
            "name" => $request->name,
            "parent_id" => $request->parent_id,
        );
        $i = DB::table('company_categories')->insertGetId($data);
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/companies/icon/'; // usually in public folder
            $file->move($destinationPath, $i.$file_name);
            $data['icon'] = $i.$file_name;
          
            $i = DB::table('company_categories')->where('id', $i)->update($data);
        }
        if ($i)
        {
            $request->session()->flash("sms", "New company category has been created successfully!");
            return redirect("/admin/company-category/create");
        }
        else
        {
            $request->session()->flash("sms1", "Fail to create new company category!");
            return redirect("/admin/company-category/create")->withInput();
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
        $data['company_categories'] = DB::table('company_categories as a')
            ->leftjoin('company_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active',1)
            ->get();
         $data['company_category'] = DB::table('company_categories as a')
            ->leftjoin('company_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active', 1)
            ->where('a.id', $id)
            ->first();

        return view("company-categories.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // save data into company categories
        $data = array(
            "name" => $request->name,
            "parent_id" => $request->parent_id,
        );
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/companies/icon/'; // usually in public folder
            $file->move($destinationPath, $request->id.$file_name);
            $data['icon'] = $request->id.$file_name;
        }
        $i = DB::table('company_categories')->where("id", $request->id)->update($data);
        if ($i) {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/company-category/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/company-category/edit/". $request->id);
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
        DB::table('company_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/company-category?page='.$page);
        }

        return redirect('/admin/company-category');
    }
}

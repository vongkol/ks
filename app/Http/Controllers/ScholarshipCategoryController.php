<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ScholarshipCategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select self join
        $data['scholarship_categories'] = DB::table('scholarship_categories as a')
            ->leftjoin('scholarship_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->orderBy('id', 'desc')
            ->where('a.active', 1)
            ->paginate(18);

        return view("scholarship-categories.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // select self join
        $data['scholarship_categories'] = DB::table('scholarship_categories as a')
            ->leftjoin('scholarship_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->orderBy('id', 'desc')
            ->where('a.active', 1)
            ->get();
        return view("scholarship-categories.create", $data);
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
        $i = DB::table('scholarship_categories')->insertGetId($data);
        if($request->hasFile('icon')) {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'program_icon' .$i . $ss;
            $destinationPath = 'uploads/scholarships/icon/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            $data['icon'] = $file_name;
          
            $i = DB::table('scholarship_categories')->where('id', $i)->update($data);
        }
        if ($i) {
            $request->session()->flash("sms", "New scholarship category has been created successfully!");
            return redirect("/admin/scholarship-category/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new scholarship category!");
            return redirect("/admin/scholarship-category/create")->withInput();
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
        $data['scholarship_category'] = DB::table('scholarship_categories')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        // select self join
        $data['scholarship_categories'] = DB::table('scholarship_categories as a')
            ->leftjoin('scholarship_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->orderBy('id', 'desc')
            ->where('a.active', 1)
            ->get();
        return view("scholarship-categories.edit", $data);
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
            "parent_id" => $request->parent_id,
        );
        if($request->hasFile('icon'))
        {
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'program_icon' .$request->id . $ss;
            $destinationPath = 'uploads/scholarships/icon/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            $data['icon'] = $file_name;
        }
        $i = DB::table('scholarship_categories')->where("id", $request->id)->update($data);
        if ($i) {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/scholarship-category/edit/". $request->id);
        } else{
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/scholarship-category/edit/". $request->id);
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
        DB::table('scholarship_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/scholarship-category?page='.$page);
        }
        
        return redirect('/admin/scholarship-category');
    }
}

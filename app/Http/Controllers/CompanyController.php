<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class CompanyController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        $data['companies'] = DB::table("companies")
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(12);
            
        return view("companies.index", $data);
    }

    public function create(Request $r)
    {
        $data['business_types'] = DB::table('business_types')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('company_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view("companies.create", $data);
    }

    public function store(Request $request)
    {
        $data = array(
            "name" => $request->name,
            "business_type" => $request->business_type,
            "address" => $request->address,
            "office_phone" => $request->office_phone,
            "office_email" => $request->office_email,
            "profile" => $request->profile,
            "website" => $request->website,
            'category_id' => $request->category
        );
        $i = DB::table('companies')->insertGetId($data);
        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/companies/logo/'; // usually in public folder
            $file->move($destinationPath, $i.$file_name);
            $data['logo'] = $i.$file_name;
          
            $i = DB::table('companies')->where('id', $i)->update($data);
        }
        if ($i)
        {
            $request->session()->flash("sms", "New Company has been created successfully!");
            return redirect("/admin/company/create");
        }
        else
        {
            $request->session()->flash("sms1", "Fail to create new event Company!");
            return redirect("/admin/company/create")->withInput();
        }
    }

    public function edit($id)
    {
        $data['business_types'] = DB::table('business_types')
            ->orderBy('name', 'asc')
            ->where('active', 1)
            ->get();
        $data['categories'] = DB::table('company_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['company'] = DB::table("companies")->where("id", $id)->first();

        return view("companies.edit", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['business_types'] = DB::table('business_types')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('company_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['company'] = DB::table("companies")
            ->where("id", $id)
            ->first();

        return view("companies.detail", $data);
    }

    public function update(Request $request)
    {
        // update data into company 
        $data = array(
            "name" => $request->name,
            "business_type" => $request->business_type,
            "address" => $request->address,
            "office_phone" => $request->office_phone,
            "office_email" => $request->office_email,
            "profile" => $request->profile,
            "website" => $request->website,
            'category_id' => $request->category
        );
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/companies/logo/'; // usually in public folder
            $file->move($destinationPath, $request->id.$file_name);
            $data['logo'] = $request->id.$file_name;
        }
        $i = DB::table('companies')->where("id", $request->id)->update($data);
        if ($i) {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/company/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/company/edit/". $request->id);
        }
    }

    public function destroy($id)
    {
        DB::table('companies')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/company?page='.$page);
        }

        return redirect('/admin/company');
    }
}

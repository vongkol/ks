<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image; 

class SchoolController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        $data['schools'] = DB::table("schools")
            ->join('school_categories', 'school_categories.id', '=','schools.school_category')
            ->select('schools.*', 'school_categories.name as school_category')
            ->where('schools.active',1)
            ->orderBy('schools.id', 'desc')
            ->paginate(18);

        return view("schools.index", $data);
    }

    public function create(Request $r)
    {
        $data['school_categories'] = DB::table('school_categories')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        return view("schools.create", $data);
    }

    public function store(Request $request)
    {
        $data = array(
            "name_khmer" => $request->name_khmer,
            "name_english" => $request->name_english,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,
            "profile" => $request->profile,
            "school_category" => $request->school_category,
        );
        $i = DB::table('schools')->insertGetId($data);
        if($i)
        {
            if($request->hasFile('logo'))
            {
                $file = $request->file('logo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'school' .$i . $ss;
                // upload 150
                $destinationPath = 'uploads/schools/logo/';
                $new_img = Image::make($file->getRealPath())->resize(150, null, function ($con) {
                    $con->aspectRatio();
                });
               
                $new_img->save($destinationPath . $file_name, 80);

                DB::table('schools')->where('id', $i)->update(['logo'=>$file_name]);
            
            }

            $request->session()->flash('sms', 'New school has been create successfully!');
            return redirect('/admin/school/create');
        }
        else{
            $request->session()->flash('sms1', 'Fail to create new school. Please check your input again!');
            return redirect('/admin/school/create')->withInput();
        }
    }

    public function edit($id)
    {
        $data['school_categories'] = DB::table('school_categories')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        $data['school'] = DB::table("schools")
            ->where("id", $id)
            ->first();

        return view("schools.edit", $data);
    }

    public function update(Request $request)
    {
        // update data into school 
        $data = array(
            "name_khmer" => $request->name_khmer,
            "name_english" => $request->name_english,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,
            "profile" => $request->profile,
            "school_category" => $request->school_category,
        );
        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'school' .$request->id . $ss;
            // upload 150
            $destinationPath = 'uploads/schools/logo/';
            $new_img = Image::make($file->getRealPath())->resize(150, null, function ($con) {
                $con->aspectRatio();
            });

            $new_img->save($destinationPath . $file_name, 80);
            $data['logo'] = $file_name;

        }
        $i = DB::table('schools')->where('id', $request->id)->update($data);
        if($i)
        {
            $request->session()->flash('sms', 'All changes have been saved!');
            return redirect('/admin/school/edit/'.$request->id);
        }
        else{
            $request->session()->flash('sms1', 'Fail to save changes!');
            return redirect('/admin/school/edit/'.$request->id);
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['school'] = DB::table("schools")
            ->where("id", $id)
            ->first();
        $school_cat = $data['school']->school_category;
        $data['school_category'] = DB::table('school_categories')
            ->where('id', $school_cat)
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->first();
        return view("schools.detail", $data);
    }

    public function destroy($id)
    {
        DB::table('schools')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0) {
            return redirect('/admin/school?page='.$page);
        }
        
        return redirect('/admin/school');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class SchoolProgramController extends Controller
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
        $data['school_programs'] = DB::table('school_programs')
            ->join('schools', 'school_programs.school_id', 'schools.id')
            ->join('program_categories', 'school_programs.program_category', 'program_categories.id')
            ->select('school_programs.*', 'schools.name_khmer as school_id', 'program_categories.name as program_category')
            ->orderBy('school_programs.id', 'desc')
            ->where('school_programs.active', 1)
            ->paginate(18);

        return view("school-programs.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // select self join school program
        $data['schools'] = DB::table('schools')
            ->orderBy('name_khmer', 'asc')
            ->where('active',1)
            ->get();
        $data['program_categories'] = DB::table('program_categories')
            ->where('active', 1)
            ->get();
        return view("school-programs.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save data into school program
        $data = array(
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school_id,
            "program_category" => $request->program_category,
        );
        $i = DB::table('school_programs')->insertGetId($data);
        
        if($i)
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'school_program' .$i . $ss;
            // upload 350
            $destinationPath = 'uploads/school_programs/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/school_programs/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
            $i =  DB::table('school_programs')->where('id', $i)->update(['featured_image'=>$file_name]);
            $request->session()->flash("sms", "New school program has been created successfully!");
            return redirect("/admin/school-program/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new event!");
            return redirect("/admin/school-program/create")->withInput();
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
        $data['school_program'] = DB::table('school_programs')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        $school_id = $data['school_program']->school_id;
        $program_category = $data['school_program']->program_category;
        $data['school'] = DB::table('schools')
            ->where('id', $school_id)
            ->where('active', 1)
            ->first();
        $data['program_category'] = DB::table('program_categories')
            ->where('id', $program_category)
            ->first();
        
        return view("school-programs.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['schools'] = DB::table('schools')
            ->where('active', 1)
            ->get();
        $data['school_program'] = DB::table('school_programs')
            ->where('active', 1)
            ->where('id', $id)
            ->first();
        $data['program_categories'] = DB::table('program_categories')
            ->where('active', 1)
            ->get();
        return view("school-programs.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // save data into school program
        $data = array(
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school_id,
            "program_category" => $request->program_category,
        );
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'school_program' .$request->id . $ss;
            // upload 350
            $destinationPath = 'uploads/school_programs/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/school_programs/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);

            $data['featured_image'] = $file_name;
        }
        $i = DB::table('school_programs')->where("id", $request->id)->update($data);
        if ($i) {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/school-program/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/school-program/edit/". $request->id);
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
        DB::table('school_programs')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0) {
            return redirect('/admin/school-program?page='.$page);
        }
        
        return redirect('/admin/school-program');
    }
}

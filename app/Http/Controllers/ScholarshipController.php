<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class ScholarshipController extends Controller
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
        $data['scholarships'] = DB::table('scholarships')
            ->leftJoin('schools', 'schools.id', '=', 'scholarships.school_id')
            ->leftJoin('scholarship_categories', 'scholarship_categories.id', 'scholarships.scholarship_category')
            ->select('scholarships.*', 'schools.name_khmer as school_id', 'scholarship_categories.name as scholarship_category')
            ->orderBy('scholarships.id', 'desc')
            ->where('scholarships.active',1)
            ->paginate(12);

        return view("scholarships.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['schools'] = DB::table('schools')
            ->orderBy('name_khmer', 'asc')
            ->where('active',1)
            ->get();
        $data['scholarship_categories'] = DB::table('scholarship_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view("scholarships.create", $data);
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
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school_id,
            "scholarship_category" => $request->scholarship_category,
        );
        $i = DB::table('scholarships')->insertGetId($data);
        
        if($i)
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'scholarship' .$i . $ss;
            // upload 350
            $destinationPath = 'uploads/scholarships/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/scholarships/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
            
            $i =  DB::table('scholarships')->where('id', $i)->update(['featured_image'=>$file_name]);
            $request->session()->flash("sms", "New scholarship has been created successfully!");
            return redirect("/admin/scholarship/create");
        }  else {
            $request->session()->flash("sms1", "Fail to create new scholarship!");
            return redirect("/admin/scholarship/create")->withInput();
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
        $data['scholarship'] = DB::table('scholarships')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        $school_id = $data['scholarship']->school_id;
        $data['school'] = DB::table('schools')
                ->where('id', $school_id)
                ->where('active', 1)
                ->first();
        
        return view("scholarships.detail", $data);
        
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
            ->orderBy('name_khmer', 'asc')
            ->where('active',1)
            ->get();
        $data['scholarship'] = DB::table('scholarships')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        $data['scholarship_categories'] = DB::table('scholarship_categories')
            ->where('active',1)
            ->get();
        return view("scholarships.edit", $data);
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
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school_id,
            "scholarship_category" => $request->scholarship_category,
        );
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'scholarship' .$request->id . $ss;
            // upload 350
            $destinationPath = 'uploads/scholarships/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/scholarships/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);

            $data['featured_image'] = $file_name;
        }

        $i = DB::table('scholarships')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/scholarship/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/scholarship/edit/". $request->id);
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
        DB::table('scholarships')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/scholarship?page='.$page);
        }
        return redirect('/admin/scholarship');
    }
}

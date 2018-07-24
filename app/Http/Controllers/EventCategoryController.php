<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class EventCategoryController extends Controller
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
        // select self join company categories
        $data['event_categories'] = DB::table('event_categories as a')
            ->leftjoin('event_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->orderBy('id', 'desc')
            ->where('a.active',1)
            ->paginate(12);

        return view("event-categories.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // select self join company categories
        $data['event_categories'] = DB::table('event_categories as a')
            ->leftjoin('event_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active', 1)
            ->get();
        
        return view("event-categories.create", $data);
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
        $i = DB::table('event_categories')->insertGetId($data);
        if($i)
        {
            if($request->icon) {

                $file = $request->file('icon');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'event_icon' .$i . $ss;

                $destinationPath = 'uploads/events/icon/';
                $new_img = Image::make($file->getRealPath())->resize(25, 25);
                $new_img->save($destinationPath . $file_name, 80);
                DB::table('event_categories')->where('id', $i)->update(['icon'=>$file_name]);
            }
            $request->session()->flash('sms', 'New event category has been created successfully!');
            return redirect('/admin/event-category/create');
        }
        else{
            $request->session()->flash('sms1', 'Fail to create new event category. Please check your input again!');
            return redirect('/admin/event-category/create')->withInput();
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
        $data['event_categories'] = DB::table('event_categories as a')
            ->leftjoin('event_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active',1)
            ->get();
        $data['event_category'] = DB::table('event_categories as a')
            ->leftjoin('event_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active',1)
            ->where('a.id', $id)
            ->first();

        return view("event-categories.edit", $data);
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
        if($request->icon) {
           
            $file = $request->file('icon');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'event_icon' .$request->id . $ss;
            $destinationPath = 'uploads/events/icon/';
            $new_img = Image::make($file->getRealPath())->resize(25, 25);
            $new_img->save($destinationPath . $file_name, 80);
            $data['icon'] =  $file_name;
        }
        $i = DB::table('event_categories')->where('id', $request->id)->update($data);
        if ($i)
        {
            $sms = "All changes have been saved successfully.";
            $request->session()->flash('sms', $sms);
            return redirect('/admin/event-category/edit/'.$request->id);
        }
        else
        {   
            $sms1 = "Fail to to save changes, please check again!";
            $request->session()->flash('sms1', $sms1);
            return redirect('/admin/event-category/edit/'.$request->id);
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
        DB::table('event_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/event-category?page='.$page);
        }
        
        return redirect('/admin/event-category');
    }
}

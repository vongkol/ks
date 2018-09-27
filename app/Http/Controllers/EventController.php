<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class EventController extends Controller
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
        $data['events'] = DB::table("events")
            ->join('event_categories', 'event_categories.id', '=','events.event_category')
            ->select('events.*', 'event_categories.name as event_category')
            ->where('events.active',1)
            ->orderBy('events.id', 'desc')
            ->paginate(12);

        return view("events.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['event_categories'] = DB::table("event_categories")
            ->where('active',1)
            ->orderBy('id', 'asc')
            ->get();

        return view("events.create", $data);
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
            "map" => $request->map,
            "location" => $request->location,
            "event_date" => $request->event_date,
            "description" => $request->description,
            "event_category" => $request->event_category,
            "event_organizor" => $request->event_organizor,
            "price" => $request->price,
            "register_link" => $request->register_link,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
        );
        $i = DB::table('events')->insertGetId($data);
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'event' .$i . $ss;
            // upload 350
            $destinationPath = 'uploads/events/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/events/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
           
        }
        $i =  DB::table('events')->where('id', $i)->update(['featured_image'=>$file_name]);
        if ($i)
        {
            $request->session()->flash("sms", "New event has been created successfully!");
            return redirect("/admin/event/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new event!");
            return redirect("/admin/event/create")->withInput();
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
        $data['event'] = DB::table('events')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        $event_cat = $data['event']->event_category;
        $data['event_category'] = DB::table('event_categories')
            ->where('event_categories.id',$event_cat )
            ->where('active',1)
            ->first();

        return view("events.detail", $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['event_categories'] = DB::table('event_categories as a')
            ->leftjoin('event_categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active',1)
            ->get();
        $data['event'] = DB::table('events')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        return view("events.edit", $data);
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
            "map" => $request->map,
            "location" => $request->location,
            "event_date" => $request->event_date,
            "description" => $request->description,
            "event_category" => $request->event_category,
            "event_organizor" => $request->event_organizor,
            "price" => $request->price,
            "register_link" => $request->register_link,
            "start_time" => $request->start_time,
            "end_time" => $request->end_time,
        );
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'event' .$request->id . $ss;
            // upload 350
            $destinationPath = 'uploads/events/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/events/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);

            $data['featured_image'] = $file_name;
        }
        $i = DB::table('events')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/event/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/event/edit/". $request->id);
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
        DB::table('events')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/event?page='.$page);
        }
        return redirect('/admin/event');
    }
}

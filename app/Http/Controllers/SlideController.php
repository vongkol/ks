<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class SlideController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['slides'] = DB::table('slides')
            ->where('active',1)
            ->get();
        return view('slides.index', $data);
    }
    public function create()
    {
        return view('slides.create');
    }
    public function save(Request $r)
    {
    	$file_name = '';
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/slides/image/';
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'name' => $r->name,
            'order' => $r->order,
            'url' => $r->url,
            'short_description' => $r->short_description,
            'photo' => $file_name,
        );
        $sms = "The new slide has been created successfully.";
        $sms1 = "Fail to create the new slide, please check again!";
        $i = DB::table('slides')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/slide/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin//slide/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('slides')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/slide?page='.$page);
        }

        return redirect('/admin/slide');
    }
    public function edit($id)
    {
        $data['slide'] = DB::table('slides')
            ->where('id',$id)->first();
        return view('slides.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'order' => $r->order,
            'url' => $r->url,
            'short_description' => $r->short_description,
        );
        if ($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/slides/image/';
            $file->move($destinationPath, $file_name);
            $data['photo'] = $file_name;
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('slides')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/slide/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/slide/edit/'.$r->id);
        }
    }
}


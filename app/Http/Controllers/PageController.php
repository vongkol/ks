<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        // if(!Right::check('Page', 'l'))
        // {
        //     return view('permissions.no');
        // }
        $data['pages'] = DB::table('pages')
            ->where('active', 1)
            ->paginate(18);
        return view('pages.index', $data);
    }
    // load create form
    public function create()
    {
        // if(!Right::check('Page', 'i'))
        // {
        //     return view('permissions.no');
        // }
        return view('pages.create');
    }
    // save new page
    public function save(Request $r)
    {
        // if(!Right::check('Page', 'i'))
        // {
        //     return view('permissions.no');
        // }
        $data = array(
            'title' => $r->title,
            'description' => $r->description
        );
        $sms = "The new page has been created successfully.";
        $sms1 = "Fail to create the new page, please check again!";
        $i = DB::table('pages')->insertGetId($data);

        if($i > 0) {
            $url = 'admin/page/view/'.$i;
            $data = array(
                'url' => $url
            );
            $i = DB::table('pages')->where('id', $i)->update($data);
        }

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('admin/page/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('admin/page/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        // if(!Right::check('Page', 'd'))
        // {
        //     return view('permissions.no');
        // }
        DB::table('pages')->where('id', $id)->update(['active'=>0]);
        return redirect('admin/page');
    }

    public function edit($id)
    {
        // if(!Right::check('Page', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data['page'] = DB::table('pages')
            ->where('id',$id)->first();
        return view('pages.edit', $data);
    }

    public function update(Request $r)
    {
        // if(!Right::check('Page', 'u'))
        // {
        //     return view('permissions.no');
        // }
        $data = array(
            'title' => $r->title,
            'description' => $r->description
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('pages')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('admin/page/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('admin/page/edit/'.$r->id);
        }
    }
    // view detail
    public function view($id) 
    {
        $data['page'] = DB::table('pages')
            ->where('id',$id)->first();
        return view('pages.view', $data);
    }
}


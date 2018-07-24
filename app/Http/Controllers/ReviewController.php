<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['reviews'] = DB::table('reviews')
            ->join('review_categories', 'reviews.category_id', 'review_categories.id')
            ->where('reviews.active', 1)
            ->orderBy('reviews.id', 'desc')
            ->select('reviews.*', 'review_categories.name')
            ->paginate(18);
        return view('reviews.index', $data);
    }
    public function create()
    {
        $data['categories'] = DB::table('review_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('reviews.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'review_by' => Auth::user()->id,
            'category_id' => $r->category,
            'description1' => $r->description1,
            'description2' => $r->description2
        );
        $i = DB::table('reviews')->insertGetId($data);
        if($i)
        {
            if($r->photo)
            {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'r' .$i . $ss;
                $destinationPath = 'uploads/reviews/'; 
                $file->move($destinationPath, $file_name);
              
                DB::table('reviews')->where('id', $i)->update(['featured_image'=>$file_name]);
            }
            $r->session()->flash('sms', 'New review has been created sucessfully!');
            return redirect('/admin/review/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new review. Please check again!');
            return redirect('/admin/review/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['review'] = DB::table('reviews')->where('id', $id)->first();
        $data['categories'] = DB::table('review_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('reviews.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'category_id' => $r->category,
            'description1' => $r->description1,
            'description2' => $r->description2
        );
        if($r->photo)
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'r' .$r->id . $ss;
            $destinationPath = 'uploads/reviews/'; 
            $file->move($destinationPath, $file_name);
            $data['featured_image'] = $file_name;
        }
        $i = DB::table('reviews')->where('id', $r->id)->update($data);
       
        $r->session()->flash('sms', 'All changes have been saved sucessfully!');
        return redirect('/admin/review/edit/'. $r->id);
        
    }
    public function delete($id)
    {
        DB::table('reviews')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/review?page='.$page);
        }
        
        return redirect('/admin/review');
    }
    public function detail($id)
    {
        $data['review'] = DB::table('reviews')
            ->join('review_categories', 'reviews.category_id', 'review_categories.id')
            ->where('reviews.active', 1)
            ->where('reviews.id', $id)
            ->select('reviews.*', 'review_categories.name')
            ->first();
        return view('reviews.detail', $data);
    }
}

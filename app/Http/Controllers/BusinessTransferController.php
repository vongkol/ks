<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
class BusinessTransferController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        return view("transfers.home");
    }
    public function transfer()
    {
        $data['business_transfers'] = DB::table("business_transfers")
            ->join('transfers_categories', 'transfers_categories.id', 'business_transfers.category_id')
            ->join('users', 'users.id', 'business_transfers.owner_id')
            ->select('users.*', 'transfers_categories.*', 'business_transfers.*')
            ->where('business_transfers.active',1)
            ->paginate(12);
        return view('transfers.index', $data);
    }
    public function create(Request $r)
    {
        $data['transfers_categories'] = DB::table('transfers_categories')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        return view("transfers.create", $data);
    }

    public function save(Request $request)
    {
        $data = array(
            "title" => $request->title,
            "category_id" => $request->transfer_categroy,
            "short_description" => $request->short_description,
            "owner_id" => Auth::user()->id,
            "description" => $request->description,
        );
        $i = DB::table('business_transfers')->insertGetId($data);
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/business_transfers/'; // usually in public folder
            $file->move($destinationPath, $i.$file_name);
            $data['featured_image'] = $i.$file_name;
          
            $i = DB::table('business_transfers')->where('id', $i)->update($data);
        }
        if ($i)
        {
            $request->session()->flash("sms", "New business transfer has been created successfully!");
            return redirect("/admin/business-transfer/create");
        }
        else
        {
            $request->session()->flash("sms1", "Fail to create new event business transfer!");
            return redirect("/admin/business-transfer/create")->withInput();
        }
    }

    public function edit($id)
    {
        $data['transfers_categories'] = DB::table('transfers_categories')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        $data['business_transfer'] = DB::table("business_transfers")->where("id", $id)->first();

        return view("transfers.edit", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $data['business_transfer'] = DB::table("business_transfers")
        ->join('transfers_categories', 'transfers_categories.id', 'business_transfers.category_id')
        ->join('users', 'users.id', 'business_transfers.owner_id')
        ->select('users.*', 'transfers_categories.*', 'business_transfers.*')
        ->where('business_transfers.active',1)
        ->where('business_transfers.id', $id)
        ->first();
        return view("transfers.detail", $data);
    }

    public function update(Request $request)
    {
          $data = array(
            "title" => $request->title,
            "category_id" => $request->transfer_categroy,
            "short_description" => $request->short_description,
            "owner_id" => Auth::user()->id,
            "description" => $request->description,
        );
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/business_transfers/'; // usually in public folder
            $file->move($destinationPath, $request->id.$file_name);
            $data['featured_image'] = $request->id.$file_name;
          
            $i = DB::table('business_transfers')->where('id', $request->id)->update(['featured_image'=>$data['featured_image']]);
        }
        $i = DB::table('business_transfers')->where("id", $request->id)->update($data);
        if ($i) {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/business-transfer/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/business-transfer/edit/". $request->id);
        }
    }

    public function delete($id)
    {
        DB::table('business_transfers')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/transfer?page='.$page);
        }

        return redirect('/admin/transfer');
    }
}

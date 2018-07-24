<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class ShopController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        $data['shops'] = DB::table("shops")
            ->join('shop_owners', 'shop_owners.id', '=', 'shops.shop_owner')
            ->select('shops.*', 'shop_owners.first_name as shop_owner_first_name',  'shop_owners.last_name as shop_owner_last_name' )
            ->where('shops.active',1)
            ->orderBy('shops.id', 'desc')
            ->paginate(12);
            
        return view("shops.index", $data);
    }

    public function create()
    {
        $data['shop_owners'] = DB::table("shop_owners")
            ->where('active',1)
            ->orderBy('first_name', 'asc')
            ->get();
        $data['shop_categories'] = DB::table("shop_categories")
            ->where('active',1)
            ->orderBy('name', 'asc')
            ->get();
        return view("shops.create", $data);
    }

    public function store(Request $request)
    {
        $data = array(
            "name" => $request->name,
            "shop_category" => $request->shop_category,
            "address" => $request->address,
            "phone" => $request->phone,
            "address" => $request->address,
            "email" => $request->email,
            "website" => $request->website,
            "shop_owner" => $request->shop_owner,
            'description' => $request->description
        );
        $i = DB::table('shops')->insertGetId($data);
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'shop' .$i. $ss;
            // upload 150
            $destinationPath = 'uploads/shops/logo/';
            $new_img = Image::make($file->getRealPath())->resize(150, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data['logo'] = $file_name;
        
            $i = DB::table('shops')->where('id', $i)->update($data);
        }
        if ($i) {
            $request->session()->flash("sms", "New shop has been created successfully!");
            return redirect("/admin/shop/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new shop!");
            return redirect("/admin/shop/create")->withInput();
        }
    }

    public function edit($id)
    {
        $data['shop_owners'] = DB::table("shop_owners")
            ->where('active',1)
            ->orderBy('first_name', 'asc')
            ->get();
        $data['shop_categories'] = DB::table("shop_categories")
            ->where('active',1)
            ->orderBy('name', 'asc')
            ->get();
        $data['shop'] = DB::table("shops")
            ->where("id", $id)
            ->first();

        return view("shops.edit", $data);
    }

    public function update(Request $request)
    {
        $data = array(
            "name" => $request->name,
            "shop_category" => $request->shop_category,
            "address" => $request->address,
            "phone" => $request->phone,
            "address" => $request->address,
            "email" => $request->email,
            "website" => $request->website,
            "shop_owner" => $request->shop_owner,
            'description' => $request->description
        );
        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'shop' .$request->id . $ss;
            // upload 150
            $destinationPath = 'uploads/shops/logo/';
            $new_img = Image::make($file->getRealPath())->resize(150, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data['logo'] = $file_name;
        }
        $i = DB::table('shops')->where("id", $request->id)->update($data);
        if ($i) {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/admin/shop/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/admin/shop/edit/". $request->id);
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
        $data['shop'] = DB::table("shops")
            ->where("id", $id)
            ->first();
        $shop_category = $data['shop']->shop_category;
        $shop_owner = $data['shop']->shop_owner;
        $data['shop_owner'] = DB::table("shop_owners")
            ->where('active',1)
            ->where('id',  $shop_owner)
            ->first();
        $data['shop_category'] = DB::table("shop_categories")
            ->where('active',1)
            ->where('id', $shop_category)
            ->first();
       

        return view("shops.detail", $data);
    }

    public function destroy($id)
    {
        DB::table('shops')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0) {
            return redirect('/admin/shop?page='.$page);
        }

        return redirect('/admin/shop');
    }
}
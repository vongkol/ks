<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['products'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->where('products.active', 1)
            ->orderBy('products.id', 'desc')
            ->select('products.*', 'product_categories.name as cname')
            ->paginate(18);
        return view('products.index', $data);
    }
    public function detail($id)
    {
        $data['product'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->join('shops', 'products.shop_id', 'shops.id')
            ->where('products.id', $id)
            ->select('products.*', 'product_categories.name as cname', 'products.id as p_id', 'shops.name as sname')
            ->first();
        $data['photos'] = DB::table('product_photos')
            ->where('product_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('products.detail', $data);
    }
    public function create()
    {
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['shops'] = DB::table('shops')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('products.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'category_id' => $r->category,
            'shop_id' => $r->shop,
            'price' => $r->price,
            'sell_price' => $r->sell_price,
            'type' => $r->type,
            'quantity' => $r->quantity,
            'short_description' => $r->short_description,
            'description' => $r->description
        );
        $i = DB::table('products')->insertGetId($data);
        if($i)
        {
            if($r->hasFile('photo'))
            {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'pro' .$i . $ss;
                // upload 350
                $destinationPath = 'uploads/products/featured/';
                $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                    $con->aspectRatio();
                });
                $destinationPath2 = 'uploads/products/featured/500/';
                $new_img2 = Image::make($file->getRealPath())->resize(500, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $file_name, 80);
                $new_img2->save($destinationPath2 . $file_name, 80);

                DB::table('products')->where('id', $i)->update(['featured_image'=>$file_name]);
            
            }

            $r->session()->flash('sms', 'New product has been create successfully!');
            return redirect('/admin/product/create');
        }
        else{
            $r->session()->flash('sms1', 'Fail to create new product. Please check your input again!');
            return redirect('/admin/product/create')->withInput();
        }
    }
    public function edit($id)
    {
        $data['product'] = DB::table('products')
            ->where('id', $id)
            ->first();
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        $data['shops'] = DB::table('shops')
            ->where('active', 1)
            ->orderBy('name')
            ->get();

        return view('products.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'category_id' => $r->category,
            'shop_id' => $r->shop,
            'price' => $r->price,
            'sell_price' => $r->sell_price,
            'type' => $r->type,
            'quantity' => $r->quantity,
            'short_description' => $r->short_description,
            'description' => $r->description
        );
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'pro' .$r->id . $ss;
            // upload 350
            $destinationPath = 'uploads/products/featured/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $destinationPath2 = 'uploads/products/featured/500/';
            $new_img2 = Image::make($file->getRealPath())->resize(500, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $new_img2->save($destinationPath2 . $file_name, 80);
            $data['featured_image'] = $file_name;

        }
        $i = DB::table('products')->where('id', $r->id)->update($data);
        if($i)
        {
            $r->session()->flash('sms', 'All changes have been saved!');
            return redirect('/admin/product/edit/'.$r->id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to save changes!');
            return redirect('/admin/product/edit/'.$r->id);
        }
    }
    public function delete($id)
    {
        DB::table('products')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/admin/product?page='.$page);
        }
        return redirect('/admin/product');
    }
}

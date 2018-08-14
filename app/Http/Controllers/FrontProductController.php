<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
class FrontProductController extends Controller
{
    public function product_listing()
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->where('type', 'General')
            ->orderBy('id', 'desc')
            ->paginate(40);
        return view('fronts.products.listing', $data);

    }
    public function baby_listing()
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->where('type', 'Baby')
            ->orderBy('id', 'desc')
            ->paginate(40);
        return view('fronts.products.baby', $data);

    }
    public function product_category($id)
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->where('category_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(40);
        $data['category'] = DB::table('product_categories')->where('id', $id)->first();
        return view('fronts.products.by-category', $data);

    }
    public function baby_category($id)
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->where('category_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(40);
        $data['category'] = DB::table('product_categories')->where('id', $id)->first();
        return view('fronts.products.baby-category', $data);

    }
    public function best_selling()
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->where('best_sell', 1)
            ->orderBy('id', 'desc')
            ->paginate(40);
        return view('fronts.products.best-selling', $data);

    }
    public function discount_store()
    {
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->where('type', 'General')
            ->orderBy('id', 'desc')
            ->paginate(40);
        $data['shop_categories'] = DB::table('shop_categories')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
        $data['shops'] = DB::table('shops')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(30);
        return view('fronts.shops.discount-store', $data);
    }
   
}

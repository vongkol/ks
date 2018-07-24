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
}

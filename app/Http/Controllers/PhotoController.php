<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function delete($id)
    {
        $pid = $_GET['pid'];
        DB::table("product_photos")->where('id', $id)->delete();
        return redirect('/admin/product/detail/'.$pid);
    }
    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'product_id' => $r->product_id
        );
        $i = DB::table('product_photos')->insertGetId($data);
        if($i)
        {
            if($r->hasFile('photo'))
            {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'photo'. $i .'-'.$r->product_id . $ss;
                // upload 350
                $destinationPath = 'uploads/products/';
                $new_img = Image::make($file->getRealPath())->resize(100, null, function ($con) {
                    $con->aspectRatio();
                });
      
                $destinationPath2 = 'uploads/products/500/';
                $new_img2 = Image::make($file->getRealPath())->resize(500, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $file_name, 80);
                $new_img2->save($destinationPath2 . $file_name, 80);
                DB::table('product_photos')->where('id', $i)->update(['photo'=>$file_name]);
            
            }

            $r->session()->flash('sms', 'New photo has been uploaded successfully!');
            return redirect('/admin/product/detail/'.$r->product_id);
        }
        else{
            $r->session()->flash('sms1', 'Fail to upload new photo!');
            return redirect('/admin/product/detail/'.$r->product_id);
        }
    }
}

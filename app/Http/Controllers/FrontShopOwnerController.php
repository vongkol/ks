<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Intervention\Image\ImageManagerStatic as Image;

class FrontShopOwnerController extends Controller
{

    public function index()
    {
        $data['shops'] = DB::table('shops')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(30);
        $data['shop_categories'] = DB::table('shop_categories')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
        return view('fronts.shops.shop-lists', $data);
    }
    public function shop_by_category($id)
    {
        $data['shops'] = DB::table('shops')
            ->where('active', 1)
            ->where('shop_category', $id)
            ->orderBy('id', 'desc')
            ->paginate(30);
        $data['shop_categories'] = DB::table('shop_categories')
            ->where('active', 1)
            ->orderBy('name', 'asc')
            ->get();
        $data['shop_category'] = DB::table('shop_categories')
            ->where('id',$id)
            ->first();
        
        return view('fronts.shops.shop-by-category', $data);
    }
    public function shop_detail($id) {
        $data['shop'] = DB::table('shops')
            ->where('active', 1)
            ->where('id', $id)
            ->first();
        $shop_owner =  $data['shop']->shop_owner;
        $data['shop_owner'] = DB::table('shop_owners')
            ->where('id', $shop_owner)
            ->first();
        $data['shop_categories'] = DB::table('shop_categories')
            ->where('active',1)
            ->get();
        return view('fronts.shops.shop-detail', $data);
    }

    public function register(){
        return view('fronts.owners.register');
    }
    public function do_register(Request $r)
    {
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'email' => $r->email,
            'phone' => $r->phone,
            'username' => $r->username,
            'password' => bcrypt($r->password)
        );
        if($r->post_product)
            $data['post_product'] = 1;
        if($r->post_company)
            $data['post_company'] = 1;
        if($r->post_school)
            $data['post_school'] = 1;
        if($r->post_event)
            $data['post_event'] = 1;
        if($r->post_review)
            $data['post_review'] = 1;
        if($r->post_transfer)
            $data['post_transfer'] = 1;
        $counter = DB::table('shop_owners')
            ->where('username', $r->username)
            ->where('active', 1)
            ->count();
        if($counter>0)
        {
            $r->session()->flash('sms1', "Username is already in used. Please use a different one!");
            return redirect('/shop-owner/register')->withInput();
        }
        else if($r->password!=$r->cpassword)
        {
            $r->session()->flash('sms1', "The password and confirm password is not matched!");
            return redirect('/shop-owner/register')->withInput();
        }
        else{
            $i = DB::table('shop_owners')
                ->insertGetId($data);
            // send email to confirm
            $link = url('/') . "/confirm/".md5($i);
               
            $sms =<<<EOT
                <h2>Sign Up Verification</h2>
                <hr>
                <p>
                    Please click the link below to complete your registration.
                </p>
                <p>
                    <a href="{$link}" target="_blank">{$link}</a>
                </p>
EOT;
                // send email confirmation
                Right::sms($r->email, $sms);
            return view('fronts.owners.confirm');
        }
    }
    public function confirm($id)
    {
        DB::statement("UPDATE shop_owners set is_verified=1, active=1 where md5(id)='{$id}'");
        return redirect('/shop-owner/login');
    }
    public function login(){
        return view('fronts.owners.login');
    }
    public function do_login(Request $r)
    {
        $username = $r->username;
        $pass = $r->password;
        $user = DB::table('shop_owners')->where('username', $username)->first();
        if($user!=null)
        {
            if(password_verify($pass, $user->password) && $user->is_verified==1)
            {
                if($r->session()->get('user')!=NULL)
                {
                    $r->session()->forget('user');
                    $r->session()->flush();
                }
                // save user to session
                $r->session()->put('user', $user);
              
                return redirect('/owner/profile');
            }
            else{
                $r->session()->flash('sms1', "Invalid email or password!");
                return redirect('/shop-owner/login');
            }
        }
        else{
            $r->session()->flash('sms1', "Invalid username or password!");
            return redirect('/shop-owner/login');
        }
    }
    public function profile(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = $user;
        return view('fronts.owners.profile', $data);
    }
    public function edit_profile(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = DB::table('shop_owners')->where('id',$user->id)->first();
        return view('fronts.owners.edit-profile', $data);
    }
    public function update_profile(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            'first_name' => $r->first_name,
            'last_name' => $r->last_name,
            'gender' => $r->gender,
            'email' => $r->email,
            'phone' => $r->phone,
            'address' => $r->address,
            'username' => $r->username
        );
        if($r->post_product){
            $data['post_product'] = 1;
        }
        else{
            $data['post_product'] = 0;
        }   
        if($r->post_company)
        {
            $data['post_company'] = 1;
        }
        else{
            $data['post_company'] = 0;
        }
        if($r->post_school)
        {
            $data['post_school'] = 1;
        }
        else{
            $data['post_school'] = 0;
        }
            
        if($r->post_event)
        {
            $data['post_event'] = 1;
        }
        else{
            $data['post_event'] = 0;
        }
        if($r->post_review)
        {
            $data['post_review'] = 1;
        }
        else{
            $data['post_review'] = 0;
        } 
        if($r->post_transfer)
        {
            $data['post_transfer'] = 1;
        }
        else{
            $data['post_transfer'] = 0;
        }
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'photo'.date('d') .$r->id . $ss;
            $destinationPath = 'uploads/shop_owners/profile/'; 
            $file->move($destinationPath, $file_name);
            $data['photo'] = $file_name;
        }
        $i = DB::table('shop_owners')->where('id', $r->id)->update($data);
        $r->session()->flash('sms', 'Your profile has been updated!');
        return redirect('/owner/profile/edit');
    }
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->flush();
        return redirect('/');
    }
    public function reset(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = DB::table('shop_owners')->where('id',$user->id)->first();
        return view('fronts.owners.reset', $data);
    }
    public function shop(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = DB::table('shop_owners')->where('id',$user->id)->first();
        $data['shop'] = DB::table('shops')
            ->join('shop_categories', 'shops.shop_category', 'shop_categories.id')
            ->where('shops.shop_owner', $user->id)
            ->where('shops.active', 1)
            ->select('shops.*', 'shop_categories.name as cname')
            ->first();
          
            
        return view('fronts.owners.shop', $data);
    }
    public function create_shop(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = DB::table('shop_owners')->where('id',$user->id)->first();
        $data['categories'] = DB::table('shop_categories')->where('active',1)->get();
        return view('fronts.owners.create', $data);
    }
    public function reset_password(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        if($r->pass==$r->cpass)
        {
            $data = array(
                'password' => bcrypt($r->pass)
            );
            $i = DB::table('shop_owners')->where('id', $r->id)->update($data);
            $r->session()->flash('sms', 'Your password has been reset successfully!');
            return redirect('/owner/reset-password');
        }
        else{
            $r->session()->flash('sms1', 'New password and confirm password is not matched!');
            return redirect('/owner/reset-password');
        }

    }
    public function save_shop(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            'name' => $r->name,
            'shop_category' => $r->category,
            'email' => $r->email,
            'phone' => $r->phone,
            'website' => $r->website,
            'address' => $r->address,
            'description' => $r->description,
            'shop_owner' => $user->id
        );
        $i = DB::table('shops')->insertGetId($data);
        if($r->hasFile('logo'))
        {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'logo'.date('d') .$i . $ss;
            $destinationPath = 'uploads/shops/logo/'; 
            $file->move($destinationPath, $file_name);
            DB::table('shops')->where('id', $i)->update(['logo'=>$file_name]);
        }
        if($i)
        {
            return redirect('/owner/shop');
        }
        else{
            $r->session()->flash('sms1', "Fail to create new shop. Please check again!");
            return redirect('/owner/shop/create')->withInput();
        }
    }
    public function edit_shop(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = DB::table('shop_owners')->where('id',$user->id)->first();
        $data['categories'] = DB::table('shop_categories')->where('active',1)->get();
        $data['shop'] = DB::table('shops')->where('id', $r->id)->first();
        return view('fronts.owners.shop-edit', $data);
    }
    public function update_shop(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            'name' => $r->name,
            'shop_category' => $r->category,
            'email' => $r->email,
            'phone' => $r->phone,
            'website' => $r->website,
            'address' => $r->address,
            'description' => $r->description
        );
       
        if($r->hasFile('logo'))
        {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'logo'.date('d') .$r->id . $ss;
            $destinationPath = 'uploads/shops/logo/'; 
            $file->move($destinationPath, $file_name);
            $data['logo'] = $file_name;
        }
        $i = DB::table('shops')->where('id', $r->id)->update($data);
        if($i)
        {
            return redirect('/owner/shop');
        }
        else{
            $r->session()->flash('sms1', "Fail to update shop. Please check again!");
            return redirect('/owner/shop/edit?id='.$r->id)->withInput();
        }
    }
    public function product(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = DB::table('shop_owners')->where('id',$user->id)->first();
        $shop = DB::table('shops')->where('shop_owner', $user->id)->first();
        if($shop==null)
        {
            return redirect('/owner/shop');
        }
        $data['products'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->where('products.active', 1)
            ->where('products.shop_id', $shop->id)
            ->select('products.*', 'product_categories.name as cname')
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('fronts.owners.product', $data);
    }
    public function create_product(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['user'] = DB::table('shop_owners')->where('id',$user->id)->first();
        $shop = DB::table('shops')->where('shop_owner', $user->id)->first();
        if($shop==null)
        {
            return redirect('/owner/shop');
        }
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.create-product', $data);
    }
    public function save_product(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $shop = DB::table('shops')->where('shop_owner', $user->id)->first();
        $data = array(
            'name' => $r->name,
            'category_id' => $r->category,
            'shop_id' => $shop->id,
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
            return redirect('/owner/product/create');
        }
    }
    public function delete_product(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('products')->where('id', $r->id)->delete();
        return redirect('/owner/product');
    }
    public function edit_product(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['product'] = DB::table('products')
            ->where('id', $r->id)
            ->first();
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.edit-product', $data);
    }
    public function update_product(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $shop = DB::table('shops')->where('shop_owner', $user->id)->first();
        $data = array(
            'name' => $r->name,
            'category_id' => $r->category,
            'shop_id' => $shop->id,
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
            $file_name = 'pro34xrwe' .$r->id . $ss;
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
        $i = DB::table('products')
            ->where('id', $r->id)
            ->update($data);
        $r->session()->flash('sms', 'All changes have been saved successfully!');
        return redirect('/owner/product/edit?id='.$r->id);
    }
    public function business_transfer(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['transfers'] = DB::table('business_transfers')
            ->join('transfers_categories', 'business_transfers.category_id', 'transfers_categories.id')
            ->where('business_transfers.owner_id', $user->id)
            ->where('business_transfers.active', 1)
            ->orderBy('business_transfers.id', 'desc')
            ->select('business_transfers.*', 'transfers_categories.name')
            ->get();
        return view('fronts.owners.business', $data);
    }
    public function create_business(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['categories'] = DB::table('transfers_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.create-business', $data);
    }
    public function save_business(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

        $data = array(
            "title" => $r->title,
            "category_id" => $r->category,
            "short_description" => $r->short_description,
            "owner_id" => $user->id,
            "description" => $r->description,
        );
        $i = DB::table('business_transfers')->insertGetId($data);
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/business_transfers/'; // usually in public folder
            $file->move($destinationPath, $i.$file_name);
            $data['featured_image'] = $i.$file_name;
          
            $i = DB::table('business_transfers')->where('id', $i)->update($data);
        }
        if ($i)
        {
            $r->session()->flash("sms", "New business transfer has been created successfully!");
            return redirect("/owner/business/create");
        }
        else
        {
            $r->session()->flash("sms1", "Fail to create new event business transfer!");
            return redirect("/owner/business/create")->withInput();
        }
    }
    public function edit_business(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['business'] = DB::table('business_transfers')
            ->where('id', $r->id)
            ->first();
        $data['categories'] = DB::table('transfers_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.edit-business', $data);
    }
    public function update_business(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

        $data = array(
            "title" => $r->title,
            "category_id" => $r->category,
            "short_description" => $r->short_description,
            "owner_id" => $user->id,
            "description" => $r->description,
        );
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/business_transfers/'; // usually in public folder
            $file->move($destinationPath, $r->id .$file_name);
            $file_name = $r->id .$file_name;
          
            $data['featured_image'] = $file_name;
        }
        $i = DB::table('business_transfers')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "New business transfer has been created successfully!");
            return redirect("/owner/business/edit?id=".$r->id);
        }
        else
        {
            $r->session()->flash("sms1", "Fail to create new event business transfer!");
            return redirect("/owner/business/edit?id=".$r->id);
        }
    }
    public function delete_business(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('business_transfers')->where('id', $r->id)->update(["active"=>0]);
        return redirect('/owner/business-transfer');
    }
}

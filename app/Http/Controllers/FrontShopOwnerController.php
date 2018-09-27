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

    public function event(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['events'] = DB::table('events')
            ->join('event_categories', 'events.event_category', 'event_categories.id')
            ->where('events.owner_id', $user->id)
            ->where('events.active', 1)
            ->orderBy('events.id', 'desc')
            ->select('events.*', 'event_categories.name as cname')
            ->paginate(20);
        return view('fronts.owners.event', $data);
    }
    public function create_event(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['categories'] = DB::table('event_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.create-event', $data);
    }
    public function save_event(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

        $data = array(
            "title" => $r->title,
            "location" => $r->location,
            "event_date" => $r->event_date,
            "description" => $r->description,
            "event_category" => $r->category,
            "featured_image" => $r->featured_image,
            "event_organizor" => $r->event_organizor,
            "start_time" => $r->start_time,
            "end_time" => $r->end_time,
            "map" => $r->map,
            "price" => $r->price,
            "register_link" => $r->register_link,
            "owner_id" => $user->id,
        );
        $i = DB::table('events')->insertGetId($data);
        if($r->hasFile('featured_image'))
        {
            
            $file = $r->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'event' .$i . $ss;
            // upload 350
            $destinationPath = 'uploads/events/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/events/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
            DB::table('events')->where('id', $i)->update(['featured_image'=>$file_name]);
        }
      
        if ($i)
        {
            $r->session()->flash("sms", "New event has been created successfully!");
            return redirect("/owner/event/create");
        } else {
            $r->session()->flash("sms1", "Fail to create new event!");
            return redirect("/owner/event/create")->withInput();
        }  
    }
    public function edit_event(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['event'] = DB::table('events')
            ->where('id', $r->id)
            ->first();
        $data['categories'] = DB::table('event_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.edit-event', $data);
    }
    public function update_event(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

       
        $data = array(
            "title" => $r->title,
            "location" => $r->location,
            "event_date" => $r->event_date,
            "description" => $r->description,
            "event_category" => $r->category,
            "featured_image" => $r->featured_image,
            "event_organizor" => $r->event_organizor,
            "start_time" => $r->start_time,
            "end_time" => $r->end_time,
            "map" => $r->map,
            "price" => $r->price,
            "register_link" => $r->register_link,
            "owner_id" => $user->id,
        );

        if($r->hasFile('featured_image'))
        {
            
            $file = $r->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'event' .$r->id . $ss;
            // upload 350
            $destinationPath = 'uploads/events/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/events/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
        }
      
        $i = DB::table('events')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/owner/event/edit/".$r->id);
        }
        else
        {
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/owner/event/edit/".$r->id);
        }
    }
    public function delete_event(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('events')->where('id', $r->id)->update(["active"=>0]);
        return redirect('/owner/event');
    }

    public function create_school(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['categories'] = DB::table('school_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.create-school', $data);
    }
    public function save_school(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

        $data = array(
            "name_khmer" => $request->name_khmer,
            "name_english" => $request->name_english,
            "address" => $request->address,
            "phone" => $request->phone,
            "email" => $request->email,
            "profile" => $request->profile,
            "school_category" => $request->category,
            "owner_id" => $user->id,
        );
        $i = DB::table('schools')->insertGetId($data);
        if($i)
        {
            if($request->hasFile('logo'))
            {
                $file = $request->file('logo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'school' .$i . $ss;
                // upload 150 
                $destinationPath = 'uploads/schools/logo/';
                $new_img = Image::make($file->getRealPath())->resize(150, null, function ($con) {
                    $con->aspectRatio();
                });
               
                $new_img->save($destinationPath . $file_name, 80);

                DB::table('schools')->where('id', $i)->update(['logo'=>$file_name]);
            
            }

            $request->session()->flash('sms', 'New school has been create successfully!');
            return redirect('/owner/school/create');
        }
        else{
            $request->session()->flash('sms1', 'Fail to create new school. Please check your input again!');
            return redirect('/owner/school/create')->withInput();
        }
    }
    public function edit_school(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['school'] = DB::table('schools')
            ->where('id', $r->id)
            ->first();
        $data['categories'] = DB::table('school_categories')
            ->where('active', 1)
            ->orderBy('name')
            ->get();
        return view('fronts.owners.edit-school', $data);
    }
    public function update_school(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            "name_khmer" => $r->name_khmer,
            "name_english" => $r->name_english,
            "address" => $r->address,
            "phone" => $r->phone,
            "email" => $r->email,
            "profile" => $r->profile,
            "school_category" => $r->category,
            "owner_id" => $user->id,
        );

        if($r->hasFile('logo'))
        {
            
            $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'school' .$r->id . $ss;
            // upload 150 
            $destinationPath = 'uploads/schools/logo/';
            $new_img = Image::make($file->getRealPath())->resize(150, null, function ($con) {
                $con->aspectRatio();
            });
            
            $new_img->save($destinationPath . $file_name, 80);
            $data['logo'] = $file_name;
        }
      
        $i = DB::table('schools')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/owner/school/edit/".$r->id);
        }
        else
        {
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/owner/school/edit/".$r->id);
        }
    }
    public function delete_school(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('schools')->where('id', $r->id)->update(["active"=>0]);
        return redirect('/owner/school');
    }
    public function school(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['schools'] = DB::table('schools')
            ->join('school_categories', 'schools.school_category', 'school_categories.id')
            ->where('schools.owner_id', $user->id)
            ->where('schools.active', 1)
            ->orderBy('schools.id', 'desc')
            ->select('schools.*', 'school_categories.name as cname')
            ->paginate(20);
        return view('fronts.owners.school', $data);
    }
    
    public function create_scholaship(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['schools'] = DB::table('schools')
            ->orderBy('name_khmer', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('scholarship_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.create-scholarship', $data);
    }
    public function save_scholaship(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

        $data = array(
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school,
            "scholarship_category" => $request->category,
            "owner_id" => $user->id,
        );
        $i = DB::table('scholarships')->insertGetId($data);
        
      
            if($file = $request->file('featured_image')) {
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'scholarship' .$i . $ss;
            // upload 350
            $destinationPath = 'uploads/scholarships/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/scholarships/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
            
            DB::table('scholarships')->where('id', $i)->update(['featured_image'=>$file_name]);
            }
        
        if($i)
        {
        $request->session()->flash("sms", "New scholarship has been created successfully!");
        return redirect("/owner/scholarship/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new scholarship!");
            return redirect("/owner/scholarship/create")->withInput();
        }
    }
    public function edit_scholaship(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['scholarship'] = DB::table('scholarships')
            ->where('id', $r->id)
            ->first();
            $data['schools'] = DB::table('schools')
            ->orderBy('name_khmer', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('scholarship_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.edit-scholarship', $data);
    }
    public function update_scholaship(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school,
            "scholarship_category" => $request->category,
            "owner_id" => $user->id
        );
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'scholarship' .$request->id . $ss;
            // upload 350
            $destinationPath = 'uploads/scholarships/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/scholarships/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);

            $data['featured_image'] = $file_name;
        }

        $i = DB::table('scholarships')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/owner/scholarship/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/owner/scholarship/edit/". $request->id);
        }
    }
    public function delete_scholaship(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('scholarships')->where('id', $r->id)->update(["active"=>0]);
        return redirect('/owner/scholarship');
    }
    public function scholaship(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['scholarships'] = DB::table('scholarships')
            ->join('scholarship_categories', 'scholarships.scholarship_category', 'scholarship_categories.id')
            ->join('schools', 'schools.id', 'scholarships.school_id')
            ->where('scholarships.owner_id', $user->id)
            ->where('scholarships.active', 1)
            ->orderBy('scholarships.id', 'desc')
            ->select('scholarships.*', 'scholarship_categories.name as cname', 'schools.name_english as sname')
            ->paginate(20);
        return view('fronts.owners.scholarships', $data);
    }

    public function create_school_program(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['schools'] = DB::table('schools')
            ->orderBy('name_khmer', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('program_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.create-school-program', $data);
    }
    public function save_school_program(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school,
            "program_category" => $request->category,
            "owner_id" => $user->id,
        );
        $i = DB::table('school_programs')->insertGetId($data);
            if($file = $request->file('featured_image')) {
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'school_program' .$i . $ss;
            // upload 350
            $destinationPath = 'uploads/school_programs/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/school_programs/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
            
            DB::table('school_programs')->where('id', $i)->update(['featured_image'=>$file_name]);
            }
        
        if($i)
        {
        $request->session()->flash("sms", "New scholarship has been created successfully!");
        return redirect("/owner/scholarship/create");
        } else {
            $request->session()->flash("sms1", "Fail to create new scholarship!");
            return redirect("/owner/scholarship/create")->withInput();
        }
    }
    public function edit_school_program(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['school_program'] = DB::table('school_programs')
            ->where('id', $r->id)
            ->first();
        $data['schools'] = DB::table('schools')
            ->orderBy('name_khmer', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('program_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.edit-school-program', $data);
    }
    public function update_school_program(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            "title" => $request->title,
            "description" => $request->description,
            "school_id" => $request->school,
            "program_category" => $request->category,
            "owner_id" => $user->id
        );
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'school_program' .$request->id . $ss;
            // upload 350
            $destinationPath = 'uploads/school_programs/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/school_programs/featured_image/';
            $new_img = Image::make($file->getRealPath())->resize(1200,600);
            $new_img->save($destinationPath . $file_name, 80);

            $data['featured_image'] = $file_name;
        }

        $i = DB::table('school_programs')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/owner/school-program/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/owner/school-program/edit/". $request->id);
        }
    }
    public function delete_school_program(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('school_programs')->where('id', $r->id)->update(["active"=>0]);
        return redirect('/owner/school-program');
    }
    public function school_program(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        
       // select self join company categories
       $data['school_programs'] = DB::table('school_programs')
       ->join('schools', 'school_programs.school_id', 'schools.id')
       ->join('program_categories', 'school_programs.program_category', 'program_categories.id')
       ->select('school_programs.*', 'schools.name_english as sname', 'program_categories.name as cname')
       ->orderBy('school_programs.id', 'desc')
       ->where('school_programs.active', 1)
       ->where('school_programs.owner_id', $user->id)
       ->paginate(20);
        return view('fronts.owners.school-program', $data);
    }

    public function create_company(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['business_types'] = DB::table('business_types')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('company_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.create-company', $data);
    }
    public function save_company(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            "name" => $request->name,
            "business_type" => $request->business_type,
            "address" => $request->address,
            "office_phone" => $request->office_phone,
            "office_email" => $request->office_email,
            "profile" => $request->profile,
            "website" => $request->website,
            'category_id' => $request->category,
            "owner_id" => $user->id
        );
        $i = DB::table('companies')->insertGetId($data);
        if($request->hasFile('logo'))
        {
            $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/companies/logo/'; // usually in public folder
            $file->move($destinationPath, $i.$file_name);
            $data['logo'] = $i.$file_name;
          
            $i = DB::table('companies')->where('id', $i)->update($data);
        }
        if ($i)
        {
            $request->session()->flash("sms", "New Company has been created successfully!");
            return redirect("/owner/company/create");
        }
        else
        {
            $request->session()->flash("sms1", "Fail to create new event Company!");
            return redirect("/owner/company/create")->withInput();
        }
    }
    public function edit_company(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['company'] = DB::table('companies')
            ->where('id', $r->id)
            ->first();
        $data['business_types'] = DB::table('business_types')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
        $data['categories'] = DB::table('company_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.edit-company', $data);
    }
    public function update_company(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data = array(
            "name" => $request->name,
            "business_type" => $request->business_type,
            "address" => $request->address,
            "office_phone" => $request->office_phone,
            "office_email" => $request->office_email,
            "profile" => $request->profile,
            "website" => $request->website,
            'category_id' => $request->category,
        );
        if($request->hasFile('logo'))
        { $file = $request->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/companies/logo/'; // usually in public folder
            $file->move($destinationPath, $request->id.$file_name);
            $data['logo'] = $request->id.$file_name;
        }

        $i = DB::table('companies')->where("id", $request->id)->update($data);
        if($i)
        {
            $request->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/owner/company/edit/". $request->id);
        } else {
            $request->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/owner/company/edit/". $request->id);
        }
    }
    public function delete_company(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('companies')->where('id', $r->id)->update(["active"=>0]);
        return redirect('/owner/company');
    }
    public function company(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        
        $data['companies'] = DB::table("companies")
            ->where('active',1)
            ->where('owner_id', $user->id)
            ->orderBy('id', 'desc')
            ->paginate(12);
            
        return view('fronts.owners.company', $data);
    }

    public function review(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['reviews'] = DB::table('reviews')
            ->join('review_categories', 'reviews.category_id', 'review_categories.id')
            ->where('reviews.review_by', $user->id)
            ->where('reviews.active', 1)
            ->orderBy('reviews.id', 'desc')
            ->select('reviews.*', 'review_categories.name as cname')
            ->paginate(20);
        return view('fronts.owners.review', $data);
    }

    public function create_review(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['categories'] = DB::table('review_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.create-review', $data);
    }

    public function save_review(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

        $data = array(
            "title" => $request->title,
            "description1" => $request->description1,
            "description2" => $request->description2,
            "category_id" => $request->category,
            "review_by" => $user->id
        );
        $i = DB::table('reviews')->insertGetId($data);
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'review' .$i . $ss;
            // dd($file_name);
            // upload 350
            $destinationPath = 'uploads/reviews/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/reviews/';
            $new_img =  Image::make($file->getRealPath())->resize(1200, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $data['featured_image'] = $file_name;
        }
        $i = DB::table('reviews')->where('id', $i)->update($data);
        if ($i)
        {
            $request->session()->flash("sms", "New reviews has been created successfully!");
            return redirect("/owner/review/create");
        }
        else
        {
            $request->session()->flash("sms1", "Fail to create new reviews!");
            return redirect("/owner/review/create")->withInput();
        }
    }
    public function delete_review(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        DB::table('reviews')->where('id', $r->id)->update(["active"=>0]);
        return redirect('/owner/review');
    }
    public function edit_review(Request $r)
    {
        $user = $r->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }
        $data['review'] = DB::table('reviews')
            ->where('id', $r->id)
            ->first();
        $data['categories'] = DB::table('review_categories')
            ->orderBy('name')
            ->where('active',1)
            ->get();
        return view('fronts.owners.edit-review', $data);
    }

    public function update_review(Request $request)
    {
        $user = $request->session()->get('user');
        if($user==null)
        {
            return redirect('/shop-owner/login');
        }

        $data = array(
            "title" => $request->title,
            "description1" => $request->description1,
            "description2" => $request->description2,
            "category_id" => $request->category,
            "review_by" => $user->id
        );
        if($request->hasFile('featured_image'))
        {
            $file = $request->file('featured_image');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'review' .$request->id . $ss;
            // upload 350
            $destinationPath = 'uploads/reviews/featured_image/small/';
            $new_img = Image::make($file->getRealPath())->resize(350, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $destinationPath = 'uploads/reviews/';
            $new_img =  Image::make($file->getRealPath())->resize(1200, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);

            $data['featured_image'] = $file_name;
        }
        $i = DB::table('reviews')->where('id', $request->id)->update($data);
        if ($i)
        {
            $request->session()->flash("sms", "New reviews has been created successfully!");
            return redirect("/owner/review/edit/".$request->id);
        }
        else
        {
            $request->session()->flash("sms1", "Fail to create new reviews!");
            return redirect("/owner/review/create/".$request->id);
        }
    }
}

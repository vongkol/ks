<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontController extends Controller
{

    public function index()
    {
        $data['categories'] = DB::table('product_categories')
            ->where('active', 1)
            ->where('parent_id', 0)
            ->orderBy('name')
            ->limit(12)
            ->get();
        $data['products'] = DB::table('products')
            ->where('active', 1)
            ->where('type', 'General')
            ->orderBy('id', 'desc')
            ->limit(16)
            ->get();
        $data['baby'] = DB::table('products')
            ->where('active', 1)
            ->where('type', 'Baby')
            ->orderBy('id', 'desc')
            ->limit(16)
            ->get();
        $data['events'] = DB::table('events')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->limit(16)
            ->get();
        $data['scholarships'] = DB::table('scholarships')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->limit(16)
            ->get();
        $data['schools'] = DB::table('schools')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->limit(12)
            ->get();
        return view('fronts.index', $data);
    }

    public function login(){
        return view('fronts.owners.login');
    }

    public function product_list(){
        return view('product-list');
    }

    public function product_single(){
        return view('product-single');
    }

    public function cart(){
        return view('cart');
    }

    public function checkout(){
        return view('checkout');
    }
    public function contact(){
        return view('contact');
    }
    public function about(){
        return view('about');
    }
    public function school_detail($id)
    {
        $data['school'] = DB::table("schools")
            ->where("id", $id)
            ->first();
        $data['school_categories'] = DB::table('school_categories')
            ->orderBy('name', 'asc')
            ->where('active',1)
            ->get();
    return view("fronts.schools.school-detail", $data);

    }
    public function school_all(){
        $data['school_categories'] = DB::table('school_categories')
            ->where('active',1)
            ->orderBy('name', 'asc')
            ->get();

        $data['schools'] = DB::table('schools')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(30);
        return view('fronts.schools.school-all', $data);
    }
    // public function scholarship(){
    //     return view('scholarships');
    // }
    public function company_category(){
        $al = $_GET['al'];
        if($al=='All')
        {
            $data['company_categories'] = DB::table('company_categories')
                ->where('active',1)
                ->orderBy('name', 'asc')
                ->paginate(50);
        }
        else{
            $data['company_categories'] = DB::table('company_categories')
                ->where('active',1)
                ->where('name', 'like', "{$al}%")
                ->orderBy('name', 'asc')
                ->paginate(50);
        }
        $data['al'] = $al;
        return view('fronts.companies.company-categories', $data);
    }
    public function company_list($id){
        $data['companies'] = DB::table('companies')
            ->where('active',1)
            ->where('category_id', $id)
            ->orderBy('name', 'asc')
            ->paginate(30);
        $data['company_category'] = DB::table('company_categories')
            ->where('id', $id)
            ->where('active',1)
            ->first();
        return view('fronts.companies.company-list', $data);
    }
    public function school_by_category($id)
    {
        $data['school_categories'] = DB::table('school_categories')
            ->where('active',1)
            ->orderBy('name', 'asc')
            ->get();
        $data['school_category'] = DB::table('school_categories')
            ->where('id',$id)
            ->first();
        $data['schools'] = DB::table('schools')
            ->where('active',1)
            ->where('school_category', $id)
            ->orderBy('id', 'desc')
            ->paginate(30);
        return view('fronts.schools.school-list', $data);
    }
    public function company_detail($id){
        $data['company'] = DB::table('companies')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        $business_id = $data['company']->business_type;
        $data['business_type'] = DB::table('business_types')
            ->where('id', $business_id)
            ->where('active',1)
            ->first();
        return view('fronts.companies.company-detail', $data);
    }
    public function event_all(){
        $data['event_categories'] = DB::table('event_categories')
            ->where('active',1)
            ->where('parent_id', 0)
            ->orderBy('name', 'asc')
            ->get();
    
        $data['events'] = DB::table('events')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(16);
        return view('fronts.events.event-categories', $data);
    }
    public function event_list($id){
        $data['event_categories'] = DB::table('event_categories')
            ->where('active',1)
            ->where('parent_id', 0)
            ->orderBy('name', 'asc')
            ->get();
        $data['events'] = DB::table('events')
            ->where('active',1)
            ->where('event_category', $id)
            ->orderBy('id', 'desc')
            ->paginate(30);
        $data['event_category'] = DB::table('event_categories')
            ->where('id', $id)
            ->where('active',1)
            ->first();
        return view('fronts.events.event-list', $data);
    }
    public function event_detail($id){
        $data['event'] = DB::table('events')
            ->where('active',1)
            ->where('id', $id)
            ->first();
        $data['event_categories'] = DB::table('event_categories')
            ->where('active',1)
            ->where('parent_id', 0)
            ->orderBy('name', 'asc')
            ->get();
        return view('fronts.events.event-detail', $data);
    }
    // load school program
    public function school_program()
    {
        $data['programs'] = DB::table('school_programs')
            ->join('schools', "school_programs.school_id", "schools.id")
            ->where('school_programs.active', 1)
            ->orderBy('school_programs.id', 'desc')
            ->select('school_programs.*', 'schools.name_english')
            ->paginate(30);

        return view('fronts.programs.index', $data);
    }
    public function program_detail($id)
    {
        $data['program'] = DB::table('school_programs')
            ->join('schools', 'school_programs.school_id', 'schools.id')
            ->join('program_categories', 'school_programs.program_category', 'program_categories.id')
            ->where('school_programs.id', $id)
            ->select('school_programs.*', 'schools.name_khmer as name1', 'schools.name_english as name2', 'schools.id as s_id','program_categories.name as cat_name')
            ->first();
        return view('fronts.programs.detail', $data);
    }
    // school program by category
    public function program_category($id)
    {
        $data['programs'] = DB::table('school_programs')
            ->join('schools', "school_programs.school_id", "schools.id")
            ->where('school_programs.active', 1)
            ->where('school_programs.program_category', $id)
            ->orderBy('school_programs.id', 'desc')
            ->select('school_programs.*', 'schools.name_english')
            ->paginate(30);
        return view('fronts.programs.by-category', $data);
    }

    // load review
    public function review()
    {
        $data['reviews'] = DB::table('reviews')
            ->join('review_categories', "reviews.category_id", "review_categories.id")
            ->where('reviews.active', 1)
            ->orderBy('reviews.id', 'desc')
            ->select('reviews.*', 'review_categories.name')
            ->paginate(30);
        return view('fronts.reviews.index', $data);
    }
    public function review_detail($id)
    {
        $data['review'] = DB::table('reviews')
            ->join('review_categories', 'reviews.category_id', 'review_categories.id')
            ->where('reviews.id', $id)
            ->select('reviews.*', 'review_categories.name')
            ->first();

        return view('fronts.reviews.detail', $data);
    }
    public function review_category($id)
    {
        $data['reviews'] = DB::table('reviews')
            ->join('review_categories', "reviews.category_id", "review_categories.id")
            ->where('reviews.active', 1)
            ->where('reviews.category_id', $id)
            ->orderBy('reviews.id', 'desc')
            ->select('reviews.*', 'review_categories.name')
            ->paginate(30);
        return view('fronts.reviews.by-category', $data);
    }
    // scholarship
    public function scholarship()
    {
        $data['scholarships'] = DB::table('scholarships')
            ->leftJoin('schools', 'scholarships.school_id', 'schools.id')
            ->where('scholarships.active', 1)
            ->orderBy('scholarships.id', 'desc')
            ->select('scholarships.*', 'schools.name_english')
            ->paginate(30);
        return view('fronts.scholarships.index', $data);
    }

    public function scholarship_detail($id)
    {
        $data['sch'] = DB::table('scholarships')
            ->leftJoin('schools', 'scholarships.school_id', 'schools.id')
            ->leftJoin('scholarship_categories', 'scholarships.scholarship_category', 'scholarship_categories.id')
            ->where('scholarships.id', $id)
            ->select('scholarships.*', 'schools.id as s_id', 'schools.name_english as name1', 'schools.name_khmer as name2', 'scholarship_categories.name')
            ->first();
        return view('fronts.scholarships.detail', $data);
    }
    public function scholarship_category($id)
    {
        $data['scholarships'] = DB::table('scholarships')
            ->leftJoin('schools', 'scholarships.school_id', 'schools.id')
            ->where('scholarships.active', 1)
            ->where('scholarships.scholarship_category', $id)
            ->orderBy('scholarships.id', 'desc')
            ->select('scholarships.*', 'schools.name_english')
            ->paginate(30);
        return view('fronts.scholarships.by-category', $data);
    }

    public function product_detail($id) {
        $data['product'] = DB::table('products')
            ->join('product_categories', 'products.category_id', 'product_categories.id')
            ->join('shops', 'products.shop_id', 'shops.id')
            ->where('products.id', $id)
            ->select('products.*', 'product_categories.name as cname', 'shops.name as sname')
            ->first();
        $data['photos'] = DB::table('product_photos')
            ->where('product_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return view('fronts.products.detail', $data);
    }
    public function business_transfer()
    {
        $data['transfers'] = DB::table('business_transfers')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(40);
        return view('fronts.shops.transfer', $data);
    }
}

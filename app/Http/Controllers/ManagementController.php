<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view("home");
    }
    public function product()
    {
        return view("products.home");
    }
    public function school()
    {
        return view("schools.home");
    }
    public function career()
    {
        return view("careers.index");
    }
    public function customer()
    {
        return view("customers.index");
    }
    public function company()
    {
        return view('companies.home');
    }
    public function event()
    {
        return view('events.home');
    }
}

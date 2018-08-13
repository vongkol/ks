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
        return view('transfers.index');
    }

}

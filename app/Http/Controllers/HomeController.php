<?php

namespace App\Http\Controllers;

use App\Copmpany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = DB::table('companies')
                    ->where('user_id', '=', auth()->user()->id)->get();
        return view('home')->with('companies', $companies);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track_record;



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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard.user');
    }
    public function adminHome()
    {

        $data['tracks'] = Track_record::all(); 
        return view('dashboard.admin',$data);
    }

}

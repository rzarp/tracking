<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track_record;

class TrackController extends Controller
{
    public function index () {
        return Track_record::all();
    }
    
}

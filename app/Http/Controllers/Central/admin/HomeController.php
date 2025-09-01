<?php

namespace App\Http\Controllers\Central\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('central.admin.index');
    }

}

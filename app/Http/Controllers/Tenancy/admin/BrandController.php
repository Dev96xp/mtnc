<?php

namespace App\Http\Controllers\Tenancy\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('tenancy.admin.brand.index');
    }
}

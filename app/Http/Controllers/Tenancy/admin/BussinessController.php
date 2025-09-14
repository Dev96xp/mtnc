<?php

namespace App\Http\Controllers\Tenancy\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BussinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tenancy.admin.business.index');
    }

}

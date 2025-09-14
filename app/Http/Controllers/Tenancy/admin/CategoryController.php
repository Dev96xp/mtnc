<?php

namespace App\Http\Controllers\Tenancy\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tenancy.admin.category.index');
    }

}

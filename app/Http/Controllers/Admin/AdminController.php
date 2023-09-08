<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // go to resource --> view -->admin -->index
        
        return view ('admin.index');
    }
}

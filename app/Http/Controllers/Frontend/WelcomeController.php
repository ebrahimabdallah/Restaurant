<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $Special=Category::where('name','Special')->first();
        return view('welcome',compact('Special'));
    }
    public function Message()
    {
        return view('Client.Message.Message');
    }
}

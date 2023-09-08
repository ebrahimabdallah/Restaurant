<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category=Category::all();
        return view ('Client.Categories.index',compact('category'));
    }
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('Client.Categories.show', compact('category'));
    }
}

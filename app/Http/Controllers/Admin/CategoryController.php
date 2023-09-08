<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use App\Models\Menu;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.Category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        // Store the image and save it in the public storage folder
       
        $image=$request->file('image');
        $img_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->image->move(public_path('images/categories'),$img_name);
        $img_url = 'images/categories/' . $img_name;       
       
        Category::insert([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $img_url
        ]);
    
        return redirect()->route('admin.Category.index')->with('success','Add Category Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('admin.Category.edit', compact('categories'));
    }
    
    // use Illuminate\Validation\Rule;

    public function update(Request $request,$id)
{
    

        $categories = Category::findOrFail($id);
    
        // Get the current image path
        $imagePath = $categories->image;
    
        if ($request->hasFile('image')) {
            // Delete the current image from the public folder
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
    
            // Upload the new image to the public folder
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories'), $imageName);
    
            // Set the new image path
            $imagePath = 'images/categories/' . $imageName;
        }
    
        
    
        $categories->update([
           'name' => $request->name,
           'description' => $request->description,
           'image' => $imagePath,
        ]);
    
        return redirect()->route('admin.Category.index')->with('success','Update Category Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

       //delete image exists in public 
       
       if ($category->image) {
            $imagePath = public_path($category->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete related menu items
        $category->menus()->detach();
        $category->delete();

        return redirect()->back()->with('danger', 'Delete Category Done');
    }
}

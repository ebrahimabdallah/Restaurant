<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Enums\TableLocation;
use App\Enums\TableStatus;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $menus=Menu::all();
        return view('admin.Menu.index',compact('menus'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $categories=Category::all();

        return view('admin.Menu.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(MenuStoreRequest $request) 
    {
     
//   Image upload
      $image = $request->file('image');
      $imageName = time().'.'.$image->getClientOriginalExtension();

       $image=$request->file('image');
        $img_name=hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        $request->image->move(public_path('images/menu'),$img_name);
        $img_url = 'images/menu/' . $img_name;       
       
  // Create menu
     $menus = Menu::create([
    'name' => $request->name,
    'description' => $request->description,
    'price' => $request->price, 
    'image' => $img_url,
  ]);


if($request->has('categories'))
{
    $menus->categories()->attach($request->categories);
}

  // Redirect with success message
  return redirect()
    ->route('admin.Menu.index')
    ->with('success', 'Menu created successfully!')->with('success','Add Menu Successfully');


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu=Menu::findOrFail($id);
        $categories=Category::all();

        return view('admin.Menu.edit',compact('menu','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        $menu = Menu::findOrFail($id);
    
        // Get the current image path
        $imagePath = $menu->image;
    
        if ($request->hasFile('image')) {
            // Delete the current image from the public folder
            if (file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
    
            // Upload the new image to the public folder
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/menu'), $imageName);
    
            // Set the new image path
            $imagePath = 'images/menu/' . $imageName;
        }
    
        $menu->update([
           'name' => $request->name,
           'price' => $request->price,
           'description' => $request->description,
           'image' => $imagePath,
        ]);
        if($request->has('categories'))
        {
            $menu->categories()->sync($request->categories);
        }
        return redirect()->route('admin.Menu.index')->with('success','Update Menu Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
       return redirect()->back()->with('danger','Delete Category Done');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TableRequest;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function index()
    {
        // Retrieve all tables from the database
        $tables = Table::all();

        // Return the index view with the table data
        return view('admin.Table.index', compact('tables'));
    }

    public function create()
    {
        // Return the create view to add a new table
        return view('admin.Table.create');
    }

    public function store(TableRequest $request)
    {
        // Validate the incoming request data
       

        // Create a new table record in the database
        Table::create([
            'name'=>$request->name,
            'gust_number'=>$request->gust_number,
            'location'=>$request->location,
            'stutas'=>$request->stutas
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('admin.Table.index')->with('success', 'Table created successfully');
    }

    public function edit($id)
    {
        $table=Table::findOrFail($id);
        // Return the edit view with the specified table record
        return view('admin.Table.edit', compact('table'));
    }

    public function update(Request $request, $id)
    {
        $table=Table::findOrFail($id);

        // Validate the incoming request data
      

        // Update the table record in the database
        $table->update([
            'name'=>$request->name,
            'gust_number'=>$request->gust_number,
            'location'=>$request->location,
            'stutas'=>$request->stutas

        ]);

        // Redirect to the index page with a success message
        return redirect()->route('admin.Table.index')->with('success', 'Table updated successfully');
    }

    public function destroy($id)
    {
        $table=Table::findOrFail($id);

        // Delete the specified table record from the database
        $table->delete();

        // Redirect to the index page with a success message
        return redirect()->route('admin.Table.index')->with('success', 'Table deleted successfully');
    }
}
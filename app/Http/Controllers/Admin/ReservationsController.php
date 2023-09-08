<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReservationRequest;
use App\Models\Reservations;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Reservations=Reservations::all();
        return view('admin.Reservation.index',compact('Reservations'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $table=Table::where('stutas','available')->get();
        return view('admin.Reservation.create',compact('table'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
     */
    public function store(ReservationRequest $request)
    {
        $table = Table::findOrFail($request->table_id);

        $tableCapacity = $table->gust_number;
        $requestedGuests = $request->gust_number;
        
        if($requestedGuests > $tableCapacity) {
        
          return back()->with('warning', 'Table capacity exceeded. Please choose fewer guests.'); 
        
        }
        $request_date = Carbon::parse($request->res_data);
        foreach ($table->reservation as $res) {
            if ($res->res_data->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return back()->with('warning', 'The Time is Packed.');
            }
        }
        // Continue reservation process...
       Reservations::create([
      'firstname' => $request->firstname,
      'lastname' => $request->lastname,
      'tel_number' => $request->tel_number, 
      'email' => $request->email,
      'res_data' => $request->res_data,
      'table_id' => $request->table_id, 
      'gust_number' => $request->gust_number,
 
    ]);
  return redirect()->route('admin.Reservation.index')->with('success','Successfully created ');
    }

    

 
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response

    public function edit($id)
    {
        $Reservation=Reservations::findOrFail($id);
        $table=Table::where('stutas','available')->get();
        return view('admin.Reservation.edit',compact('Reservation','table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function update(ReservationRequest $request, $id)
    {
        $table = Table::findOrFail($request->table_id);
        $tableCapacity = $table->gust_number;
        $requestedGuests = $request->gust_number;
         
        if ($requestedGuests > $tableCapacity) {
            return back()->with('warning', 'Table capacity exceeded. Please choose fewer guests.');
        }
        
        $request_date = Carbon::parse($request->res_data);
        $existingReservations = $table->Reservation()->where('id', '!=', $id)->get();
        
        foreach ($existingReservations as $reservation) {
            if ($reservation->res_data->format('Y-m-d') == $request_date->format('Y-m-d')) {
                return back()->with('warning', 'The time slot is already booked.');
            }
        }
        
        $reservation = Reservations::findOrFail($id);
    
        $reservation->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'tel_number' => $request->tel_number,
            'email' => $request->email,
            'res_data' => $request_date,
            'table_id' => $request->table_id,
            'gust_number' => $request->gust_number,
        ]);
    
        return redirect()->route('admin.Reservation.index')->with('success', 'Reservation updated successfully');
    }
    
 
      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservations::findOrFail($id)->delete();
        return redirect()->back()->with('danger','delete Reservation Successfully');

    }
}

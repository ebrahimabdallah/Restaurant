<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Reservations;
use App\Models\Table;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function Pest\Laravel\get;

class ReservationController extends Controller
{
public function StepOne(Request $request)
{
    $Reservation=$request->session()->get('reservation');
     $min_date=Carbon::today();
     $max_date=Carbon::now()->addWeek();
    return view ('Client.Reservation.StepOne',compact('Reservation','min_date','max_date'));


}
public function StoreOne(Request $request)
{
    $validated = $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'tel_number' => 'required',
        'email' => 'required|email',
        'res_data' => ['required', new DateBetween,new TimeBetween],
        'gust_number' => 'required',
    ]);

    if (empty($request->session()->get('reservation'))) {
        $reservation = new Reservations();
        $reservation->fill($validated);
        $request->session()->put('reservation', $reservation);
    } else {
        $reservation = $request->session()->get('reservation');
        $reservation->fill($validated);
        $request->session()->put('reservation', $reservation);
    }

    return redirect()->route('reservation.StepTwo');
}
public function StepTwo(Request $request)
{
    $reservation = $request->session()->get('reservation');

    $res_table = Reservations::orderBy('res_data')->get()->filter(function($value) use ($reservation) {
        return $value->res_data->format('Y-m-d') === $reservation->res_data->format('Y-m-d');
    })->pluck('table_id');

    $table = Table::where('stutas', 'available')
        ->where('gust_number', '>=', $reservation->gust_number)
        ->whereNotIn('id', $res_table)
        ->get();

    return view('Client.Reservation.StepTwo', compact('reservation', 'table'));
}
public function StoreTwo(Request $request)
{
    $validated = $request->validate([
        'table_id' => 'required'
    ]);

    $reservation = $request->session()->get('reservation');
    $reservation->fill($validated);
    $reservation->save();
    $request->session()->forget('reservation');

    return redirect()->route('Message');
}
}

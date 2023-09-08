<?php

namespace App\Models;

use App\Models\Reservations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TableLocation;
use App\Enums\TableStutas;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
      'name','location','gust_number','stutas'
  ];

  public function Reservation()
    {
        return $this->hasMany(Reservations::class);
    }
}
   

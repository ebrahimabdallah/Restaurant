<?php

namespace App\Models;

use App\Models\Table;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable=[
        'firstname','lastname','tel_number','email','res_data','table_id','gust_number'
    ];


    protected $dates=[
        'res_data'
    ];
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
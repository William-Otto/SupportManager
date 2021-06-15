<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\City;
use App\Http\Controllers\CitiesController;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
    ];

    public function cities()
    {
        return $this->belongsTo(\App\Models\City::class);
    }
}

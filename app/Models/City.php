<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\Customer;
use App\Http\Controllers\CustomersController;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    
    public function customers()
    {
        return $this->hasMany(\App\Models\Customer::class);
    }
}

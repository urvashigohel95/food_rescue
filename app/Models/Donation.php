<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\DonationController;



class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_name',
        'food_type',
        'quantity',
        'quantity_unit',
        'description',
        'pickup_location',
        'available_until',
        'image',
        'status',
    ];

    public function foodRequests()
    {
        return $this->hasMany(FoodRequest::class);
    }
}

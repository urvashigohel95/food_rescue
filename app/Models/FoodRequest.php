<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'donation_id',
        'requester_name',
        'requester_email',
        'requested_quantity',
        'message',
        'status',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}

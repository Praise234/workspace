<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name', 'product', 'amount_paid', 'duration', 'quantity', 'booked_date_time'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnavailableDays extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_date_time', 'to_date_time'
    ];
}

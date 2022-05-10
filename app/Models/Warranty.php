<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    use HasFactory;

    protected $table = 'warranty';


    protected $fillable = [
        'name', 'phone', 'address', 'district', 'city', 'avatar'
    ];
}

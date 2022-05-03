<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuLocation extends Model
{
    use HasFactory;
    protected $table = 'menu_location';
    protected $fillable = ['menu_id', 'location'];
}

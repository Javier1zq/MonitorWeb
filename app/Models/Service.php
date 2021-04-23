<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'DNI',
        'data',
        'data_type',
        'fiber',
        'fiber_type',
        'phone',
        'phone_type',
        'tv',
    ];
}

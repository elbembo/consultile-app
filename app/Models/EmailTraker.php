<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTraker extends Model
{
    use HasFactory;
    protected $fillable = [

        'type',
        'capmaign_id',
        'contact_id',
        'priority',
        'massage_id',
    ];

}

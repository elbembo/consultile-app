<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [

        'title',
        'first_name',
        'last_name',
        'email',
        'work_phone',
        'personal_phone',
        'company',
        'job_title',
        'country',
        'tags',
        'source',
        'subscribe',
    ];
}

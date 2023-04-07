<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'sallery',
        'gender',
        'hiring_date',
        'docs',
        'target'

    ];
    protected $casts = [
        'docs' => Json::class,
        'target' => Json::class,
    ];
}

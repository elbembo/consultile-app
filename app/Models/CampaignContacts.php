<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignContacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'name',
        'code',
        'fields_data'
    ];
    protected $casts = ['fields_data' => 'array',];
}

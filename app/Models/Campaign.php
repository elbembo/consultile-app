<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $fillable = [
            'name',
            'subject',
            'campaign_priority',
            'sender_name',
            'replay_to',
            'replay_to_name',
            'description',
            'status',
            'target_audience',
            'target_location',
            'total_audience',
            'template_id',
            'audience_done',
            'details'
    ];
}

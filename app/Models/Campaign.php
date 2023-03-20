<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use HasFactory, SoftDeletes;
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
        'details',
        'tracking',
        'group_name'
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'details' => Json::class,
    ];
}

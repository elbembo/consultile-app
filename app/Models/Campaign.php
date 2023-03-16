<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;
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
        'details',
        'tracking'
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

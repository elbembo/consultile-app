<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Activitiy extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'user_id',
        'account',
        'action',
        'message',
        'connections_count',
        'new_opportunities',
        'type'
    ];
    public function setUserIdAttribute($value)
    {
        $this->attributes['user_id'] = Auth::id();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailQeue extends Model
{
    use HasFactory;
    protected $fillable = [

        'type',
        'capmaign_id',
        'contact_id',
        'priority',
        'massage_id',
    ];
    public function setMassageIdAttribute($value)
    {
        $this->attributes['massage_id'] = md5($this->attributes['capmaign_id'].','.$this->attributes['contact_id'].','.$value);
    }
}

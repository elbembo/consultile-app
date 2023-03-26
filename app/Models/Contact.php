<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;
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
        'group_name'
    ];
    public function notes(): HasMany
    {
        return $this->hasMany(StickyNote::class)->orderBy('id','desc');
    }
}

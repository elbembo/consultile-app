<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StickyNote extends Model
{
    use HasFactory;
    protected $fillable = [
        'contact_id',
        'user_id',
        'note'
    ];
    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}

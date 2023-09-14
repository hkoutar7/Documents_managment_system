<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'description',
        'created_by',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function document(): HasOne
    {
        return $this->hasOne(Document::class);
    }
}

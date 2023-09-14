<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Avatar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'extension',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

}

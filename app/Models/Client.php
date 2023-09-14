<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'phone_number',
        'email',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::title($value),
            get: fn (string $value) => Str::title($value),
        );
    }

}

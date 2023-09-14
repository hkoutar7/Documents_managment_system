<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $fillable = [
        'name' ,
        'description',
        'section_id',
        'created_by',
        'client_id',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class,'created_by');
    }

    public function attahments(): HasMany
    {
        return $this->hasMany(Attachment::class);
    }


}

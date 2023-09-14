<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'created_by',
        'document_id',
        'extension',
    ];


    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class,'created_by');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChMessageTranslate extends Model
{
    use SoftDeletes;
    protected $fillable = ['translate_from', 'target_language', 'body'];

    public function message(): BelongsTo
    {
        return $this->belongsTo(ChMessage::class, 'translate_from', 'id');
    }
}

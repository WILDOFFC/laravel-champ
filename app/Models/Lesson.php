<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    public function Course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected $guarded = ['id'];
}

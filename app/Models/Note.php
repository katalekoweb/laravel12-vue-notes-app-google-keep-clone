<?php

namespace App\Models;

use App\Traits\UserManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use UserManager;
    
    protected $guarded = [];
    public function user (): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

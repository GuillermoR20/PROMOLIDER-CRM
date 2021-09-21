<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;
    protected $table = 'wallet';

    /**
     * Get the user that owns the Wallet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userMembreship(): BelongsTo
    {
        return $this->belongsTo(UserMembreship::class, 'id_user_membreship');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    protected $table = "wallets";
    protected $primaryKey = "id";

    public function customer() : BelongsTo {
        return $this->belongsTo(Customer::class);
    }
}

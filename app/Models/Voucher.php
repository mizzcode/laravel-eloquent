<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasUuids;

    // ovveride agar bisa menggunakan uuid selain primary key
    public function uniqueIds()
    {
        return [$this->primaryKey, "code"];
    }
}
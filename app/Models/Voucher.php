<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasUuids, SoftDeletes;

    // ovveride agar bisa menggunakan uuid selain primary key
    public function uniqueIds()
    {
        return [$this->primaryKey, "code"];
    }

    // membuat Local Scope, kita harus menyebutnya dalam query jika ingin menggunakan localscope tanpa prefix scope
    public function scopeActive(Builder $builder) {
        $builder->where("is_active", true);
    }
    public function scopeNonActive(Builder $builder) {
        $builder->where("is_active", false);
    }
}
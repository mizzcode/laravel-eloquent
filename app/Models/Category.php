<?php

namespace App\Models;

use App\Models\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = "categories";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    // mass asignment
    protected $fillable = [
        "id",
        "name",
        "description"
    ];

    // untuk mendaftarkan global scope ke model
    protected static function booted()
    {
        parent::booted();
        self::addGlobalScope(new IsActiveScope);
    }

    public function products() : HasMany {
        return $this->hasMany(Product::class, "category_id");
    }
}

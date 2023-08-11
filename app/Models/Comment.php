<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // untuk membuat default value jika kita tidak set value nya
    protected $attributes = [
        "title" => "Hello World",
        "message" => "Hello World"
    ];
}

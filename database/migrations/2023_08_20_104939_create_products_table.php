<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("nama", 100);
            $table->string("description", 100);
            $table->integer("stok")->default(0);
            $table->integer("price")->default(0);
            $table->string("category_id", 100);
            $table->timestamps();

            $table->foreign("category_id")->on("categories")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

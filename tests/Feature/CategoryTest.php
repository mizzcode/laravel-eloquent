<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testInsert() {
        $category = new Category;
        $category->id = "GADGET";
        $category->name = "POCO M4 PRO";
        $category->description = "Mediatek G96 Ram 6/128";
        $result = $category->save();

        self::assertTrue($result);
    }

    public function testInsertMany() {
        $categories = [];

        for ($i = 1; $i <= 10; $i++) {
            $categories[] = [
                "id" => "ID - $i",
                "name" => "NAME - $i"
            ];
        }

        // bisa seperti ini pakai query
        // Category::query()->insert($categories);
        // atau
        $result = Category::insert($categories);

        self::assertTrue($result);

        $total = Category::query()->count();

        self::assertEquals(10, $total);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Scopes\IsActiveScope;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
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

    public function testFind() {
        $this->seed(CategorySeeder::class);

        $category = Category::query()->find("FOOD");

        self::assertNotNull($category);
        self::assertEquals("FOOD", $category->id);
        self::assertEquals("Food", $category->name);
        self::assertEquals("Food Category", $category->description);
    }

    public function testUpdate() {
        $this->seed(CategorySeeder::class);

        $category = Category::query()->find("FOOD");

        $category->name = "Food Update";

        $result = $category->update();

        self::assertTrue($result);
    }

    public function testSelect() {
        // membuat 5 data
        for ($i = 0; $i < 5; $i++) {
            $category = new Category;
            $category->id = "ID-$i";
            $category->name = "NAME-$i";
            $category->save();
        }
        // query yang value nya null
        $category = Category::query()->whereNull("description")->get();
        // hitung apakah betul 5 yang data nya null
        self::assertEquals(5, $category->count());

        // iterasi data
        $category->each(function ($category) {

            self::assertNull($category->description);
            // set description
            $category->description = "Update";
            // update
            $category->update();
        });
    }

    public function testUpdateMany() {
        // membuat categories untuk menampung data
        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "id-$i",
                "name" => "name-$i"
            ];
        }
        // insert
        $result = Category::query()->insert($categories);
        // pastikan true jika berhasil insert
        self::assertTrue($result);
        // update description yang value nya null
        Category::query()->whereNull("description")->update([
            "description" => "updated"
        ]);
        // menghitung description yang sudah di update
        $count = Category::query()->where("description", "=", "updated")->count();

        self::assertEquals(10, $count);
    }

    public function testDelete() {
        $this->seed(CategorySeeder::class);

        $category = Category::query()->find("FOOD");

        $result = $category->delete();

        self::assertTrue($result);

        $total = Category::query()->count();

        self::assertEquals(0, $total);
    }

    public function testDeleteMany() {
        $categories = [];

        for ($i = 0; $i < 10; $i++) {
            $categories[] = [
                "id" => "id-$i",
                "name" => "name-$i"
            ];
        }

        $result = Category::query()->insert($categories);
        self::assertTrue($result);

        $total = Category::query()->count();
        self::assertEquals(10, $total);

        Category::query()->whereNull("description")->delete();

        $total = Category::query()->count();

        self::assertEquals(0, $total);
    }

    public function testCreate() {
        $request = [
            "id" => "1",
            "name" => "GADGET",
            "description" => "Mediatek G96"
        ];

        $category = new Category($request);
        $category->save();

        self::assertNotNull($category->id);
    }
    public function testCreateQueryBuilder() {
        $request = [
            "id" => "1",
            "name" => "GADGET",
            "description" => "Mediatek G96"
        ];

        $category = Category::query()->create($request);

        self::assertNotNull($category->id);
    }

    public function testUpdateMass() {
        $this->seed(CategorySeeder::class);

        $request = [
            "name" => "Food Updated",
            "description" => "Description Category Updated"
        ];

        $category = Category::query()->find("FOOD");

        // $category->fill($request); // tidak secara langsung menyimpan ke database
        // $category->save(); // perlu memanggil method save jika ingin menyimpan nya

        $category->update($request); // langsung menyimpang ke database

        self::assertNotNull($category->id);
    }

    public function testGlobalScope() {
        $category = new Category;
        $category->id = "FOOD";
        $category->name = "Whiskas";
        $category->is_active = false;
        $category->save();

        // ketika kita query maka otomatis akan menambahkan and is_active sesuai yang kita
        // daftarkan di global scope pada model
        $category = Category::query()->find($category->id);
        Log::info(json_encode($category));
        self::assertNull($category);

        // agar melakuka query tanpa global scope bisa menggunakan method withoutGlocalScope,
        // jika lebih dari 1 class global scope maka gunakan array
        $category = Category::query()->withoutGlobalScope(IsActiveScope::class)->find("FOOD");
        Log::info(json_encode($category));
        self::assertNotNull($category);
    }

    public function testRelationshipOneToMany() {
        $this->seed([CategorySeeder::class, ProductSeeder::class]);

        $category = Category::query()->find("FOOD");
        self::assertNotNull($category);

        Log::info(json_encode($category));

        $product = $category->products;
        
        self::assertNotNull($product);
        self::assertCount(2, $product);

        Log::info(json_encode($product));
    }
}


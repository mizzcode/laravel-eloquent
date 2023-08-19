<?php

namespace Tests\Feature;

use App\Models\Voucher;
use Database\Seeders\VoucherSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class VoucherTest extends TestCase
{
    public function testCreateVoucherUUID() {
        $voucher = new Voucher;
        $voucher->name = "wifi.id";
        $voucher->save();

        $voucher->query()->find($voucher->id);
        Log::info(json_encode($voucher));
        self::assertNotNull($voucher->id);
    }

    public function testSoftDelete() {
        $this->seed(VoucherSeeder::class);

        $voucher = Voucher::query()->where("name", "wifi.id")->first();
        Log::info(json_encode($voucher));
        $voucher->delete();

        $voucher = Voucher::query()->where("name", "wifi.id")->first();
        Log::info(json_encode($voucher));
        self::assertNull($voucher);

        // tambahkan method withTrashed untuk mengambil data yang termasuk softDelete
        $voucher = Voucher::withTrashed()->where("name", "wifi.id")->first();
        Log::info(json_encode($voucher));
        self::assertNotNull($voucher);
    }
}

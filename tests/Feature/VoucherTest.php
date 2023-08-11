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
}

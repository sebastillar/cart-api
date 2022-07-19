<?php

namespace Database\Seeders;

use App\Domains\Status\Enums\OrderStatusesEnums;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("statuses")->insert([
            "description" => OrderStatusesEnums::STATUS_CREATED,
        ]);
        DB::table("statuses")->insert([
            "description" => OrderStatusesEnums::STATUS_CHECKOUT,
        ]);
        DB::table("statuses")->insert([
            "description" => OrderStatusesEnums::STATUS_COMPLETED,
        ]);
        DB::table("statuses")->insert([
            "description" => OrderStatusesEnums::STATUS_CANCELLED,
        ]);
    }
}

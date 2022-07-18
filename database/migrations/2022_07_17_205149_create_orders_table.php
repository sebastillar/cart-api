<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("status_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table
                ->foreignId("customer_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->float("subtotal_amount");
            $table->float("shipment_amount")->default(0);
            $table->float("tax_amount")->default(0);
            $table->float("total_amount");
            $table->json("items");
            $table->json("billing_data");
            $table->json("shipment_data");
            $table->json("payment_data");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("orders");
    }
}

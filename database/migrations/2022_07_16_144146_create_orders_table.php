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
    public function up(): void
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->id();
            $table->string("status", 20);
            $table
                ->foreignId("customer_id")
                ->nullable()
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("set null");
            $table->float("subtotal_amount")->default(0);
            $table->float("shipment_amount")->default(0);
            $table->float("tax_amount")->default(0);
            $table->float("total_amount")->default(0);
            $table->bigInteger("shipment_id")->nullable();
            $table->json("shipment_data")->nullable();
            $table->bigInteger("billing_id")->nullable();
            $table->json("billing_data")->nullable();
            $table->bigInteger("payment_id")->nullable();
            $table->json("payment_data")->nullable();
            $table->json("notification_events")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists("orders");
    }
}

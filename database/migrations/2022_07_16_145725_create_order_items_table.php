<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("order_items", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("order_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table
                ->foreignId("product_id")
                ->constrained()
                ->onUpdate("cascade")
                ->onDelete("cascade");
            $table->unsignedInteger("quantity");
            $table->float("discount")->nullable();
            $table->string("status", "20");
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
        Schema::dropIfExists("order_items");
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("items", function (Blueprint $table) {
            $table->id();
            $table->integer("quantity")->unsigned();
            $table
                ->foreignId("product_id", 50)
                ->nullable()
                ->constrained();
            $table->float("subtotal_item")->nullable();
            $table->unsignedBigInteger("checkoutable_id")->nullable();
            $table->string("checkoutable_type")->nullable();

            $table->unique(["product_id", "checkoutable_id", "checkoutable_type"], "item_unique");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("items");
    }
}

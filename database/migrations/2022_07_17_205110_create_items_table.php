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
            $table->string("product_id", 50);
            $table->unsignedBigInteger("checkoutable_id");
            $table->string("checkoutable_type");
            $table->timestamps();

            $table
                ->foreign("product_id")
                ->references("asin")
                ->on("products")
                ->onUpdate("cascade")
                ->onDelete("cascade");
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

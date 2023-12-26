<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->decimal('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('order_number');
            $table->string('name_product');

            // $table->string('order_number'); 
            $table->foreignId('sale_id')->references('id')->on('sales')->onDelete('cascade')->nullable();
            $table->foreignId('menu_id')->references('id')->on('menus')->onDelete('cascade')->nullable();
            
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
        Schema::dropIfExists('carts');
    }
};

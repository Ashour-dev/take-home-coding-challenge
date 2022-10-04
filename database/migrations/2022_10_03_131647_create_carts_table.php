<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
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
            $table->string('name');
            $table->string('Item_type');
            $table->char('Country',3)->nullable();
            $table->integer('quantity');
            $table->float('Item_price',6,2);
            $table->float('Weight',4,1);
            $table->text('link');
            $table->integer('Rate')->nullable();
            $table->float('Shipping',5,2)->nullable();
            $table->float('VAT',7,4)->nullable();
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
}

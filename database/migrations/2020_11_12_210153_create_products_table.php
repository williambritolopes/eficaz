<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     *     - id (tipo UUID)
     *     - id da categoria (FK)
     *     - nome
     *     - descrição
     *     - valor
     *     - estoque
     *     - data e hora de cadastro
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('code_id');
            $table->bigInteger('category_id')->unsigned();            
            $table->string('name', 255);
            $table->text('description');
            $table->float('price', 8,2);
            $table->float('stock', 8,2);
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

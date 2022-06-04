<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProdutoVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('vendas', function (Blueprint $table){
            $table->id();
            $table->decimal('total');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
       });

       Schema::create('produtos_vendas)', function (Blueprint $table){
        $table->id();
        $table->unsignedBigInteger('produto_id');
        $table->foreign('produto_id')->references('id')->on('produtos');
        $table->unsignedBigInteger('venda_id');
        $table->foreign('venda_id')->references('id')->on('vendas');
        $table->decimal('valor_unitario');
        $table->integer('quantidade');
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
        //
    }
}

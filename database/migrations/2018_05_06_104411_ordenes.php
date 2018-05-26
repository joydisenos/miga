<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Ordenes.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:44:12pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Ordenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('ordenes',function (Blueprint $table){

        $table->increments('id');
        
        $table->biginteger('user_id');

        $table->float('total');

        $table->string('direccione_id');
        
        $table->integer('estatus');

        $table->string('entrega');

        $table->string('pago');

        $table->float('descuento')->default(0);

        $table->float('envio')->default(0);
        
        /**
         * Foreignkeys section
         */
        
        
        $table->timestamps();
        
        
        $table->softDeletes();
        
        // type your addition here

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('ordenes');
    }
}

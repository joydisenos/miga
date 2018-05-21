<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Cupones.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:48:38pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Cupones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('cupones',function (Blueprint $table){

        $table->increments('id');

        $table->string('nombre')->default('Cupon');
        
        $table->float('porcentaje');
        
        $table->integer('estatus');
        
        $table->float('puntos');
        
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
        Schema::drop('cupones');
    }
}

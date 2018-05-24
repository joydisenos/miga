<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Direcciones.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:42:37pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Direcciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('direcciones',function (Blueprint $table){

        $table->increments('id');
        
        $table->biginteger('user_id');
        
        $table->String('zip')->deafult('no suministrado');
        
        $table->longText('direccion');
        
        $table->longText('referencia');
        
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
        Schema::drop('direcciones');
    }
}

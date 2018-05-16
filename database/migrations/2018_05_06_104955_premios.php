<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Premios.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:49:56pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Premios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('premios',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('foto');
        
        $table->String('nombre');
        
        $table->longText('descripcion');
        
        $table->float('puntos');
        
        $table->integer('estatus');
        
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
        Schema::drop('premios');
    }
}

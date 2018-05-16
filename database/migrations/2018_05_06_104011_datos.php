<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Datos.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:40:12pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Datos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('datos',function (Blueprint $table){

        $table->increments('id');
        
        $table->biginteger('user_id');
        
        $table->String('telefono1');
        
        $table->String('telefono2');
        
        $table->float('puntos');
        
        $table->date('nacimiento')->nullable();
        
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
        Schema::drop('datos');
    }
}

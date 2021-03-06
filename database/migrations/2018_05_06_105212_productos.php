<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Productos.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:52:13pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('productos',function (Blueprint $table){

        $table->increments('id');
        
        $table->String('foto')->unique();
        
        $table->integer('estatus');

        $table->integer('categoria_id')->default(0);
        
        $table->longText('descripcion');
        
        $table->float('precio');
        
        $table->String('nombre');

        $table->String('cantidades');
        
        $table->String('cantidadesdesc');

        $table->integer('destacado')->default(0);
        
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
        Schema::drop('productos');
    }
}

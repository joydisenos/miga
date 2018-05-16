<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class Compras.
 *
 * @author  The scaffold-interface created at 2018-05-06 10:47:15pm
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Compras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        Schema::create('compras',function (Blueprint $table){

        $table->increments('id');
        
        $table->biginteger('ordene_id');

        $table->biginteger('user_id');
        
        $table->biginteger('producto_id');

        $table->integer('cantidad');

        $table->integer('estatus')->default(1);
        
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
        Schema::drop('compras');
    }
}

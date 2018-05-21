<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrincipalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('principal', function (Blueprint $table) {
            
            $table->increments('id');

            $table->float('envio')->default(0);

            $table->float('descuento')->default(5);

            $table->float('monto')->default(600);

            //mañana

            $table->time('lunesa')->default('8:00');

            $table->time('lunesc')->default('12:00');

            $table->time('martesa')->default('8:00');

            $table->time('martesc')->default('12:00');

            $table->time('miercolesa')->default('8:00');

            $table->time('miercolesc')->default('12:00');

            $table->time('juevesa')->default('8:00');

            $table->time('juevesc')->default('12:00');

            $table->time('viernesa')->default('8:00');

            $table->time('viernesc')->default('12:00');

            $table->time('sabadoa')->default('8:00');

            $table->time('sabadoc')->default('12:00');

            $table->time('domingoa')->default('8:00');

            $table->time('domingoc')->default('12:00');

            //tarde

            $table->time('lunesat')->default('13:00');

            $table->time('lunesct')->default('16:00');

            $table->time('martesat')->default('13:00');

            $table->time('martesct')->default('16:00');

            $table->time('miercolesat')->default('13:00');

            $table->time('miercolesct')->default('16:00');

            $table->time('juevesat')->default('13:00');

            $table->time('juevesct')->default('16:00');

            $table->time('viernesat')->default('13:00');

            $table->time('viernesct')->default('16:00');

            $table->time('sabadoat')->default('13:00');

            $table->time('sabadoct')->default('16:00');

            $table->time('domingoat')->default('13:00');

            $table->time('domingoct')->default('16:00');



            $table->longText('bienvenida');

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
        Schema::dropIfExists('principal');
    }
}

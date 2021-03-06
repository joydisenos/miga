@extends('scaffold-interface.layouts.app')
@section('title','Create')
@section('content')

<section class="content">
    <h1>
        Create producto
    </h1>
    <a href="{!!url('producto')!!}" class = 'btn btn-danger'><i class="fa fa-home"></i> Producto Index</a>
    <br>
    <form method = 'POST' action = '{!!url("producto")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="foto">foto</label>
            <input id="foto" name = "foto" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="estatus">estatus</label>
            <input id="estatus" name = "estatus" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="tipo">tipo</label>
            <input id="tipo" name = "tipo" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="descripcion">descripcion</label>
            <input id="descripcion" name = "descripcion" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="precio">precio</label>
            <input id="precio" name = "precio" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="nombre">nombre</label>
            <input id="nombre" name = "nombre" type="text" class="form-control">
        </div>
        <button class = 'btn btn-success' type ='submit'> <i class="fa fa-floppy-o"></i> Save</button>
    </form>
</section>
@endsection
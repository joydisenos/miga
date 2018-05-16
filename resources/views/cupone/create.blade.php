@extends('scaffold-interface.layouts.app')
@section('title','Create')
@section('content')

<section class="content">
    <h1>
        Create cupone
    </h1>
    <a href="{!!url('cupone')!!}" class = 'btn btn-danger'><i class="fa fa-home"></i> Cupone Index</a>
    <br>
    <form method = 'POST' action = '{!!url("cupone")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="user_id">user_id</label>
            <input id="user_id" name = "user_id" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="porcentaje">porcentaje</label>
            <input id="porcentaje" name = "porcentaje" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="estatus">estatus</label>
            <input id="estatus" name = "estatus" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="puntos">puntos</label>
            <input id="puntos" name = "puntos" type="text" class="form-control">
        </div>
        <button class = 'btn btn-success' type ='submit'> <i class="fa fa-floppy-o"></i> Save</button>
    </form>
</section>
@endsection
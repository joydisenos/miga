@extends('scaffold-interface.layouts.app')
@section('title','Create')
@section('content')

<section class="content">
    <h1>
        Create direccione
    </h1>
    <a href="{!!url('direccione')!!}" class = 'btn btn-danger'><i class="fa fa-home"></i> Direccione Index</a>
    <br>
    <form method = 'POST' action = '{!!url("direccione")!!}'>
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="user_id">user_id</label>
            <input id="user_id" name = "user_id" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="zip">zip</label>
            <input id="zip" name = "zip" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="direccion">direccion</label>
            <input id="direccion" name = "direccion" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="referencia">referencia</label>
            <input id="referencia" name = "referencia" type="text" class="form-control">
        </div>
        <button class = 'btn btn-success' type ='submit'> <i class="fa fa-floppy-o"></i> Save</button>
    </form>
</section>
@endsection
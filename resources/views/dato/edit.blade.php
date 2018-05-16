@extends('scaffold-interface.layouts.app')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Edit dato
    </h1>
    <a href="{!!url('dato')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Dato Index</a>
    <br>
    <form method = 'POST' action = '{!! url("dato")!!}/{!!$dato->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="user_id">user_id</label>
            <input id="user_id" name = "user_id" type="text" class="form-control" value="{!!$dato->
            user_id!!}"> 
        </div>
        <div class="form-group">
            <label for="telefono1">telefono1</label>
            <input id="telefono1" name = "telefono1" type="text" class="form-control" value="{!!$dato->
            telefono1!!}"> 
        </div>
        <div class="form-group">
            <label for="telefono2">telefono2</label>
            <input id="telefono2" name = "telefono2" type="text" class="form-control" value="{!!$dato->
            telefono2!!}"> 
        </div>
        <div class="form-group">
            <label for="puntos">puntos</label>
            <input id="puntos" name = "puntos" type="text" class="form-control" value="{!!$dato->
            puntos!!}"> 
        </div>
        <div class="form-group">
            <label for="nacimiento">nacimiento</label>
            <input id="nacimiento" name = "nacimiento" type="text" class="form-control" value="{!!$dato->
            nacimiento!!}"> 
        </div>
        <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Update</button>
    </form>
</section>
@endsection
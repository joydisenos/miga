@extends('scaffold-interface.layouts.app')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Edit compra
    </h1>
    <a href="{!!url('compra')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Compra Index</a>
    <br>
    <form method = 'POST' action = '{!! url("compra")!!}/{!!$compra->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="orden_id">orden_id</label>
            <input id="orden_id" name = "orden_id" type="text" class="form-control" value="{!!$compra->
            orden_id!!}"> 
        </div>
        <div class="form-group">
            <label for="producto_id">producto_id</label>
            <input id="producto_id" name = "producto_id" type="text" class="form-control" value="{!!$compra->
            producto_id!!}"> 
        </div>
        <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Update</button>
    </form>
</section>
@endsection
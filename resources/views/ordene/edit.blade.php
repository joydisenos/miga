@extends('scaffold-interface.layouts.app')
@section('title','Edit')
@section('content')

<section class="content">
    <h1>
        Edit ordene
    </h1>
    <a href="{!!url('ordene')!!}" class = 'btn btn-primary'><i class="fa fa-home"></i> Ordene Index</a>
    <br>
    <form method = 'POST' action = '{!! url("ordene")!!}/{!!$ordene->
        id!!}/update'> 
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
        <div class="form-group">
            <label for="user_id">user_id</label>
            <input id="user_id" name = "user_id" type="text" class="form-control" value="{!!$ordene->
            user_id!!}"> 
        </div>
        <button class = 'btn btn-success' type ='submit'><i class="fa fa-floppy-o"></i> Update</button>
    </form>
</section>
@endsection
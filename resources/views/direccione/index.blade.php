@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Direccione Index
    </h1>
    <a href='{!!url("direccione")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> New</a>
    <br>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>user_id</th>
            <th>zip</th>
            <th>direccion</th>
            <th>referencia</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($direcciones as $direccione) 
            <tr>
                <td>{!!$direccione->user_id!!}</td>
                <td>{!!$direccione->zip!!}</td>
                <td>{!!$direccione->direccion!!}</td>
                <td>{!!$direccione->referencia!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/direccione/{!!$direccione->id!!}/deleteMsg" ><i class = 'fa fa-trash'> delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/direccione/{!!$direccione->id!!}/edit'><i class = 'fa fa-edit'> edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/direccione/{!!$direccione->id!!}'><i class = 'fa fa-eye'> info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $direcciones->render() !!}

</section>
@endsection
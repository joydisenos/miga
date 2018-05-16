@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Dato Index
    </h1>
    <a href='{!!url("dato")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> New</a>
    <br>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>user_id</th>
            <th>telefono1</th>
            <th>telefono2</th>
            <th>puntos</th>
            <th>nacimiento</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($datos as $dato) 
            <tr>
                <td>{!!$dato->user_id!!}</td>
                <td>{!!$dato->telefono1!!}</td>
                <td>{!!$dato->telefono2!!}</td>
                <td>{!!$dato->puntos!!}</td>
                <td>{!!$dato->nacimiento!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/dato/{!!$dato->id!!}/deleteMsg" ><i class = 'fa fa-trash'> delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/dato/{!!$dato->id!!}/edit'><i class = 'fa fa-edit'> edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/dato/{!!$dato->id!!}'><i class = 'fa fa-eye'> info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $datos->render() !!}

</section>
@endsection
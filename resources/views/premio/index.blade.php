@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Premio Index
    </h1>
    <a href='{!!url("premio")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> New</a>
    <br>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>foto</th>
            <th>nombre</th>
            <th>descripcion</th>
            <th>puntos</th>
            <th>estatus</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($premios as $premio) 
            <tr>
                <td>{!!$premio->foto!!}</td>
                <td>{!!$premio->nombre!!}</td>
                <td>{!!$premio->descripcion!!}</td>
                <td>{!!$premio->puntos!!}</td>
                <td>{!!$premio->estatus!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/premio/{!!$premio->id!!}/deleteMsg" ><i class = 'fa fa-trash'> delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/premio/{!!$premio->id!!}/edit'><i class = 'fa fa-edit'> edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/premio/{!!$premio->id!!}'><i class = 'fa fa-eye'> info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $premios->render() !!}

</section>
@endsection
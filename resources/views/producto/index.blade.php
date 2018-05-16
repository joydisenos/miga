@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Producto Index
    </h1>
    <a href='{!!url("producto")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> New</a>
    <br>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>foto</th>
            <th>estatus</th>
            <th>tipo</th>
            <th>descripcion</th>
            <th>precio</th>
            <th>nombre</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($productos as $producto) 
            <tr>
                <td>{!!$producto->foto!!}</td>
                <td>{!!$producto->estatus!!}</td>
                <td>{!!$producto->tipo!!}</td>
                <td>{!!$producto->descripcion!!}</td>
                <td>{!!$producto->precio!!}</td>
                <td>{!!$producto->nombre!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/producto/{!!$producto->id!!}/deleteMsg" ><i class = 'fa fa-trash'> delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/producto/{!!$producto->id!!}/edit'><i class = 'fa fa-edit'> edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/producto/{!!$producto->id!!}'><i class = 'fa fa-eye'> info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $productos->render() !!}

</section>
@endsection
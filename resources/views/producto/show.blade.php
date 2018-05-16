@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show producto
    </h1>
    <br>
    <a href='{!!url("producto")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Producto Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>foto</b> </td>
                <td>{!!$producto->foto!!}</td>
            </tr>
            <tr>
                <td> <b>estatus</b> </td>
                <td>{!!$producto->estatus!!}</td>
            </tr>
            <tr>
                <td> <b>tipo</b> </td>
                <td>{!!$producto->tipo!!}</td>
            </tr>
            <tr>
                <td> <b>descripcion</b> </td>
                <td>{!!$producto->descripcion!!}</td>
            </tr>
            <tr>
                <td> <b>precio</b> </td>
                <td>{!!$producto->precio!!}</td>
            </tr>
            <tr>
                <td> <b>nombre</b> </td>
                <td>{!!$producto->nombre!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
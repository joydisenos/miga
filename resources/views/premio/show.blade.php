@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show premio
    </h1>
    <br>
    <a href='{!!url("premio")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Premio Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>foto</b> </td>
                <td>{!!$premio->foto!!}</td>
            </tr>
            <tr>
                <td> <b>nombre</b> </td>
                <td>{!!$premio->nombre!!}</td>
            </tr>
            <tr>
                <td> <b>descripcion</b> </td>
                <td>{!!$premio->descripcion!!}</td>
            </tr>
            <tr>
                <td> <b>puntos</b> </td>
                <td>{!!$premio->puntos!!}</td>
            </tr>
            <tr>
                <td> <b>estatus</b> </td>
                <td>{!!$premio->estatus!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
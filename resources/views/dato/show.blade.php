@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show dato
    </h1>
    <br>
    <a href='{!!url("dato")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Dato Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>user_id</b> </td>
                <td>{!!$dato->user_id!!}</td>
            </tr>
            <tr>
                <td> <b>telefono1</b> </td>
                <td>{!!$dato->telefono1!!}</td>
            </tr>
            <tr>
                <td> <b>telefono2</b> </td>
                <td>{!!$dato->telefono2!!}</td>
            </tr>
            <tr>
                <td> <b>puntos</b> </td>
                <td>{!!$dato->puntos!!}</td>
            </tr>
            <tr>
                <td> <b>nacimiento</b> </td>
                <td>{!!$dato->nacimiento!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
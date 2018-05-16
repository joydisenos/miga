@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show cupone
    </h1>
    <br>
    <a href='{!!url("cupone")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Cupone Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>user_id</b> </td>
                <td>{!!$cupone->user_id!!}</td>
            </tr>
            <tr>
                <td> <b>porcentaje</b> </td>
                <td>{!!$cupone->porcentaje!!}</td>
            </tr>
            <tr>
                <td> <b>estatus</b> </td>
                <td>{!!$cupone->estatus!!}</td>
            </tr>
            <tr>
                <td> <b>puntos</b> </td>
                <td>{!!$cupone->puntos!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
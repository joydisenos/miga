@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show compra
    </h1>
    <br>
    <a href='{!!url("compra")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Compra Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>orden_id</b> </td>
                <td>{!!$compra->orden_id!!}</td>
            </tr>
            <tr>
                <td> <b>producto_id</b> </td>
                <td>{!!$compra->producto_id!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show direccione
    </h1>
    <br>
    <a href='{!!url("direccione")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Direccione Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>user_id</b> </td>
                <td>{!!$direccione->user_id!!}</td>
            </tr>
            <tr>
                <td> <b>zip</b> </td>
                <td>{!!$direccione->zip!!}</td>
            </tr>
            <tr>
                <td> <b>direccion</b> </td>
                <td>{!!$direccione->direccion!!}</td>
            </tr>
            <tr>
                <td> <b>referencia</b> </td>
                <td>{!!$direccione->referencia!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
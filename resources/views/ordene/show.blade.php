@extends('scaffold-interface.layouts.app')
@section('title','Show')
@section('content')

<section class="content">
    <h1>
        Show ordene
    </h1>
    <br>
    <a href='{!!url("ordene")!!}' class = 'btn btn-primary'><i class="fa fa-home"></i>Ordene Index</a>
    <br>
    <table class = 'table table-bordered'>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <tr>
                <td> <b>user_id</b> </td>
                <td>{!!$ordene->user_id!!}</td>
            </tr>
        </tbody>
    </table>
</section>
@endsection
@extends('scaffold-interface.layouts.app')
@section('title','Index')
@section('content')

<section class="content">
    <h1>
        Cupone Index
    </h1>
    <a href='{!!url("cupone")!!}/create' class = 'btn btn-success'><i class="fa fa-plus"></i> New</a>
    <br>
    <br>
    <table class = "table table-striped table-bordered table-hover" style = 'background:#fff'>
        <thead>
            <th>user_id</th>
            <th>porcentaje</th>
            <th>estatus</th>
            <th>puntos</th>
            <th>actions</th>
        </thead>
        <tbody>
            @foreach($cupones as $cupone) 
            <tr>
                <td>{!!$cupone->user_id!!}</td>
                <td>{!!$cupone->porcentaje!!}</td>
                <td>{!!$cupone->estatus!!}</td>
                <td>{!!$cupone->puntos!!}</td>
                <td>
                    <a data-toggle="modal" data-target="#myModal" class = 'delete btn btn-danger btn-xs' data-link = "/cupone/{!!$cupone->id!!}/deleteMsg" ><i class = 'fa fa-trash'> delete</i></a>
                    <a href = '#' class = 'viewEdit btn btn-primary btn-xs' data-link = '/cupone/{!!$cupone->id!!}/edit'><i class = 'fa fa-edit'> edit</i></a>
                    <a href = '#' class = 'viewShow btn btn-warning btn-xs' data-link = '/cupone/{!!$cupone->id!!}'><i class = 'fa fa-eye'> info</i></a>
                </td>
            </tr>
            @endforeach 
        </tbody>
    </table>
    {!! $cupones->render() !!}

</section>
@endsection
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sondemiga.com - Panel Administrativo</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/modern-business.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link href="{{asset('toast/jquery.toast.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-danger text-white fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{url('/')}}">
<img src="{{asset('storage/logo.svg')}}" width="150" alt="">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin-panel')}}">Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin-panel/productos')}}">Productos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin-panel/premios')}}">Premios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin-panel/cupones')}}">Cupones</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/admin-panel/ventas')}}">Ventas</a>
            </li>

            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{title_case(Auth::user()->name)}}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                
                
                <a class="dropdown-item" href="{{url('admin-panel/config')}}">Configuración</a>
                
               

                <hr>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
            
            
            
          </ul>
        </div>
      </div>
    </nav>

    

    

    <!-- Page Content -->
      

    	<div class="cuerpo">
        @include('includes.errors')
         @include('includes.status')
       @yield('content') 
      </div>
    	
   
    <!-- /.container -->

    <!-- Footer -->

    @include('includes.footer')

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('toast/jquery.toast.min.js')}}"></script>
    @yield('scripts')
  </body>

</html>

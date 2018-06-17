<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sondemiga.com - Fábrica de Sandwiches de Azul | La mejor forma de pedir sandwiches de miga en Azul</title>

    <!-- Bootstrap core CSS -->
    <link rel="icon" href="{{asset('favicon.ico')}}" />
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('vendor/slick/slick-theme.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/modern-business.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <link href="{{asset('toast/jquery.toast.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Encode Sans Condensed' rel='stylesheet'>
	
	<!--Start of Zendesk Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="https://v2.zopim.com/?4sVatI9wnMeDxeZbXs665I4wckvm7FKi";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
 $zopim(function() {
	$zopim.livechat.window.setOffsetVertical(50);
  });
</script>
<!--End of Zendesk Chat Script-->
<script type="text/javascript"> 
var ua = navigator.userAgent.toLowerCase(), 
platform = navigator.platform.toLowerCase(); 
var url=window.location.href;
platformName = ua.match(/ip(?:ad|od|hone)/) ? 'ios' : (ua.match(/(?:webos|android)/) || platform.match(/mac|win|linux/) || ['other'])[0], 
isMobile = /ios|android|webos/.test(platformName); 
if (isMobile && url!="www.sondemiga.com") { 
$zopim(function(){ 
$zopim.livechat.hideAll(); 
$zopim.livechat.setOnChatStart(function(){
$zopim.livechat.setOnUnreadMsgs(unread);
function unread(number) {
if (number>0){
$zopim.livechat.window.show();
} 
}
}); 
});
} 
</script>


  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-danger text-white fixed-top">
      <div class="container">
         
        <a class="navbar-brand" href="{{url('/')}}">
<img src="{{asset('storage/logo.svg')}}" width="150" alt="">
        </a>

        @guest
        <a class="btn btn-outline-light d-block d-lg-none" style="width:auto;" href="{{url('/login')}}">
         <i class="fas fa-user"></i> Ingresar
        </a>
        @else
		<div class="dropdown">
				<button class="btn btn-outline-light btn-sm d-block d-lg-none dropdown-toggle" style="width:auto;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-user"></i>	Mi Cuenta
				</button>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
			
				<a class="dropdown-item" href="{{url('usuario')}}"><i class="fas fa-user"></i> Mis Datos</a>

                <a class="dropdown-item" href="{{url('usuario/compras')}}"><i class="fab fa-apple"></i> Mis Pedidos</a>

                <a class="dropdown-item" href="{{url('usuario/canje')}}"><i class="fas fa-star"></i> Canjear Puntos</a>

                

                
               
                

                <hr>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>

			</div>
		</div>
       
        @endguest
       
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">


            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <font color="yellow">Categorías</font>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                
               

               

                
                <?php $categorias = App\Categoria::where('estatus','=','1')->get(); ?>
                  
                  @foreach($categorias as $categoria)
                  

                   <a class="dropdown-item" href="{{url('/filtro').'/'.$categoria->id}}">{{$categoria->nombre}}</a>
                  @endforeach
                
                                
              </div>
            </li>


            
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{url('register')}}"><font color="white"><b>Registrate</b></font></a>
            </li>
            <li class="nav-item">
              <a class="btn btn-outline-warning nav-link" href="{{url('login')}}"><font color="white"><b>Iniciar Sesión</b></font></a>
            </li>
            @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><font color="white">
                <i class="fas fa-user"></i> Mi cuenta
              </font></a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                
                <!--
                <a class="dropdown-item" href="{{url('admin-panel')}}">Panel de Control</a>
                -->

                <a class="dropdown-item" href="{{url('usuario')}}"><i class="fas fa-user"></i> Mis Datos</a>

                <a class="dropdown-item" href="{{url('usuario/compras')}}"><i class="fab fa-apple"></i> Mis Pedidos</a>

                <a class="dropdown-item" href="{{url('usuario/canje')}}"><i class="fas fa-star"></i> Canjear Puntos</a>

                

                
               
                

                <hr>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                   <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>

            @if (count(Auth::user()->compra->where('ordene_id','=',0)))

            <li class="nav-item">
              <a class="nav-link" href="#" data-toggle="modal" data-target="#carrito">  
                
                <font color="white"><i class="fas fa-shopping-cart"></i> &nbsp; 

                {{Auth::user()->compra->where('ordene_id','=',0)->count()}}
                
              </font>
			  </a>
            </li>

            @endif


            @endguest
            
            
          </ul>
        </div>
      </div>
	  
    </nav>

    

    

    <!-- Page Content -->


    	<div class="cuerpo">

      @include('includes.errors')
      @include('includes.status')
       @yield('content') 

      
  
@guest
@else

            @if (count(Auth::user()->compra->where('ordene_id','=',0)))
          <a href="#" data-toggle="modal" data-target="#carrito" class="d-block d-lg-none">  
            <div class="carrito-movil text-center align-middle">
                
                  
                  
              <div class="carrito-logo">
                
                             {{Auth::user()->compra->where('ordene_id','=',0)->count()}}

                              <i class="fas fa-shopping-cart"></i>
              </div>
                  
                
              
            </div>
          </a>
              @endif
  @endguest

      </div>
    	
   
    <!-- /.container -->

    <!-- Footer -->



    @include('includes.footer')


@guest
@else

<!-- Modal Datos -->
<div class="modal fade" id="datos" tabindex="-1" role="dialog" aria-labelledby="datosTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{url('usuario/actualizar')}}" method="post">
      <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
      <div class="table-responsive">
      <table class="table table-hover">
      
      <tr>
        <td>
          Teléfono 1
        </td>
        <td>
          <input type="number" placeholder="Ingrese un número de teléfono"  name="telefono1" class="form-control" required>
        </td>
      </tr>
      <tr>
        <td>
          Teléfono 2
        </td>
        <td>
          <input type="number" placeholder="Ingrese un número de teléfono"  name="telefono2" class="form-control">
        </td>
      </tr>
      <tr>
        <td>
          Fecha de Nacimiento
        </td>
        <td>
          <input type="date" class="form-control" name="nacimiento" placeholder="AAAA/MM/DD" required>
        </td>
      </tr>
      <tr>
        <td>
          
        </td>
        <td>
          
        </td>
      </tr>

    </table>
    </div>

    
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-danger">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Dirección -->

<div class="modal fade" id="direccion" tabindex="-1" role="dialog" aria-labelledby="direccionTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Dirección</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
    <form action="{{url('usuario/direccion')}}" method="post">
      <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
      <div class="table-responsive">
      <table class="table table-hover">
      
      <tr>
        <td>
          Calle
        </td>
        <td>
          <input type="text" name="calle" class="form-control" required>
        </td>
      </tr>
      <tr>
        <td>
          Número
        </td>
        <td>
          <input type="number" name="numero" class="form-control" required>
        </td>
      </tr>
      <tr>
        <td>
          Piso
        </td>
        <td>
          <input type="text" name="piso" class="form-control">
        </td>
      </tr>
      <tr>
        <td>
          Departamento
        </td>
        <td>
          <input type="text" name="departamento" class="form-control">
        </td>
      </tr>
      <tr>
        <td>
          Código Postal
        </td>
        <td>
          <input type="text" class="form-control" name="zip" placeholder="Su Código postal / Zip">
        </td>
      </tr>
      <tr>
        <td>
          Detalles adicionales
        </td>
        <td>
          <input type="text" class="form-control" name="referencia" placeholder="detalles adicionales">
        </td>
      </tr>
      <tr>
        <td>
          
        </td>
        <td>
          
        </td>
      </tr>

    </table>
    </div>

   
                  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-danger">Guardar</button>
 </form>
      </div>
    </div>
  </div>
</div>




<!-- Modal Datos -->

<div class="modal fade" id="datos2" tabindex="-1" role="dialog" aria-labelledby="datosTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Compete los siguientes datos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
   
      <div class="table-responsive">
     <form action="{{url('usuario/actualizar')}}" method="post">
            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
            <input type = 'hidden' name = 'modal' value = '1'>
            <div class="table-responsive">
                    <table class="table table-hover">
                    
                    <tr>
                        <td>
                            Teléfono 1
                        </td>
                        <td>
                            <input type="number" placeholder="Ingrese un número de teléfono"  name="telefono1" class="form-control" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Teléfono 2
                        </td>
                        <td>
                            <input type="number" placeholder="Ingrese un número de teléfono"  name="telefono2" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Fecha de Nacimiento
                        </td>
                        <td>
                            <input type="date" class="form-control" name="nacimiento" placeholder="AAAA/MM/DD" required>
                        </td>
                    </tr>
                    

                </table>
        </div>

        
    </div>

   
                  
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-danger">Guardar</button>
 </form>
      </div>
    </div>
  </div>
</div>


@if(count(Auth::user()->compra->where('ordene_id','=',0)))
                
<div class="modal fade" id="carrito" tabindex="-1" role="dialog" aria-labelledby="carritoTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Carrito de Compras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Eliminar</th>
          </thead>
       <tbody>

        <?php $total=0; ?>
        @foreach(Auth::user()->compra->where('ordene_id','=',0) as $compra)

        <tr>
          <td>{{$compra->producto->nombre}}</td>
          <td>{{$compra->cantidad}}</td>
          <td>${{$compra->cantidad*($compra->producto->precio)}}</td>
          <td><a href="{{url('usuario/compra/borrar').'/'.$compra->id}}" class="btn btn-outline-danger"> <i class="fas fa-trash-alt"></i> </a></td>
        </tr>
        <?php $total = $total + ($compra->cantidad*($compra->producto->precio)) ?>
       
          

      
                  
        @endforeach

        <tr>
          <td></td>
          <td><strong>Total</strong></td>
          <td><strong>${{$total}}</strong></td>
          <td></td>
        </tr>
      </tbody>
        </table>
        </div>
                  
      </div>
      <div class="modal-footer">
        <a href="{{url('checkout')}}" class="btn btn-outline-danger" >Comprar</a>
      </div>
    </div>
  </div>
</div>




                 

                @endif
                @endguest
    <!-- Modal -->


    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.all.js')}}"></script>
    <script src="{{asset('vendor/slick/slick.min.js')}}"></script>
    @yield('scripts')
  </body>

</html>

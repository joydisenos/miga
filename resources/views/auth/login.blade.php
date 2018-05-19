@extends('layouts.front')

@section('content')
<div class="container">


        <div class="panel-heading text-center">
            <br>
                    <h3>Iniciar Sesión</h3>
                </div>

    <div class="row">



        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default formulario">
               


                

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordar usuario
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-danger">
                                    Iniciar sesión
                                </button>

                                <a href="{{url('register')}}" class="btn btn-outline-danger">
                                    Regístrate
                                </a>
                                <br>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Olvido su clave?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 formulario">
            
                        <div class="text-center">
                            <img src="{{asset('storage/logo.svg')}}" class="img-fluid" width="200" alt="">

                            <?php $bienvenida = App\Principal::first(); ?>
                            <p>{{$bienvenida->bienvenida}}</p>
                        </div>
                    
        </div>
    </div>
</div>
@endsection

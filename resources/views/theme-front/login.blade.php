<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tech Company</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('theme-front/login/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme-front/login/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme-front/login/css/iofrm-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('theme-front/login/css/iofrm-theme22.css') }}">
</head>
<body>
   
    <div class="form-body without-side">
        <div class="logo">
            <a href="index.html">
                <div class="logo">
                    <img class="logo-size" src="" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <img src="{{ asset('img/logo.png') }}" alt="">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="{{ asset('theme-front/login/images/graphic3.svg') }}" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Iniciar sesión</h3>


                        <form method="POST" class="form" action="{{ route('authenticated.login') }}">
                            @csrf

                            <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Correo electrónico" required>
                                @error('email')
                                    <span class="text-danger">
                                        <span>{{ $message }}</span>
                                    </span>
                                @enderror

                            <input class="form-control" type="password" name="password" placeholder="Contraseña" required>
                                @error('password')
                                    <span class="text-danger">
                                        <span>{{ $message }}</span>
                                    </span>
                                @enderror

                            
                                <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Login</button> <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                            </div>
                        </form>
                        <br>
                        <h5>¿No tienes una cuenta? <a href="{{ route('register') }}" class="link">Crear cuenta</a></h5>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

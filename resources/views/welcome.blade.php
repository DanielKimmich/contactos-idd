<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contactos-idd</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 64px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif


            <div class="content">
                <div class="title m-b-md">
                    Contactos-idd
                </div>

                <div class="links">
                    <a href="{{ backpack_url() }}">Login</a>
                    <a target="_blank" href="https://backpackforlaravel.com/docs">Docs</a>
                    <a target="_blank" href="https://github.com/laravel-backpack/crud">GitHub</a>
                    <a target="_blank" href="https://backpackforlaravel.com/contact">Contact</a>
                </div>
                
                <div class="m-t-lg">
                <p>
                A partir de la necesidad de la Iglesia de Dios, delegacion Montecarlo, de contar con información de personas, actividades; 
                surge esta aplicacion web que tiene como finaliad ser una herramienta de apoyo para la gestion y administracion de la Iglesia.<br><br>

                Fue desarrollado usando PHP con el framework Laravel y el paquete Backpack, que facilito la construccion de la web.<br> 
                En el ambiente de desarollo se uso Laragon con una base de datos Mysql.<br>
                La implemenacion en producción se hizo sobre la plataforma Heroku usando un servidor Apache con una base de datos Postgres.<br><br>
                </p>
    
                <p>
                    <img src="img/php-logo.png" alt="Php" height="150" width="150">
                    <img src="img/laravel-logo.jpg" alt="Laravel" height="150" width="450">
                    <img src="img/backpack-2.jpg" alt="Backpack" height="150" width="300">
                </p>

                <p>
                    <img src="img/composer-logo.jpg" alt="Composer" height="150" width="250">
                    <img src="img/git-github-logo.jpg" alt="GitHub" height="150" width="350">
                    <img src="img/mysql-postgres-logo.png" alt="Mysql-Postgres" height="150"  width="300">    
                </p>

                <p>
                    <img src="img/laragon-logo.jpg" alt="Laragon" height="150" width="300">
                    <img src="img/apache-logo.jpg" alt="Apache" height="150" width="300">
                    <img src="img/heroku-logo.png" alt="Heroku" height="150" width="300">
                </p>
                
            </div>



        @php
            // Ejemplo de uso 
            $ip = env('REMOTE_ADDR');
            $db = env('DB_CONNECTION');
            //    $url = env('DATABASE_URL');
            $host = env('DB_HOST');
            $port = env('DB_PORT');
            $database = env('DB_DATABASE');
            $username = env('DB_USERNAME');
        //    $password = env('DB_PASSWORD');
        @endphp

        <div>
            <p>
                IP_LOCAL: {{ $ip }}<br>
                DB_CONNECTION: {{ $db }}<br>
                DB_HOST: {{ $host }}<br>
                DB_PORT: {{ $port }}<br>
                DB_DATABASE: {{ $database }}<br>
                DB_USERNAME: {{ $username }}<br>
            </p>
        </div>

        </div>
    </body>
</html>


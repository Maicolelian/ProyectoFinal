<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Peliculas en cartelera</title>

        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>

        <script>

            function guardar_pelicula(title,release_date,original_language,original_title,overview,poster_path) {
            var datos = {
                nombre: title,
                lanzamiento: release_date,
                lenguaje: original_language,
                titulo_original: original_title,
                resumen: overview,
                poster: poster_path
            };

            fetch('/v1/pelis/create', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                },
                body: JSON.stringify(datos)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud.');
                }
                alert ('¡Pelicula guardada correctamente!');
                return response.json();
            })
            .then(data => {
                console.log('Respuesta del servidor:', data);
                
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
        </script>

        

        <style>
            * {box-sizing: border-box;}
            body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            }
            .topnav {
            overflow: hidden;
            background-color: #e9e9e9;
            }
            .topnav a {
            float: left;
            display: block;
            color: black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
            }
            .topnav a:hover {
            background-color: #ddd;
            color: black;
            }
            .topnav a.active {
            background-color: #2196F3;
            color: white;
            }
            .topnav .search-container {
            float: right;
            }
            .topnav input[type=text] {
            padding: 6px;
            margin-top: 8px;
            font-size: 17px;
            border: none;
            }
            .topnav .search-container button {
            float: right;
            padding: 6px 10px;
            margin-top: 8px;
            margin-right: 16px;
            background: #ddd;
            font-size: 17px;
            border: none;
            cursor: pointer;
            }
            .topnav .search-container button:hover {
            background: #ccc;
            }
            @media screen and (max-width: 600px) {
            .topnav .search-container {
                float: none;
            }
            .topnav a, .topnav input[type=text], .topnav .search-container button {
                float: none;
                display: block;
                text-align: left;
                width: 100%;
                margin: 0;
                padding: 14px;
            }
            .topnav input[type=text] {
                border: 1px solid #ccc;  
            }
            }
        </style>
        
    </head>
    <body class="antialiased">
      
        <div class="topnav">
            <a class="active" href="#home">Home</a>
           
            <div class="search-container">
                <form action="/action_page.php">
                <input type="text" placeholder="Buscar.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>

        <div style="padding-left:16px">
                <br>
                <center><h1 class="text-2xl text-blue-800 font-semibold mb-2">Cartelera</h1></center>
                <br>
        </div>
   
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            @foreach (range(0, count($data['results'])-1) as $number)
            <!-- {{ $ruta_poster =  $data ['results'][$number]['poster_path'] }}
            {{ $title =             $data ['results'][$number]['title'] }}
            {{ $original_language = $data ['results'][$number]['original_language'] }}
            {{ $original_title =    $data ['results'][$number]['original_title'] }}
            {{ $release_date =      $data ['results'][$number]['release_date'] }}
            {{ $overview =          $data ['results'][$number]['overview'] }} -->
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="flex items-center p-4 w-[920px]">
                        <div class="w-3/12">
                            <img src="https://www.themoviedb.org/t/p/w220_and_h330_face{{$ruta_poster}}" alt="Poster" class="rounded ">
                        </div>
                        <div class="w-9/12">
                            <div class="ml-5">
                            <p>Pelicula: </p>

                                <h2 class="text-2xl text-gray-900 font-semibold mb-2">{{ $title}}</h2>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                <h1 class="text-gray-500">Genero</h1>
                                {{ $lista_de_generos }}

                                </div>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <h1 class="text-gray-500">Idioma</h1>
                                    <p class="leading-6 text-sm">{{ $original_language}}</p>
                                </div>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <h1 class="text-gray-500">Titulo original</h1>
                                    <p class="leading-6 text-sm">{{ $original_title}}</p>
                                </div>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <h1 class="text-gray-500">Lanzamiento</h1>
                                    <p class="leading-6 text-sm">{{ $release_date}}</p>
                                </div>
                                <p class="leading-6 mt-5 text-gray-500">{{ $overview}}</p>
                                <br>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <button onclick="guardar_pelicula('{{ $data ['results'][$number]['title'] }}',
                                                                      '{{ $data ['results'][$number]['release_date'] }}',
                                                                      '{{ $data ['results'][$number]['original_language'] }}',
                                                                      '{{ $data ['results'][$number]['original_title'] }}',
                                                                      '{{ $data ['results'][$number]['overview'] }}',
                                                                      '{{ $data ['results'][$number]['poster_path'] }}',
                                                                       )" 
                                    class="btn" style="width:100%"><i class="fa fa-download"></i> Guardar Pelicula</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pelis Api</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- TailwindCss CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            .btn {
            background-color: DodgerBlue;
            border: none;
            color: white;
            padding: 12px 0px;
            cursor: pointer;
            font-size: 20px;
            }

            /* Darker background on mouse-over */
            .btn:hover {
            background-color: RoyalBlue;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @foreach (range(0, count($data['results'])-1) as $number)
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="flex items-center p-4 w-[920px]">
                        <div class="w-3/12">
                            <img src="https://www.themoviedb.org/t/p/w220_and_h330_face{{ $data ['results'][$number]['poster_path'] }}" alt="Poster" class="rounded ">
                        </div>
                        <div class="w-9/12">
                            <div class="ml-5">
                            <p>Resultado #: {{ $number }}</p>

                                <h2 class="text-2xl text-gray-900 font-semibold mb-2">{{ $data ['results'][$number]['title'] }}</h2>
                                
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <h1 class="text-gray-500">Idioma</h1>
                                    <p class="leading-6 text-sm">{{ $data ['results'][$number]['original_language'] }}</p>
                                </div>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <h1 class="text-gray-500">Titulo original</h1>
                                    <p class="leading-6 text-sm">{{ $data ['results'][$number]['original_title'] }}</p>
                                </div>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <h1 class="text-gray-500"></h1>
                                    <p class="leading-6 text-sm">{{ $data ['results'][$number]['adult'] }}</p>
                                </div>
                                <p class="leading-6 mt-5 text-gray-500">{{ $data ['results'][$number]['overview'] }}</p>
                                <br>
                                <div class="flex items-center space-x-2 tracking-wide pb-1">
                                    <button class="btn" style="width:100%"><i class="fa fa-download"></i> Guardar Pelicula</button>
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
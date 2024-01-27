<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Peliculas favoritas</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- TailwindCss CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <script>

            function eliminar_pelicula(id_pelicula)
            {
                
                const url = `/v1/pelis/delete/${id_pelicula}`;

                // Realizar la solicitud DELETE
                fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la solicitud.');
                    }
                    alert ('¡Pelicula eliminada correctamente!');
                    /* return response.json(); */
                })
                .then(data => {
                    console.log('Respuesta del servidor:', data);
                    
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }


            function listar_peliculas() 
            {
                // URL del servicio
                const apiUrl = 'http://127.0.0.1:8000/v1/pelis/list';
                // Realizar la solicitud GET utilizando Fetch
                fetch('/v1/pelis/list', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                }
            }) .then(response => {
                    // Verificar si la solicitud fue exitosa (código de respuesta 200)
                    if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                    }                   
                    // Convertir la respuesta a formato JSON
                    return response.json();
                })
                .then(data => {
    console.info(data);
    // Manipular los datos recibidos
    const listaPeliculas = document.getElementById('listaPeliculas');

    // Iterar sobre las películas y agregarlas a la lista
    data.forEach(pelicula => {
        // Crear elementos para cada propiedad de la película
        const listItem = document.createElement('div');
        const idElement = document.createElement('h1');
        const nombreElement = document.createElement('h1');
        const tituloOriginalElement = document.createElement('h2');
        const lanzamientoElement = document.createElement('h2');
        const lenguajeElement = document.createElement('h2');
        const resumenElement = document.createElement('h2');
        const posterElement = document.createElement('h2');
        const brElement = document.createElement('br');
        const buttonElement = document.createElement('button');

        // Asignar el contenido de cada propiedad a los elementos correspondientes
        idElement.textContent = `Id: ${pelicula.id}`;
        nombreElement.textContent = `Nombre: ${pelicula.nombre}`;
        tituloOriginalElement.textContent = `Título Original: ${pelicula.titulo_original}`;
        lanzamientoElement.textContent = `Lanzamiento: ${pelicula.lanzamiento}`;
        lenguajeElement.textContent = `Lenguaje: ${pelicula.lenguaje}`;
        resumenElement.textContent = `Resumen: ${pelicula.resumen}`;
        posterElement.textContent = `Poster: ${pelicula.poster}`;
        buttonElement.textContent = 'Eliminar de favoritos'; // Puedes cambiar el texto del botón según tus necesidades

        // Agregar elementos a listItem
        listItem.appendChild(idElement);
        listItem.appendChild(nombreElement);
        listItem.appendChild(tituloOriginalElement);
        listItem.appendChild(lanzamientoElement);
        listItem.appendChild(lenguajeElement);
        listItem.appendChild(resumenElement);
        listItem.appendChild(posterElement);
        listItem.appendChild(brElement);
        listItem.appendChild(buttonElement);

        // Agregar listItem a listaPeliculas
        listaPeliculas.appendChild(listItem);
        
        // Agregar un evento al botón (puedes cambiar 'click' por otro evento según tus necesidades)
        buttonElement.addEventListener('click', () => {
            // Lógica para manejar el clic en el botón
            console.log(`Detalles de la película: ${pelicula.nombre}`);
            console.log(`Detalles de la película: ${pelicula.id}`);
            eliminar_pelicula(`${pelicula.id}`);
            // Agrega aquí la lógica que desees realizar al hacer clic en el botón
        });
    });
})

                .catch(error => {
                    // Capturar y manejar cualquier error que pueda ocurrir durante la solicitud
                    console.error('Error durante la solicitud:', error);
                });

            }

            listar_peliculas();

            function guardar_pelicula(title,release_date,original_language,original_title,overview,poster_path) {
            // aqui se define los datos que se desea enviar al servidor
            var datos = {
                nombre: title,
                lanzamiento: release_date,
                lenguaje: original_language,
                titulo_original: original_title,
                resumen: overview,
                poster: poster_path
            };

            // Realiza la solicitud al servicio de Laravel
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

        <!-- estilo para el boton guardar -->
        <style>
            .btn {
                background-color: DodgerBlue;
                border: none;
                color: white;
                padding: 12px 0px;
                cursor: pointer;
                font-size: 20px;
            }
            
            .btn:hover {
                background-color: RoyalBlue;
            }
        </style>
            <!-- fin estilo para el boton guardar -->

            <!-- estilo para el menu -->
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
            <!-- fin de estilo para el menu -->
    </head>
    <body class="antialiased">
        <!-- menu principal -->
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
                <center><h1 class="text-2xl text-blue-800 font-semibold mb-2">Favoritas</h1></center>
                <br>
        </div>
        <!-- fin del menu principal -->
        <div>
            <div id="listaPeliculas">

            </div>
        </div>
        
    </body>
</html>
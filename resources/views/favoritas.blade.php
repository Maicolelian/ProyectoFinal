<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Peliculas favoritas</title>

        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="https://cdn.tailwindcss.com"></script>

        <script>

            function eliminar_pelicula(id_pelicula)
            {
                
                const url = `/v1/pelis/delete/${id_pelicula}`;

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
                    return response.json();
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
               
                const apiUrl = 'http://127.0.0.1:8000/v1/pelis/list';                
                fetch('/v1/pelis/list', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                }
            }) .then(response => {
                    if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status}`);
                    }                   
                    
                    return response.json();
                })
                .then(data => {
                console.info(data);
            
                const listaPeliculas = document.getElementById('listaPeliculas');

                
                data.forEach(pelicula => {
                    
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

                    idElement.textContent = `Id: ${pelicula.id}`;
                    nombreElement.textContent = `Nombre: ${pelicula.nombre}`;
                    tituloOriginalElement.textContent = `Título Original: ${pelicula.titulo_original}`;
                    lanzamientoElement.textContent = `Lanzamiento: ${pelicula.lanzamiento}`;
                    lenguajeElement.textContent = `Lenguaje: ${pelicula.lenguaje}`;
                    resumenElement.textContent = `Resumen: ${pelicula.resumen}`;
                    posterElement.textContent = `Poster: ${pelicula.poster}`;
                    buttonElement.textContent = 'Eliminar de favoritos'; 

                    listItem.appendChild(idElement);
                    listItem.appendChild(nombreElement);
                    listItem.appendChild(tituloOriginalElement);
                    listItem.appendChild(lanzamientoElement);
                    listItem.appendChild(lenguajeElement);
                    listItem.appendChild(resumenElement);
                    listItem.appendChild(posterElement);
                    listItem.appendChild(brElement);
                    listItem.appendChild(buttonElement);

                    listaPeliculas.appendChild(listItem);
                    
                    buttonElement.addEventListener('click', () => {
                        
                        console.log(`Detalles de la película: ${pelicula.nombre}`);
                        console.log(`Detalles de la película: ${pelicula.id}`);
                        eliminar_pelicula(`${pelicula.id}`);
                    });
                });
            })

                .catch(error => {
                    console.error('Error durante la solicitud:', error);
                });

            }

            listar_peliculas();

            
        </script>

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
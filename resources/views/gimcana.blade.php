<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <!-- Enlace de Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <!-- Enlace Iconos FontAwesome-->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- ICONO -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
h1{
    color: #3498db;
    font-size: bold;
    font-size: 25px;
}
        .column-3 {
            float: left;
            width: 60%;
            height: 92vh;
            box-sizing: border-box;
            padding: 10px;
            display: flex;
            flex-direction: column;
        }

        .user-icon {
          margin-right: 10px;
        }

        .title-container {
          margin-top: 4px;
          font-size: 24px;
          padding: 8px;
          text-align: center;
        }

        .icon2 {
          height: 120px;
          width: auto;
        }


        /* Estilos para el contenido del infoWindow */
.info-window {
    max-width: 300px;
    padding: 10px;
    font-family: Arial, sans-serif;
}

.info-window h2 {
    margin-top: 0;
    font-size: 20px;
    font-weight: bold;
}

.info-window img {
    max-width: 100%;
    margin-bottom: 10px;
}

.info-window p {
    margin: 5px 0;
    line-height: 1.5;
}

.info-window p strong {
    font-weight: bold;
}





.column-2 {
    float: left;
    width: 40%;
    height: calc(100vh - 52px); /* Restamos el alto de la barra de navegación */
    box-sizing: border-box;
    padding: 10px;
    background-color: rgb(255, 255, 255);
    border-right: 2px solid rgb(219, 217, 217);
    overflow-y: auto; /* Agregamos desplazamiento vertical cuando el contenido exceda la altura */
}

/* Estilos para la tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto; /* Centrar la tabla horizontalmente */
    margin-top: 20px; /* Espacio superior */
    margin-bottom: 20px; /* Espacio inferior */
    border: 1px solid #ccc; /* Borde de la tabla */
}

/* Estilos para las celdas de encabezado */
th {
    background-color: #3498db; /* Azul */
    color: #fff; /* Texto blanco */
    padding: 10px;
    font-size: 15px;
    text-align: center;
}

/* Estilos para las celdas de datos */
td {
    padding: 10px;
    text-align: center; /* Centrar el contenido de las celdas */
    font-size: 13px;
    border-top: 1px solid #ccc; /* Borde superior de las celdas de datos */
}

/* Estilos para las filas impares (opcional) */
tr:nth-child(odd) {
    background-color: #ecf0f1; /* Azul claro */
}


/* Estilos para botones dentro de celdas */
button {
    background: none;
    border: none;
    cursor: pointer;
    outline: none;
}





/* Estilos para el Sweet Alert */
.swal2-popup {
    width: 50%;
    padding: 20px;
}

.swal2-title {
    font-size: 1.5rem;
}

.swal2-content label {
    display: block;
    margin-bottom: 5px;
}

.swal2-content input,
.swal2-content select {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

.swal2-content button[type="submit"] {
    width: 15%;
    padding: 10px;
    background-color: #3498db;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.swal2-content button[type="submit"]:hover {
    background-color: #3498db;
}

/* Estilos específicos para el botón de actualizar */
.swal2-content .btn-update {
    margin-top: 10px;
}

/* Estilos específicos para el botón de cerrar */
.swal2-cancel {
    margin-top: 10px;
}



#crear-tipo-ubicacion {
    background-color: #3498db;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
}

#crear-tipo-ubicacion:hover {
    background-color: #3498db;
}




    </style>
</head>

<body>
    <!-- <div class="column-1"> -->
      <nav class="navbar" role="navigation" aria-label="main navigation" style="border-bottom: 2px solid rgb(219, 217, 217);">
        <div class="navbar-brand">
            <a class="navbar-item" href="./mapa.html">
                <img src="./img/icon2.png" class="icon2" alt="icon">
            </a>
            <div class="title-container">
                <span class="navbar-title">Gimcana</span>
            </div>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
    
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" style="margin-left: 150px;">
                    Guia
                </a>
    
                <a class="navbar-item" onclick="mostrarSweetAlert()">
                    Gimcana
                </a>
                <a class="navbar-item">
                    Crear Tipo Ubicaciones
                </a>
    
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        More
                    </a>
    
                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item is-selected">
                            Jobs
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
            </div>
    
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-light" href="./index.html">
                            <img src="./img/user-icon.png" class="user-icon" alt="">
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    
    <div class="column-2">
        <h2 style="font-size: 24px; margin-bottom: 15px;">Nombre grupo: {{ $lobby->nombre_lobby }}</h2>
        @if($usuariosGrupo->isNotEmpty())
            <h3 style="font-size: 18px; margin-bottom: 10px;">Usuarios en el grupo ({{ $usuariosGrupo->count() }}/4):</h3>
            <ul style="list-style: none; padding-left: 0;">
                @foreach($usuariosGrupo as $usuario)
                    <li style="font-size: 16px; margin-bottom: 5px;">- {{ $usuario->name }}</li>
                @endforeach
            </ul>
            <button onclick="empezarAJugar()" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Empezar a jugar</button>
            <input type="text" id="pistaText" style="margin-top: 20px; width: 100%; padding: 10px; font-size: 16px;" readonly>

            <script>
    function empezarAJugar() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "La lobby se cerrará y empezará la gimcana. ¿Deseas continuar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, empezar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Cerrar la lobby
                fetch('/cerrar-lobby', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        lobby_id: {{ $lobby->id }}
                    })
                }).then(response => {
                    if (response.ok) {
                        // Obtener la primera ubicación de la gimcana
                        fetch('/primera-ubicacion', {
                            method: 'GET', // Cambiado a GET
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Agregado token como header
                            }
                        }).then(response => {
    if (response.ok) {
        return response.json();
    } else if (response.status === 404) {
        throw new Error('No se encontró la primera ubicación de la gimcana');
    } else {
        throw new Error('Ha ocurrido un error al obtener la pista de la primera ubicación.');
    }
})
.then(data => {
                            // Mostrar la pista en el campo de texto y en el Sweet Alert
                            document.getElementById('pistaText').value = data.pista;
                            Swal.fire({
                                title: 'Pista de la primera ubicación:',
                                text: data.pista,
                                icon: 'info',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Aceptar'
                            });
                        }).catch(error => {
                            console.error(error);
                            Swal.fire({
                                title: 'Error',
                                text: 'Ha ocurrido un error al obtener la pista de la primera ubicación.',
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Aceptar'
                            });
                        });
                    } else {
                        throw new Error('Error al cerrar la lobby');
                    }
                }).catch(error => {
                    console.error(error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Ha ocurrido un error al cerrar la lobby.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar'
                    });
                });
            }
        });
    }
            </script>
        @else
            <p style="font-size: 16px;">No hay usuarios en el grupo.</p>
        @endif
    </div>
    
    
    
    
    


    <div class="column-3" id="map">
   
    </div>
</body>
<script>





  function initMap() {
      var mapOptions = {
          center: { lat: 41.362273, lng: 2.122864 }, // Coordenadas centrales del mapa
          zoom: 14, // Nivel de zoom inicial
          styles: [
              { elementType: "labels", stylers: [{ visibility: "off" }] } // Oculta todas las etiquetas, incluidos los nombres de las ciudades
          ]
      };
      
      

      var map = new google.maps.Map(document.getElementById("map"), mapOptions);


            // Obtener la ubicación actual del usuario
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var userLocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    // Crear marcador en la ubicación actual del usuario
                    var userMarker = new google.maps.Marker({
                        position: userLocation,
                        map: map,
                        title: 'Tu ubicación actual',
                        icon: {
                            url: "{{ asset('img/gimcana.png') }}", // Ruta de la imagen del marcador
                            scaledSize: new google.maps.Size(40, 40) // Tamaño del icono
                        },
                        optimized: false, // Desactivar la optimización de la imagen para que se apliquen los estilos
                    });


// Función para animar el círculo
function expandCircle() {
    var circle = new google.maps.Circle({
        strokeColor: '#0000FF',
        strokeOpacity: 0.3,
        strokeWeight: 2,
        fillColor: '#0000FF',
        fillOpacity: 0.1,
        map: map,
        center: userLocation,
        radius: 0 // Inicia con radio 0 para la animación
    });

    function animate() {
        var currentRadius = circle.getRadius();
        if (currentRadius < 700) { // Define el radio máximo que deseas alcanzar
            circle.setRadius(currentRadius + 100); // Incrementa el radio en 100 metros
        } else {
            clearInterval(animationInterval); // Detiene la animación cuando alcanza el radio máximo
            setTimeout(function() {
                // Desaparecer el círculo durante 2 segundos antes de reiniciar la animación
                circle.setRadius(0); // Establecer el radio a 0 para que desaparezca
                setTimeout(expandCircle, 1000); // Reinicia la animación después de 2 segundos
            }, 1000); // Espera 2 segundos antes de desaparecer el círculo
        }
    }

    // Iniciar la animación
    var animationInterval = setInterval(animate, 100); // Se ejecuta cada 100 milisegundos
}

expandCircle(); // Iniciar la animación por primera vez

                }, function () {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // El navegador no soporta la geolocalización
                handleLocationError(false, infoWindow, map.getCenter());
            }


        }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>



</html>

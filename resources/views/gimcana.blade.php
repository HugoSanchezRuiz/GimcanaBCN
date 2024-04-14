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

h2 {
    font-size: 24px;
    margin-bottom: 15px;
    color: black;
    font-weight: bold;
}

h3 {
    color: black;
    font-size: 18px;
    margin-bottom: 10px;
}

ul {
    color: black;
    list-style: none;
    padding-left: 0;
}

li {
    color: black;
    font-size: 16px;
    margin-bottom: 5px;
}

#startButton {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 10px;
}

#startButton:hover {
    background-color: #45a049;
}

input[type="text"] {
    width: 600px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #f2f2f2;
    color: #333;
    font-size: 16px;
}

input[type="text"]:focus {
    outline: none;
    border-color: #4CAF50;
    box-shadow: 0 0 8px rgba(0, 128, 0, 0.6);
}
p {
    color: black;
    font-size: 16px;
    margin-bottom: 5px;
}
@media screen and (max-width: 800px) {
            .jimcana-button {
                padding: 15px 25px; /* Ajustar el padding para dispositivos más pequeños */
            }

            .column-2 {
                width: 100%;
                height: 50vh;
                padding-bottom: 100px;
            }
        
            .column-3 {
                width: 100%;
                height: 45vh;
            }
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
        @if ($usuariosGrupo->isNotEmpty())
            <h3 style="font-size: 18px; margin-bottom: 10px;">Usuarios en el grupo ({{ $usuariosGrupo->count() }}/4):</h3>
            <ul style="list-style: none; padding-left: 0;">
                @foreach ($usuariosGrupo as $usuario)
                    <li style="font-size: 16px; margin-bottom: 5px;">- {{ $usuario->name }}</li> @endforeach
            </ul>
            <button id="startButton"
        onclick="empezarAJugar()"
        style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    Empezar a jugar</button><br><br>

    <div style="margin-bottom: 10px;">
        <p style="font-size: 16px; margin-bottom: 5px;">Pista ubicación 1:</p>
        <input type="text" id="pista1" readonly style="width: 600px;">
    </div>
    <div style="margin-bottom: 10px;">
        <p style="font-size: 16px; margin-bottom: 5px;">Pista ubicación 2:</p>
        <input type="text" id="pista2" readonly style="width: 600px;">
    </div>
    <div style="margin-bottom: 10px;">
        <p style="font-size: 16px; margin-bottom: 5px;">Pista ubicación 3:</p>
        <input type="text" id="pista3" readonly style="width: 600px;">
    </div>
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
                center: {
                    lat: 41.362273,
                    lng: 2.122864
                }, // Coordenadas centrales del mapa
                zoom: 14, // Nivel de zoom inicial
                styles: [{
                        elementType: "labels",
                        stylers: [{
                            visibility: "off"
                        }]
                    } // Oculta todas las etiquetas, incluidos los nombres de las ciudades
                ]
            };



            var map = new google.maps.Map(document.getElementById("map"), mapOptions);


            // Obtener la ubicación actual del usuario
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
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
                                clearInterval(
                                    animationInterval); // Detiene la animación cuando alcanza el radio máximo
                                setTimeout(function() {
                                    // Desaparecer el círculo durante 2 segundos antes de reiniciar la animación
                                    circle.setRadius(0); // Establecer el radio a 0 para que desaparezca
                                    setTimeout(expandCircle,
                                        1000); // Reinicia la animación después de 2 segundos
                                }, 1000); // Espera 2 segundos antes de desaparecer el círculo
                            }
                        }

                        // Iniciar la animación
                        var animationInterval = setInterval(animate, 100); // Se ejecuta cada 100 milisegundos
                    }

                    expandCircle(); // Iniciar la animación por primera vez

                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // El navegador no soporta la geolocalización
                handleLocationError(false, infoWindow, map.getCenter());
            }


        }


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
                    // Realizar la solicitud para cerrar la lobby
                    fetch('/cerrar-lobby', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            lobby_id: {{ $lobby->id }}
                        })
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error('Error al cerrar la lobby');
                        }
                        // Una vez que la lobby esté cerrada, enviar la solicitud para obtener la ubicación
                        return fetch('/obtener-ubicacion', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({
                                ubicacion_id: 13 // ID de la ubicación que deseas obtener
                            })
                        });
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error('Error al obtener la ubicación');
                        }
                        return response.json();
                    }).then(data => {
                        // Mostrar la ubicación en el mapa
                        var button = document.getElementById('startButton');
                        button.textContent = 'Gimcana en curso';
                        button.disabled = true;
                        // Configuración del mapa
                        var mapOptions = {
                            center: {
                                lat: 41.362273,
                                lng: 2.122864
                            }, // Coordenadas centrales del mapa
                            zoom: 14, // Nivel de zoom inicial
                            styles: [{
                                    elementType: "labels",
                                    stylers: [{
                                        visibility: "off"
                                    }]
                                } // Oculta todas las etiquetas, incluidos los nombres de las ciudades
                            ]
                        };

                        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                        // Obtener la ubicación actual del usuario
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
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
                                        scaledSize: new google.maps.Size(40,
                                            40) // Tamaño del icono
                                    },
                                    optimized: false // Desactivar la optimización de la imagen para que se apliquen los estilos
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
                                        if (currentRadius <
                                            700) { // Define el radio máximo que deseas alcanzar
                                            circle.setRadius(currentRadius +
                                                100); // Incrementa el radio en 100 metros
                                        } else {
                                            clearInterval(
                                                animationInterval
                                            ); // Detiene la animación cuando alcanza el radio máximo
                                            setTimeout(function() {
                                                    // Desaparecer el círculo durante 2 segundos antes de reiniciar la animación
                                                    circle.setRadius(
                                                        0
                                                    ); // Establecer el radio a 0 para que desaparezca
                                                    setTimeout(expandCircle,
                                                        1000
                                                    ); // Reinicia la animación después de 2 segundos
                                                },
                                                1000
                                            ); // Espera 2 segundos antes de desaparecer el círculo
                                        }
                                    }

                                    // Iniciar la animación
                                    var animationInterval = setInterval(animate,
                                        100); // Se ejecuta cada 100 milisegundos
                                }

                                expandCircle(); // Iniciar la animación por primera vez

                                // Mostrar la ubicación en el mapa
                                var ubicacion = {
                                    lat: parseFloat(data.latitud),
                                    lng: parseFloat(data.longitud)
                                };
                                var marker = new google.maps.Marker({
                                    position: ubicacion,
                                    map: map,
                                    title: 'Ubicación Uno',
                                    visible: false // Configurar el marcador como invisible
                                });

                                // Crear el círculo alrededor de la ubicación
                                var circle = new google.maps.Circle({
                                    strokeColor: '#0000FF',
                                    strokeOpacity: 0, // Hacer el borde invisible
                                    strokeWeight: 2,
                                    fillColor: '#0000FF',
                                    fillOpacity: 0, // Hacer el relleno invisible
                                    map: map,
                                    center: ubicacion,
                                    radius: 50 // Radio del círculo en metros
                                });


                                // Obtener la ubicación actual del usuario
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(function(position) {
                                        var userLocation = {
                                            lat: position.coords.latitude,
                                            lng: position.coords.longitude
                                        };

                                        // Verificar si la ubicación del usuario está dentro del radio
                                        if (google.maps.geometry.spherical
                                            .computeDistanceBetween(userLocation, circle
                                                .getCenter()) <= circle.getRadius()) {
                                            Swal.fire({
                                                title: '¡Has encontrado la primera ubicación!',
                                                text: '¡Felicidades!',
                                                icon: 'success',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Aceptar'
                                            }).then(() => {
                                                // Realizar la solicitud para obtener la ubicación dos
                                                return fetch(
                                                    '/obtener-ubicacion-dos', {
                                                        method: 'POST',
                                                        headers: {
                                                            'Content-Type': 'application/json',
                                                            'X-CSRF-TOKEN': document
                                                                .querySelector(
                                                                    'meta[name="csrf-token"]'
                                                                )
                                                                .getAttribute(
                                                                    'content')
                                                        },
                                                        body: JSON.stringify({
                                                            ubicacion_id: 14 // ID de la ubicación dos que deseas obtener
                                                        })
                                                    });
                                            }).then(response => {
                                                if (!response.ok) {
                                                    throw new Error(
                                                        'Error al obtener la ubicación dos'
                                                    );
                                                }
                                                return response.json();
                                            }).then(data => {
                                                // Mostrar la ubicación dos en el mapa
                                                var ubicacionDos = {
                                                    lat: parseFloat(data
                                                        .latitud),
                                                    lng: parseFloat(data
                                                        .longitud)
                                                };
                                                var markerDos = new google.maps
                                                    .Marker({
                                                        position: ubicacionDos,
                                                        map: map,
                                                        title: 'Ubicación Dos',
                                                        visible: false // Configurar el marcador como invisible
                                                    });

                                                var marker = new google.maps
                                            .Marker({
                                                    position: ubicacion,
                                                    map: map,
                                                    title: 'Ubicación Uno',
                                                });

                                                // Crear un cuadro de información para mostrar el título del marcador
                                                var infoWindow = new google.maps
                                                    .InfoWindow({
                                                        content: marker
                                                            .getTitle() // Obtener el título del marcador
                                                    });

                                                // Agregar un evento de clic al marcador para mostrar el cuadro de información
                                                marker.addListener('click',
                                                    function() {
                                                        infoWindow.open(map,
                                                            marker
                                                        ); // Mostrar el cuadro de información en el mapa en la posición del marcador
                                                    });


                                                // Crear el círculo alrededor de la segunda ubicación
                                                var circleDos = new google.maps
                                                    .Circle({
                                                        strokeColor: '#0000FF',
                                                        strokeOpacity: 0, // Hacer el borde invisible
                                                        strokeWeight: 2,
                                                        fillColor: 'blue',
                                                        fillOpacity: 1, // Hacer el relleno invisible
                                                        map: map,
                                                        center: ubicacionDos,
                                                        radius: 50 // Radio del círculo en metros
                                                    });

                                                // Obtener la ubicación actual del usuario
                                                if (navigator.geolocation) {
                                                    navigator.geolocation
                                                        .getCurrentPosition(
                                                            function(position) {
                                                                var userLocation = {
                                                                    lat: position
                                                                        .coords
                                                                        .latitude,
                                                                    lng: position
                                                                        .coords
                                                                        .longitude
                                                                };

                                                                // Verificar si la ubicación del usuario está dentro del radio
                                                                if (google.maps
                                                                    .geometry
                                                                    .spherical
                                                                    .computeDistanceBetween(
                                                                        userLocation,
                                                                        circleDos
                                                                        .getCenter()
                                                                    ) <= circleDos
                                                                    .getRadius()) {
                                                                    Swal.fire({
                                                                        title: '¡Has encontrado la segunda ubicación!',
                                                                        text: '¡Felicidades! Ya solo te queda una.',
                                                                        icon: 'success',
                                                                        confirmButtonColor: '#3085d6',
                                                                        confirmButtonText: 'Aceptar'
                                                                    }).then(
                                                                        () => {
                                                                            // Realizar la solicitud para obtener la ubicación tres
                                                                            return fetch(
                                                                                '/obtener-ubicacion-tres', {
                                                                                    method: 'POST',
                                                                                    headers: {
                                                                                        'Content-Type': 'application/json',
                                                                                        'X-CSRF-TOKEN': document
                                                                                            .querySelector(
                                                                                                'meta[name="csrf-token"]'
                                                                                            )
                                                                                            .getAttribute(
                                                                                                'content'
                                                                                            )
                                                                                    },
                                                                                    body: JSON
                                                                                        .stringify({
                                                                                            ubicacion_id: 15 // ID de la ubicación tres que deseas obtener
                                                                                        })
                                                                                }
                                                                            );
                                                                        }).then(
                                                                        response => {
                                                                            if (!
                                                                                response
                                                                                .ok
                                                                            ) {
                                                                                throw new Error(
                                                                                    'Error al obtener la ubicación tres'
                                                                                );
                                                                            }
                                                                            return response
                                                                                .json();
                                                                        }).then(
                                                                        data => {
                                                                            // Mostrar la ubicación tres en el mapa
                                                                            var ubicacionTres = {
                                                                                lat: parseFloat(
                                                                                    data
                                                                                    .latitud
                                                                                ),
                                                                                lng: parseFloat(
                                                                                    data
                                                                                    .longitud
                                                                                )
                                                                            };
                                                                            var markerTres =
                                                                                new google
                                                                                .maps
                                                                                .Marker({
                                                                                    position: ubicacionTres,
                                                                                    map: map,
                                                                                    title: 'Ubicación Tres',
                                                                                    visible: false // Configurar el marcador como invisible
                                                                                });

                                                                            var markerDos =
                                                                                new google
                                                                                .maps
                                                                                .Marker({
                                                                                    position: ubicacionDos,
                                                                                    map: map,
                                                                                    title: 'Ubicación Dos',
                                                                                });

                                                                            // Crear un cuadro de información para mostrar el título del marcador
                                                                            var infoWindowDos =
                                                                                new google
                                                                                .maps
                                                                                .InfoWindow({
                                                                                    content: markerDos
                                                                                        .getTitle() // Obtener el título del marcador
                                                                                });

                                                                            // Agregar un evento de clic al marcador para mostrar el cuadro de información
                                                                            markerDos
                                                                                .addListener(
                                                                                    'click',
                                                                                    function() {
                                                                                        infoWindowDos
                                                                                            .open(
                                                                                                map,
                                                                                                markerDos
                                                                                            ); // Mostrar el cuadro de información en el mapa en la posición del marcador
                                                                                    }
                                                                                );


                                                                            // Crear el círculo alrededor de la tercera ubicación
                                                                            var circleTres =
                                                                                new google
                                                                                .maps
                                                                                .Circle({
                                                                                    strokeColor: '#0000FF',
                                                                                    strokeOpacity: 0, // Hacer el borde invisible
                                                                                    strokeWeight: 2,
                                                                                    fillColor: '#0000FF',
                                                                                    fillOpacity: 0, // Hacer el relleno invisible
                                                                                    map: map,
                                                                                    center: ubicacionTres,
                                                                                    radius: 50 // Radio del círculo en metros
                                                                                });

                                                                            // Obtener la ubicación actual del usuario
                                                                            if (navigator
                                                                                .geolocation
                                                                            ) {
                                                                                navigator
                                                                                    .geolocation
                                                                                    .getCurrentPosition(
                                                                                        function(
                                                                                            position
                                                                                        ) {
                                                                                            var userLocation = {
                                                                                                lat: position
                                                                                                    .coords
                                                                                                    .latitude,
                                                                                                lng: position
                                                                                                    .coords
                                                                                                    .longitude
                                                                                            };

                                                                                            // Verificar si la ubicación del usuario está dentro del radio
                                                                                            if (google
                                                                                                .maps
                                                                                                .geometry
                                                                                                .spherical
                                                                                                .computeDistanceBetween(
                                                                                                    userLocation,
                                                                                                    circleTres
                                                                                                    .getCenter()
                                                                                                ) <=
                                                                                                circleTres
                                                                                                .getRadius()
                                                                                            ) {
                                                                                                Swal.fire({
                                                                                                    title: '¡Felicidades has conseguido superar la gimcana!',
                                                                                                    text: '¡Has encontrado la tercera ubicación!',
                                                                                                    icon: 'success',
                                                                                                    confirmButtonColor: '#3085d6',
                                                                                                    confirmButtonText: 'Aceptar'
                                                                                                });

                                                                                                var markerTres =
                                                                                                    new google
                                                                                                    .maps
                                                                                                    .Marker({
                                                                                                        position: ubicacionTres,
                                                                                                        map: map,
                                                                                                        title: 'Ubicación Tres',
                                                                                                    });

                                                                                                // Crear un cuadro de información para mostrar el título del marcador
                                                                                                var infoWindowTres =
                                                                                                    new google
                                                                                                    .maps
                                                                                                    .InfoWindow({
                                                                                                        content: markerTres
                                                                                                            .getTitle() // Obtener el título del marcador
                                                                                                    });

                                                                                                // Agregar un evento de clic al marcador para mostrar el cuadro de información
                                                                                                markerTres
                                                                                                    .addListener(
                                                                                                        'click',
                                                                                                        function() {
                                                                                                            infoWindowTres
                                                                                                                .open(
                                                                                                                    map,
                                                                                                                    markerTres
                                                                                                                ); // Mostrar el cuadro de información en el mapa en la posición del marcador
                                                                                                        }
                                                                                                    );

                                                                                            }
                                                                                        },
                                                                                        function() {
                                                                                            handleLocationError
                                                                                                (true,
                                                                                                    infoWindow,
                                                                                                    map
                                                                                                    .getCenter()
                                                                                                );
                                                                                        }
                                                                                    );
                                                                            } else {
                                                                                // El navegador no soporta la geolocalización
                                                                                handleLocationError
                                                                                    (false,
                                                                                        infoWindow,
                                                                                        map
                                                                                        .getCenter()
                                                                                    );
                                                                            }
                                                                            // Mostrar la pista obtenida en pista3
                                                                            document
                                                                                .getElementById(
                                                                                    'pista3'
                                                                                )
                                                                                .value =
                                                                                data
                                                                                .Pista;
                                                                        });
                                                                }

                                                            },
                                                            function() {
                                                                handleLocationError(
                                                                    true,
                                                                    infoWindow,
                                                                    map
                                                                    .getCenter()
                                                                );
                                                            });
                                                } else {
                                                    // El navegador no soporta la geolocalización
                                                    handleLocationError(false,
                                                        infoWindow, map
                                                        .getCenter());
                                                }



                                                // Mostrar la pista obtenida
                                                document.getElementById('pista2')
                                                    .value = data.Pista;

                                                // Mostrar mensaje de éxito
                                                Swal.fire({
                                                    title: 'El siguiente punto es...',
                                                    text: 'Comprueba el campo pista 2 para conseguirlo',
                                                    icon: 'success',
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonText: 'Aceptar'
                                                });
                                            }).catch(error => {
                                                console.error('Error:', error);
                                                Swal.fire({
                                                    title: 'Error',
                                                    text: 'Ha ocurrido un error al obtener la ubicación dos.',
                                                    icon: 'error',
                                                    confirmButtonColor: '#3085d6',
                                                    confirmButtonText: 'Aceptar'
                                                });
                                            });
                                        }

                                    }, function() {
                                        handleLocationError(true, infoWindow, map
                                            .getCenter());
                                    });
                                } else {
                                    // El navegador no soporta la geolocalización
                                    handleLocationError(false, infoWindow, map.getCenter());
                                }


                                // Mostrar la pista obtenida
                                document.getElementById('pista1').value = data.Pista;

                                // Mostrar mensaje de éxito
                                Swal.fire({
                                    title: 'Acabas de empezar en la Gimcana Hospitalet',
                                    text: 'Comprueba el campo pista 1 para intentar descifrar la ubicacion.',
                                    icon: 'success',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                });
                            }).catch(error => {
                                console.error('Error:', error);
                                Swal.fire({
                                    title: 'Error',
                                    text: 'Ha ocurrido un error al cerrar la lobby o al obtener la ubicación.',
                                    icon: 'error',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Aceptar'
                                });
                            });
                        }
                    });
                }
            })
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>



</html>

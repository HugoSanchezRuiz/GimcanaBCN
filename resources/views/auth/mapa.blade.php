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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- ICONO -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">

    <style>
        .column-2 {
            float: left;
            width: 20%;
            height: 92vh;
            box-sizing: border-box;
            /* padding: 10px; */
            background-color: rgb(255, 255, 255);
            border-right: 2px solid rgb(219, 217, 217);
        }
        
        .column-3 {
            float: left;
            width: 80%;
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

        .etiquetas {
            background-color: rgb(255, 255, 255);
            padding: 10px;
            height: 80%;
        }

        .boton-aceptar {
            background-color: aqua;
            display: flex;
            justify-content: flex-end; 
            margin: 10px;
            margin-left: auto;
            width: 20%;
            height: 100%;
        }

        .sala {
            height: 20%;
            background-color: rgb(76, 71, 71);
            margin: 20px;
        }

        .jimcana {
            background-color: rgb(255, 255, 255); 
            padding: 10px;
            height: 20%;
        }

        .jimcana-button {
            background: linear-gradient(180deg, rgba(69,196,176,1) 0%, rgba(19,103,138,1) 100%); /* https://cssgradient.io/ */
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            padding: 10px;
            margin-bottom: 10px;
        }

        .jimcana-button2 {
            background: linear-gradient(180deg, rgba(69,196,176,1) 0%, rgba(19,103,138,1) 100%); /* https://cssgradient.io/ */
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            padding: 10px;
        }

        .jimcana-button:hover {
            transform: scale(1.05);
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);
        }

        .jimcana-button2:hover {
            transform: scale(1.05);
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.5);
        }

        @media screen and (max-width: 800px) {
            .jimcana-button {
                padding: 15px 25px; /* Ajustar el padding para dispositivos más pequeños */
            }

            .column-2 {
                width: 40%;
                height: 92vh;
            }
        
            .column-3 {
                width: 60%;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <!-- <div class="column-1"> -->
    <nav class="navbar" role="navigation" aria-label="main navigation" style="border-bottom: 2px solid rgb(219, 217, 217);">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('/mapa') }}">
                <img src="{{ asset('img/icon2.png') }}" class="icon2" alt="icon">
            </a>
            <div class="title-container">
                <span class="navbar-title">Vista Cliente</span>
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
                    Home
                </a>

                <a class="navbar-item">
                    Documentation
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
                        <a class="button is-light" href="{{ url('/login') }}">
                            <img src="{{ asset('img/user-icon.png') }}" class="user-icon" alt="">
                            <p>Logout</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- </div> -->
    <div class="column-2">
        <div class='etiquetas'>
            <div class='sala'>
                {{-- <div class='boton-aceptar'> --}}
                    <button class="button is-success boton-aceptar">Success</button>
                {{-- </div> --}}
            </div>
            <div class='sala'>

            </div>
            <div class='sala'>

            </div>
        </div>
        <div class='jimcana'>
            <input class="button is-info is-rounded is-large is-fullwidth jimcana-button" value='Crear Sala' id='CrearSala'>
            <input class="button is-info is-rounded is-large is-fullwidth jimcana-button2" value='Unirse a Sala' id='UnirseSala'>
        </div>
    </div>
    <div class="column-3" id="map">
    </div>
</body>
<script>
    
  function initMap() {
      var mapOptions = {
          center: { lat: 41.4036, lng: 2.1744 }, // Coordenadas centrales del mapa
          zoom: 12, // Nivel de zoom inicial
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
                            url: "{{ asset('img/marcadoradmin1.png') }}", // Ruta de la imagen del marcador
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

userID = 2; // <-- PRUEBA MANUEL DE ID DE USER

@foreach ($ubicaciones as $ubicacion)
    addMarker({{ $ubicacion->latitud }}, {{ $ubicacion->longitud }}, '{{ $ubicacion->id }}', '{{ $ubicacion->nombre }}', '{{ asset("img/$ubicacion->imagen") }}', '{{ $ubicacion->ciudad }}', '{{ $ubicacion->calle }}', '{{ $ubicacion->num_calle }}', '{{ $ubicacion->codigo_postal }}', '{{ $ubicacion->descripcion }}','{{ $ubicacion->ha_dado_like }}'); @endforeach

      function addMarker(lat, lng, id, nombre, imagen, ciudad, calle, numCalle, codigoPostal, descripcion, ha_dado_like) {
    var ubicacionMarker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,
        title: nombre
    });

    var infoWindowContent = `<div class="info-window">
    <h2 style="color: black;">${nombre}</h2>
    <img src="${imagen}" alt="Imagen de ubicación">
    <p><strong style="color: black;">Ciudad:</strong> <span style="color: grey;">${ciudad}</span></p>
    <p><strong style="color: black;">Calle:</strong> <span style="color: grey;">${calle}</span></p>
    <p><strong style="color: black;">Número de Calle:</strong> <span style="color: grey;">${numCalle}</span></p>
    <p><strong style="color: black;">Código Postal:</strong> <span style="color: grey;">${codigoPostal}</span></p>
    <p><span style="color: grey;">${descripcion}</span></p>`;


    // Si el usuario ha dado like...
    if (ha_dado_like == 1) {
        infoWindowContent += `<p><button onclick="quitarLike(${id}, ${userID})">No me gusta</button></p>`;
    // Si el usuario no ha dado like...
    } else {
        infoWindowContent += `<p><button onclick="darLike(${id}, ${userID})">Me gusta</button></p>`;
    }




    var infoWindow = new google.maps.InfoWindow({
    content: infoWindowContent
    });

    ubicacionMarker.addListener('click', function() {
    infoWindow.open(map, ubicacionMarker);
    });
    }

    

  }

    function actualizarMapa() {
        // Reinicia el mapa
        initMap();
    }

    function darLike(ubicacionID, userID) {
    fetch('/mapa/like', {
    headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    method: 'POST',
    body: JSON.stringify({
    ubicacion_id: ubicacionID,
    usuario_id: userID
    })
    })
    .then(response => response.json())
    .then(data => {
    // Manejar la respuesta JSON aquí
    console.log(data.message); // Puedes mostrar un mensaje de éxito al usuario

    })
    .catch(error => {
    console.error('Error:', error);
    // Puedes mostrar un mensaje de error al usuario si algo sale mal
    });
    }
    function quitarLike(ubicacionID, userID) {
    fetch('/mapa/unlike', {
    headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    method: 'POST',
    body: JSON.stringify({
    ubicacion_id: ubicacionID,
    usuario_id: userID
    })
    })
    .then(response => response.json())
    .then(data => {
    // Manejar la respuesta JSON aquí
    console.log(data.message); // Puedes mostrar un mensaje de éxito al usuario
    })
    .catch(error => {
    console.error('Error:', error);
    // Puedes mostrar un mensaje de error al usuario si algo sale mal
    });
    }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>

</html>
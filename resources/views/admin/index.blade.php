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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert@2"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>



    <style>
        .column-2 {
            float: left;
            width: 40%;
            height: 92vh;
            box-sizing: border-box;
            padding: 10px;
            background-color: rgb(255, 255, 255);
            border-right: 2px solid rgb(219, 217, 217);
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
                <span class="navbar-title">Pagina Administrador</span>
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
    
                <a class="navbar-item">
                    Gimcana
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
    <!-- </div> -->
    <div class="column-2"></div>
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





      @foreach ($ubicaciones as $ubicacion)
          addMarker({{ $ubicacion->latitud }}, {{ $ubicacion->longitud }}, '{{ $ubicacion->nombre }}', '{{ asset("img/$ubicacion->imagen") }}', '{{ $ubicacion->ciudad }}', '{{ $ubicacion->calle }}', '{{ $ubicacion->num_calle }}', '{{ $ubicacion->codigo_postal }}', '{{ $ubicacion->descripcion }}');
      @endforeach

      function addMarker(lat, lng, nombre, imagen, ciudad, calle, numCalle, codigoPostal, descripcion) {
    var ubicacionMarker = new google.maps.Marker({
        position: {lat: lat, lng: lng},
        map: map,
        title: nombre
    });

    var infoWindowContent = '<div class="info-window">' +
                        '<h2 style="color: black;">' + nombre + '</h2>' +
                        '<img src="' + imagen + '" alt="Imagen de ubicación">' +
                        '<p><strong style="color: black;">Ciudad:</strong> <span style="color: grey;">' + ciudad + '</span></p>' +
                        '<p><strong style="color: black;">Calle:</strong> <span style="color: grey;">' + calle + '</span></p>' +
                        '<p><strong style="color: black;">Número de Calle:</strong> <span style="color: grey;">' + numCalle + '</span></p>' +
                        '<p><strong style="color: black;">Código Postal:</strong> <span style="color: grey;">' + codigoPostal + '</span></p>' +
                        '<p><span style="color: grey;">' + descripcion + '</span></p>' +
                        '</div>';


    var infoWindow = new google.maps.InfoWindow({
        content: infoWindowContent
    });

    ubicacionMarker.addListener('click', function() {
        infoWindow.open(map, ubicacionMarker);
    });
}


// Evento de clic en el mapa para agregar una nueva ubicación
map.addListener('click', function(event) {
    swal({
        text: '¿Quieres guardar esta ubicación?',
        content: {
            element: "input",
            attributes: {
                placeholder: "Nombre de la ubicación",
                type: "text",
            },
        },
        buttons: {
            confirm: {
                text: "Aceptar",
                value: true,
                closeModal: true,
            },
            cancel: "Cancelar",
        },
    }).then((value) => {
        if (value) {
            var nombre = value.trim();
            if (nombre !== "") {
                var latLng = event.latLng;

                // Utilizar la API de Geocodificación de Google Maps para obtener la dirección correspondiente a las coordenadas
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'location': latLng }, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            var addressComponents = results[0].address_components;
                            var streetName = null;
                            var streetNumber = null;
                            var postalCode = null;
                            var city = null;

                            // Recorrer los componentes de la dirección para obtener la calle, número, código postal y ciudad
                            addressComponents.forEach(function(component) {
                                if (component.types.includes('route')) {
                                    streetName = component.long_name;
                                } else if (component.types.includes('street_number')) {
                                    streetNumber = component.long_name;
                                } else if (component.types.includes('postal_code')) {
                                    postalCode = component.long_name;
                                } else if (component.types.includes('locality')) {
                                    city = component.long_name;
                                }
                            });

                            // Envía los datos al servidor para guardar la ubicación
                            guardarUbicacion(nombre, latLng.lat(), latLng.lng(), streetName, streetNumber, postalCode, city);
                        } else {
                            console.error("No se encontró ninguna dirección para estas coordenadas.");
                        }
                    } else {
                        console.error("No se pudo obtener la dirección: " + status);
                    }
                });
            } else {
                swal("Error", "Debe ingresar un nombre válido para la ubicación.", "error");
            }
        }
    });
});

function guardarUbicacion(nombre, latitud, longitud, calle, numCalle, codigoPostal, ciudad) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    $.ajax({
        url: '{{ route('guardar-ubicacion') }}',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        data: {
            nombre: nombre,
            latitud: latitud,
            longitud: longitud,
            calle: calle,
            num_calle: numCalle,
            codigo_postal: codigoPostal,
            ciudad: ciudad
        },
        success: function(response) {
    // Mostrar mensaje de éxito utilizando SweetAlert
    swal("Éxito", "Ubicación guardada con éxito", "success").then(() => {
        // Recargar la página
        location.reload();
    });
},
error: function(xhr, status, error) {
    // Mostrar mensaje de error utilizando SweetAlert
    swal("Error", "Ocurrió un error al guardar la ubicación: " + xhr.responseText, "error");
}

    });
}
}
  

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>

</html>

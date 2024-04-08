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
    <div class="column-2">
        <div class="container">
            <h1>Ubicaciones</h1>
            <table id="locations-table">
                <!-- Aquí se insertará la tabla de ubicaciones -->
            </table>
    
            <div class="modal fade" id="editLocationModal" tabindex="-1" aria-labelledby="editLocationModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Aquí se insertará el formulario de edición de ubicación -->
                        </div>
                    </div>
                </div>
            </div>
    
    
        </div>
    
        <div class="container">
            <button id="crear-tipo-ubicacion">Crear tipo de ubicación</button>
    
            <div class="container" id="createTipoUbicacionContainer" style="display: none;">
                <h1>Crear Tipo de Ubicación</h1>
                <form id="createTipoUbicacionForm">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
    
                    <label for="logo">Logo:</label>
                    <input type="file" id="logo" name="logo" required>
    
                    <button type="submit" class="btn btn-primary">Crear Tipo de Ubicación</button>
                </form>
            </div>
            <h1>Tipos de Ubicaciones</h1>
            <table id="tipo-ubicaciones-table">
                <!-- Aquí se insertará la tabla de tipos de ubicaciones -->
            </table>
        </div>
    
        <div class="modal fade" id="editTipoUbicacionModal" tabindex="-1" aria-labelledby="editTipoUbicacionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-body1">
                            <!-- Aquí se insertará el formulario de edición de tipo de ubicación -->
                        </div>
                    </div>
                </div>
            </div>
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




            
            @foreach ($ubicaciones as $ubicacion)
    @php
        // Buscar el tipo de ubicación correspondiente al tipo_ubicacion_id
        $tipoUbicacion = $tiposUbicacion->where('id', $ubicacion->tipo_ubicacion_id)->first();
        // Obtener la URL del logo del tipo de ubicación
        $logoUrl = $tipoUbicacion ? asset("img/{$tipoUbicacion->logo}") : '';
    @endphp
    addMarker({{ $ubicacion->latitud }}, {{ $ubicacion->longitud }}, '{{ $ubicacion->nombre }}', '{{ asset("img/$ubicacion->imagen") }}', '{{ $logoUrl }}', '{{ $ubicacion->ciudad }}', '{{ $ubicacion->calle }}', '{{ $ubicacion->num_calle }}', '{{ $ubicacion->codigo_postal }}', '{{ $ubicacion->descripcion }}', '{{ $tipoUbicacion ? $tipoUbicacion->nombre : 'Sin tipo' }}');
@endforeach



function addMarker(lat, lng, nombre, imagenUbicacion, imagenTipoUbicacion, ciudad, calle, numCalle, codigoPostal, descripcion, tipo_ubicacion_id) {
    var ubicacionMarker;
    if (imagenTipoUbicacion) {
        // Si hay una imagen de tipo de ubicación, usa el icono personalizado
        ubicacionMarker = new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,
            title: nombre,
            icon: {
                url: imagenTipoUbicacion, // URL del logo del tipo de ubicación
                scaledSize: new google.maps.Size(60, 60) // Tamaño del icono
            }
        });
    } else {
        // Si no hay imagen de tipo de ubicación, utiliza el marcador predeterminado de Google
        ubicacionMarker = new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,
            title: nombre
        });
    }

    var infoWindowContent = '<div class="info-window">' +
                        '<h2 style="color: black;">' + nombre + '</h2>' +
                        '<img src="' + imagenUbicacion + '" alt="Imagen de ubicación">' +
                        '<p><strong style="color: black;">Ciudad:</strong> <span style="color: grey;">' + ciudad + '</span></p>' +
                        '<p><strong style="color: black;">Calle:</strong> <span style="color: grey;">' + calle + '</span></p>' +
                        '<p><strong style="color: black;">Número de Calle:</strong> <span style="color: grey;">' + numCalle + '</span></p>' +
                        '<p><strong style="color: black;">Código Postal:</strong> <span style="color: grey;">' + codigoPostal + '</span></p>' +
                        '<p><strong style="color: black;">Categoría:</strong><span style="color: grey;">' + tipo_ubicacion_id + '</span></p>' +
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



<script>
document.addEventListener('DOMContentLoaded', function() {
            fetchLocations();
            fetchTipoUbicaciones();
        });

        // Función fetchLocations() para obtener y mostrar las ubicaciones
        function fetchLocations() {
            fetch('/get-locations')
                .then(response => response.json())
                .then(data => {
                    const locationsTable = document.getElementById('locations-table');
                    locationsTable.innerHTML = '';

                    // Crear la fila de encabezado de la tabla de ubicaciones
                    const headerRow = document.createElement('tr');
                    headerRow.innerHTML = `
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Pista</th>
                <th>Tipo de Ubicación</th>
                <th>Latitud</th>
                <th>Longitud</th>
                <th>Acciones</th>
            `;
                    locationsTable.appendChild(headerRow);

                    // Iterar sobre los datos y agregar cada ubicación como una fila en la tabla
                    data.forEach(location => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                <td>${location.id}</td>
                <td>${location.nombre ? location.nombre : '-'}</td>
                <td>${location.calle}, ${location.num_calle}, ${location.ciudad}</td>
                <td>${location.pista ? location.pista : '-'}</td>
                <td>${location.tipo_ubicacion && location.tipo_ubicacion.nombre ? location.tipo_ubicacion.nombre : '-'}</td>
                <td>${location.latitud}</td>
                <td>${location.longitud}</td>
                <td>
                    <button onclick="editLocation('${location.nombre}', ${location.id})"><img src="{{ asset('img/editar.png') }}" alt="editar" width="50px" height="50px"></button>
                    <button onclick="deleteLocation('${location.nombre}', ${location.id})"><img src="{{ asset('img/eliminar.png') }}" alt="eliminar" width="50px" height="50px"></button>
                </td>
            `;
                        locationsTable.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching locations:', error);
                });
        }

        // Función fetchTipoUbicaciones() para obtener y mostrar los tipos de ubicaciones
        function fetchTipoUbicaciones() {
            fetch('/get-tipo-ubicaciones')
                .then(response => response.json())
                .then(data => {
                    const tipoUbicacionesTable = document.getElementById('tipo-ubicaciones-table');
                    tipoUbicacionesTable.innerHTML = '';

                    // Crear la fila de encabezado de la tabla de tipos de ubicaciones
                    const headerRow = document.createElement('tr');
                    headerRow.innerHTML = `
                <th>ID</th>
                <th>Nombre</th>
                <th>Logo</th>
                <th>Acciones</th>
            `;
                    tipoUbicacionesTable.appendChild(headerRow);

                    // Iterar sobre los datos y agregar cada tipo de ubicación como una fila en la tabla
                    data.forEach(tipoUbicacion => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${tipoUbicacion.id}</td>
                    <td>${tipoUbicacion.nombre}</td>
                    <td><img src="{{ asset('img/${tipoUbicacion.logo}') }}" style="max-width: 100px; max-height: 100px;" alt="Logo"></td>
                    <td>
                        <button onclick="editTipoUbicacion('${tipoUbicacion.nombre}', ${tipoUbicacion.id})"><img src="{{ asset('img/editar.png') }}" alt="editar" width="50px" height="50px"></button>
                        <button onclick="deleteTipoUbicacion('${tipoUbicacion.nombre}', ${tipoUbicacion.id})"><img src="{{ asset('img/eliminar.png') }}" alt="eliminar" width="50px" height="50px"></button>
                    </td>
                `;
                        tipoUbicacionesTable.appendChild(row);
                    });
                })
                .catch(error => {
                    console.error('Error fetching tipo ubicaciones:', error);
                });
        }

        function editLocation(LocationName, locationId) {
            Swal.fire({
                title: "¿Estás seguro de editar?",
                text: `¿Quieres editar la ubicación ${LocationName}?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar una solicitud Ajax para obtener los datos de la ubicación a editar
                    fetch(`/ubicaciones/${locationId}/edit`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error al obtener los datos de la ubicación');
                            }
                            return response.json();
                        })
                        .then(locationData => {
                            // Aquí puedes utilizar los datos de la ubicación para actualizar la interfaz de usuario
                            console.log('Datos de la ubicación a editar:', locationData);

                            // Asegúrate de que locationData tiene las propiedades 'location' y 'tipoUbicacion'
                            openEditLocationModal(locationData.location, locationData.tipoUbicaciones);
                        })
                        .catch(error => {
                            console.error('Error al editar la ubicación:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al editar la ubicación'
                            });
                        });
                }
            });
        }




        function openEditLocationModal(locationData, tipoUbicaciones) {
            // Obtener el modal
            var modal = document.getElementById('editLocationModal');

            // Crear el contenido del modal (formulario de edición de ubicación)
            var modalContent = `
        <form id="editLocationForm">
            <!-- Campos del formulario para editar los datos de la ubicación -->
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="${locationData.nombre}" required>

            <label for="calle">Calle:</label>
            <input type="text" id="calle" name="calle" value="${locationData.calle}" required>

            <label for="num_calle">Número de Calle:</label>
            <input type="text" id="num_calle" name="num_calle" value="${locationData.num_calle}" required>

            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal" value="${locationData.codigo_postal}" required>

            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="${locationData.ciudad}" required>

            <label for="pista">Pista:</label>
            <input type="text" id="pista" name="pista" value="${locationData.pista}" required>

            <label for="contador_likes">Contador de Likes:</label>
            <input type="text" id="contador_likes" name="contador_likes" value="${locationData.contador_likes}" required>

            <label for="tipo_ubicacion_id">Tipo de Ubicación:</label>
            <select id="tipo_ubicacion_id" name="tipo_ubicacion_id" required>
                <!-- Iterar sobre los tipos de ubicación y crear opciones -->
                ${tipoUbicaciones.map(tipoUbicacion => `<option value="${tipoUbicacion.id}">${tipoUbicacion.nombre}</option>`).join('')}
            </select>

            <label for="latitud">Latitud:</label>
            <input type="text" id="latitud" name="latitud" value="${locationData.latitud}" required>

            <label for="longitud">Longitud:</label>
            <input type="text" id="longitud" name="longitud" value="${locationData.longitud}" required>

            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" value="${locationData.descripcion}" required>

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" required>

            <!-- Botón para enviar el formulario y actualizar la ubicación -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>`;

            // Insertar el contenido en el cuerpo del modal
            modal.querySelector('.modal-body').innerHTML = modalContent;

            // Mostrar el modal
            var modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();

            // Manejar el envío del formulario
            modal.querySelector('#editLocationForm').addEventListener('submit', function(event) {
                event.preventDefault();
                // Obtener los datos del formulario
                var formData = new FormData(this);

                // Realizar una solicitud Ajax para actualizar la ubicación
                fetch(`/ubicaciones/${locationData.id}/update`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al actualizar la ubicación');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Actualizar la interfaz de usuario según sea necesario
                        console.log('Ubicación actualizada:', data);
                        // Cerrar el modal
                        modalInstance.hide();
                        // Actualizar la lista de ubicaciones
                        fetchLocations(); // Esta función actualiza la tabla de ubicaciones
                        // Mostrar un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Ubicación Actualizada',
                            showCancelButton: false,
                            timer: 1500
                        });
                    })
                    .catch(error => {
                        console.error('Error al actualizar la ubicación:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al actualizar la ubicación'
                        });
                    });
            });
        }




        // Función para eliminar una ubicación
        function deleteLocation(LocationName, locationId) {
            Swal.fire({
                title: `¿Estás seguro de borrar la ubicación ${LocationName}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    var csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var xhr = new XMLHttpRequest();
                    xhr.open('DELETE', `/ubicaciones/${locationId}`, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrftoken);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // La eliminación fue exitosa
                            // Puedes realizar alguna acción adicional si es necesario
                            fetchLocations();
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                showCancelButton: false,
                                timer: 1500
                            });
                        } else {
                            // Si la respuesta no es exitosa, mostrar un mensaje de error
                            console.error('Error al eliminar la ubicación:', xhr.statusText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al eliminar la ubicación'
                            });
                        }
                    };
                    xhr.onerror = function() {
                        // Si ocurre un error durante la solicitud, mostrar un mensaje de error
                        console.error('Error al eliminar la ubicación:', xhr.statusText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al eliminar la ubicación'
                        });
                    };
                    xhr.send();
                }
            });
        }

        function deleteTipoUbicacion(tipoUbicacionName, locationId) {
            Swal.fire({
                title: `¿Estás seguro de que quieres borrar el tipo de ubicación de ${tipoUbicacionName}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    var csrftoken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    var xhr = new XMLHttpRequest();
                    xhr.open('DELETE', `/tipo-ubicaciones/${locationId}`, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', csrftoken);
                    xhr.onload = function() {
                        if (xhr.status === 200) {
                            // La eliminación fue exitosa
                            // Puedes realizar alguna acción adicional si es necesario
                            fetchTipoUbicaciones();
                            Swal.fire({
                                icon: 'success',
                                title: 'Eliminado',
                                showCancelButton: false,
                                timer: 1500
                            });
                        } else {
                            // Si la respuesta no es exitosa, mostrar un mensaje de error
                            console.error('Error al eliminar la ubicación:', xhr.statusText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al eliminar la ubicación'
                            });
                        }
                    };
                    xhr.onerror = function() {
                        // Si ocurre un error durante la solicitud, mostrar un mensaje de error
                        console.error('Error al eliminar la ubicación:', xhr.statusText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al eliminar la ubicación'
                        });
                    };
                    xhr.send();
                }
            });
        }

        function editTipoUbicacion(tipoUbicacionName, tipoUbicacionId) {
            Swal.fire({
                title: "¿Estás seguro de editar?",
                text: `¿Quieres editar el tipo de ubicación ${tipoUbicacionName}?`,
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí",
                cancelButtonText: "No"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar una solicitud Ajax para obtener los datos del tipo de ubicación a editar
                    fetch(`/tipo-ubicaciones/${tipoUbicacionId}/edit`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error al obtener los datos del tipo de ubicación');
                            }
                            return response.json();
                        })
                        .then(tipoUbicacionData => {
                            // Aquí puedes utilizar los datos del tipo de ubicación para actualizar la interfaz de usuario
                            console.log('Datos del tipo de ubicación a editar:', tipoUbicacionData);

                            openEditTipoUbicacionModal(tipoUbicacionData);
                        })
                        .catch(error => {
                            console.error('Error al editar el tipo de ubicación:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al editar el tipo de ubicación'
                            });
                        });
                }
            });
        }

        function openEditTipoUbicacionModal(tipoUbicacionData) {
            // Obtener el modal
            var modal = document.getElementById('editTipoUbicacionModal');

            // Crear el contenido del modal (formulario de edición de tipo de ubicación)
            var modalContent = `
        <form id="editTipoUbicacionForm">
            <!-- Campos del formulario para editar los datos del tipo de ubicación -->
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="${tipoUbicacionData.nombre}" required>

            <label for="logo">Logo:</label>
            <input type="file" id="logo" name="logo" value="${tipoUbicacionData.logo}" required>

            <!-- Botón para enviar el formulario y actualizar el tipo de ubicación -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>`;

            // Insertar el contenido en el cuerpo del modal
            modal.querySelector('.modal-body1').innerHTML = modalContent;

            // Mostrar el modal
            var modalInstance = new bootstrap.Modal(modal);
            modalInstance.show();

            // Manejar el envío del formulario
            modal.querySelector('#editTipoUbicacionForm').addEventListener('submit', function(event) {
                event.preventDefault();
                // Obtener los datos del formulario
                var formData = new FormData(this);

                // Realizar una solicitud Ajax para actualizar el tipo de ubicación
                fetch(`/tipo-ubicaciones/${tipoUbicacionData.id}/update`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error al actualizar el tipo de ubicación');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Actualizar la interfaz de usuario según sea necesario
                        console.log('Tipo de ubicación actualizado:', data);
                        // Cerrar el modal
                        modalInstance.hide();
                        // Actualizar la lista de tipos de ubicaciones
                        fetchTipoUbicaciones();
                        fetchLocations();
                        // Mostrar un mensaje de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Tipo de Ubicación Actualizado',
                            showCancelButton: false,
                            timer: 1500
                        });
                    })
                    .catch(error => {
                        console.error('Error al actualizar el tipo de ubicación:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al actualizar el tipo de ubicación'
                        });
                    });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const crearTipoUbicacionBtn = document.getElementById('crear-tipo-ubicacion');
            const createTipoUbicacionContainer = document.getElementById('createTipoUbicacionContainer');

            crearTipoUbicacionBtn.addEventListener('click', function() {
                // Mostrar u ocultar el contenedor del formulario de creación de tipo de ubicación
                if (createTipoUbicacionContainer.style.display === 'none') {
                    createTipoUbicacionContainer.style.display = 'block';
                } else {
                    createTipoUbicacionContainer.style.display = 'none';
                }
            });
        });

        // Manejar el envío del formulario para crear un tipo de ubicación
        document.getElementById('createTipoUbicacionForm').addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            // Realizar una solicitud Ajax para crear el tipo de ubicación
            fetch('/tipo-ubicaciones/create', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al crear el tipo de ubicación');
                    }
                    return response.json();
                })
                .then(data => {
                    // Limpiar el formulario después de crear el tipo de ubicación
                    this.reset();
                    // Actualizar la lista de tipos de ubicaciones
                    fetchTipoUbicaciones();
                    // Mostrar un mensaje de éxito
                    Swal.fire({
                        icon: 'success',
                        title: 'Tipo de Ubicación Creado',
                        showCancelButton: false,
                        timer: 1500
                    });
                })
                .catch(error => {
                    console.error('Error al crear el tipo de ubicación:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al crear el tipo de ubicación'
                    });
                });
        });
    </script>

</html>

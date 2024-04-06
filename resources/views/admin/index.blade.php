<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mapa con Jawg</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        html,
        body,
        #map {
            height: 70%;
            width: 100vw;
        }

        .swal-text {
            font-size: 26px;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ubicaciones</h1>
        <table id="locations-table">
            <!-- Aquí se insertará la tabla de ubicaciones -->
        </table>


    </div>

    <div class="container">
        <h1>Tipos de Ubicaciones</h1>
        <table id="tipo-ubicaciones-table">
            <!-- Aquí se insertará la tabla de tipos de ubicaciones -->
        </table>
    </div>

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
                <th>Tipo de Ubicación ID</th>
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
                    <td>${location.nombre}</td>
                    <td>${location.calle}, ${location.num_calle}, ${location.ciudad}</td>
                    <td>${location.pista}</td>
                    <td>${location.tipo_ubicacion_id}</td>
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
                    <td><img src="{{ asset('img/${tipoUbicacion.logo}.png') }}" style="max-width: 100px; max-height: 100px;" alt="Logo"></td>
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

                            // Por ejemplo, puedes abrir un modal y mostrar los datos de la ubicación
                            openEditLocationModal(locationData);
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

                            // Por ejemplo, puedes abrir un modal y mostrar los datos del tipo de ubicación
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
    </script>
</body>

</html>

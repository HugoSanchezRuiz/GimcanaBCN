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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
</body>

</html>

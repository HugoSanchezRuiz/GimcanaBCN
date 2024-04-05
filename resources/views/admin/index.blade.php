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
          fullscreenControl: false, // Oculta el botón de pantalla completa
          styles: [
              { elementType: "labels", stylers: [{ visibility: "off" }] } // Oculta todas las etiquetas, incluidos los nombres de las ciudades
          ]
      };

      var map = new google.maps.Map(document.getElementById("map"), mapOptions);

      @foreach ($ubicaciones as $ubicacion)
          addMarker({{ $ubicacion->latitud }}, {{ $ubicacion->longitud }}, '{{ $ubicacion->nombre }}', '{{ $ubicacion->Pista }}');
      @endforeach

      function addMarker(lat, lng, nombre, pista) {
          var ubicacionMarker = new google.maps.Marker({
              position: {lat: lat, lng: lng},
              map: map,
              title: nombre
          });

          var infoWindowContent = '<div>' +
                                  '<h2>' + nombre + '</h2>' +
                                  '<p>' + pista + '</p>' +
                                  '</div>';

          var infoWindow = new google.maps.InfoWindow({
              content: infoWindowContent
          });

          ubicacionMarker.addListener('click', function() {
              infoWindow.open(map, ubicacionMarker);
          });
      }

      // Evento de clic en el mapa para agregar una nueva ubicación
      map.addListener('dblclick', function(event) {
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
                      var latlng = event.latLng;

                      // Envía los datos al servidor para guardar la ubicación
                      guardarUbicacion(nombre, latlng.lat(), latlng.lng());
                  } else {
                      swal("Error", "Debe ingresar un nombre válido para la ubicación.", "error");
                  }
              }
          });
      });
  }

  // Función para enviar los datos al servidor y guardar la ubicación
  function guardarUbicacion(nombre, latitud, longitud) {
      // Obtener el token CSRF
      var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      // Enviar la solicitud AJAX para guardar la ubicación
      $.ajax({
          url: '{{ route('guardar-ubicacion') }}',
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': csrfToken
          },
          data: {
              nombre: nombre,
              latitud: latitud,
              longitud: longitud
          },
          success: function(response) {
              // Manejar la respuesta si es necesario
              swal("Éxito", response.message, "success");
              // Puedes agregar código adicional aquí, como actualizar el mapa
          },
          error: function(xhr, status, error) {
              // Manejar errores si es necesario
              swal("Error", "Ocurrió un error al guardar la ubicación.", "error");
              console.error(error);
          }
      });
  }
</script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>

</html>

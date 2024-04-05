


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa</title>
    <!-- Enlace de Bulma CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    <!-- Enlace Iconos FontAwesome-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- ICONO -->
    <link rel="icon" type="image/png" href="{{ asset('img/icon.png') }}">

    <style>
        .column-2 {
            float: left;
            width: 20%;
            height: 92vh;
            box-sizing: border-box;
            padding: 10px;
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
                <span class="navbar-title">Título Aquí</span>
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
          zoom: 11, // Nivel de zoom inicial
          fullscreenControl: false, // Oculta el botón de pantalla completa
          styles: [
              { elementType: "labels", stylers: [{ visibility: "off" }] } // Oculta todas las etiquetas, incluidos los nombres de las ciudades
          ]
      };

      var map = new google.maps.Map(document.getElementById("map"), mapOptions);

      @foreach($ubicaciones as $ubicacion)
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
  }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&callback=initMap"></script>

</html>
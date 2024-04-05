<!DOCTYPE html>
<html>
<head>
    <title>Mapa de Ubicaciones</title>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Mapa de Ubicaciones</h1>
    <div id="map"></div>

    <script>
        function initMap() {
            var mapOptions = {
                center: { lat: 41.4036, lng: 2.1744 }, // Coordenadas centrales del mapa
                zoom: 11, // Nivel de zoom inicial
                mapTypeControl: false, // Oculta la opción de tipo de mapa
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
</body>
</html>

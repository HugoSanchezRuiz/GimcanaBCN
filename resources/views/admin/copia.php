<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa con Jawg</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <style>
        body {
            padding: 0;
            margin: 0;
        }

        html,
        body,
        #map {
            height: 100%;
            width: 100vw;
        }

        /* Estilos para el texto del cuadro de diálogo de SweetAlert */
        .swal-text {
            font-size: 26px;
            /* Tamaño de fuente más grande */
            color: #000;
            /* Texto más oscuro */
        }
    </style>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Luego carga Leaflet Routing Machine -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbC3X4maTF6z_6nTvnCgRdFcB3wGj4b4w&libraries=places">
    </script>
    <script>
        var map = L.map('map').fitWorld();
        map.locate({
            setView: true,
            maxZoom: 16
        });

        var Jawg_Terrain = L.tileLayer(
            'https://tile.jawg.io/jawg-terrain/{z}/{x}/{y}{r}.png?access-token=C9Ay2R4Q24car8U3NzVYnIYm4k7CHmNXY7W7uWiJB7fL2CrKQx0zZ66uqvR5aBYh', {
                attribution: '<a href="https://jawg.io" title="Tiles Courtesy of Jawg Maps" target="_blank">&copy; <b>Jawg</b>Maps</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19
            });
        Jawg_Terrain.addTo(map);

        function onLocationFound(e) {
            var radius = e.accuracy;

            L.marker(e.latlng).addTo(map)
                .bindPopup("You are within " + radius + " meters from this point").openPopup();

            L.circle(e.latlng, radius).addTo(map);
        }

        map.on('locationfound', onLocationFound);

        function onLocationError(e) {
            alert(e.message);
        }

        map.on('locationerror', onLocationError);

        var customIcon = L.icon({
            iconUrl: 'img/cole.png',
            iconSize: [52, 52],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        function addMouseOverEvent(marker, title, description, imageUrl) {
            marker.on('mouseover', function(e) {
                var popup = L.popup();
                popup.setContent('<div style="text-align: center;"><img src="' + imageUrl +
                    '" width="100"/><br><b style="color: blue;">' + title + '</b><br>' + description + '</div>');
                this.bindPopup(popup).openPopup();
            });
        }


        var colegioMarker = L.marker([41.34991702441951, 2.1072904270792003], {
            icon: customIcon
        }).addTo(map);
        addMouseOverEvent(colegioMarker, "Escola Joan XXIII",
            "Dirección: Carrer del Prat, 43, 47, 08907 L'Hospitalet de Llobregat, Barcelona.<br> Teléfono: 933 35 11 39",
            "img/joan23.jpg");

        var punto1 = L.marker([41.34936602795708, 2.1097548194717266]).addTo(map);
        addMouseOverEvent(punto1, "Escola Ramon Muntaner",
            "Dirección: C/ de l'Ermita de Bellvitge, 60, 08907 L'Hospitalet de Llobregat, Barcelona <br> Teléfono: 933 35 65 95 ",
            "img/escola.jpg");

        var punto2 = L.marker([41.34857672278056, 2.105849523134852]).addTo(map);
        addMouseOverEvent(punto2, "Polideportivo BelleSport",
            "Dirección: Av. Mare de Déu de Bellvitge, 7, 08907 L'Hospitalet de Llobregat, Barcelona <br> Teléfono: 932 63 36 86",
            "img/bellesport.jpg");

        var punto3 = L.marker([41.34670839896657, 2.1082405528265413]).addTo(map);
        addMouseOverEvent(punto3, "Hotel Hesperia",
            "Hotel modernista de gran altura con habitaciones chics, restaurantes, centro de fitness y belleza, y spa. <br> Entrada: 15:00·Salida: 12:00 <br> Teléfono: 934 13 50 00",
            "img/hotel.jpg");

        var punto4 = L.marker([41.350872755281834, 2.1103661550220285]).addTo(map);
        addMouseOverEvent(punto4, "Mercado de Bellvitge",
            "Dirección: Rambla de la Marina, 181, 08907 L'Hospitalet de Llobregat, Barcelona <br> Teléfono: 932 63 21 06",
            "img/mercado.jpg");

        var punto5 = L.marker([41.35242975531442, 2.1058717040922397]).addTo(map);
        addMouseOverEvent(punto5, "Salting Hospitalet",
            "Dirección: Trav. Industrial, 109, 08907 L'Hospitalet de Llobregat, Barcelona <br> Horario:  Abierto ⋅ Cierra a las 21:00 <br> Teléfono: 930 24 11 10",
            "img/salting.jpg");

            map.on('click', function(event) {
  swal({
    text: '¿Quieres guardarte esta dirección?',
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
        var latlng = event.latlng;

        // Obtener la dirección a partir de las coordenadas
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ 'location': latlng }, function(results, status) {
          if (status === google.maps.GeocoderStatus.OK) {
            if (results[0]) {
              var addressComponents = results[0].address_components;
              var calle = "";
              var numCalle = "";
              var ciudad = "";
              for (var i = 0; i < addressComponents.length; i++) {
                var component = addressComponents[i];
                if (component.types.includes('route')) {
                  calle = component.long_name;
                } else if (component.types.includes('street_number')) {
                  numCalle = component.long_name;
                } else if (component.types.includes('locality')) {
                  ciudad = component.long_name;
                }
              }

              // Obtener el token CSRF
              var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
              
              // Enviar la solicitud AJAX para guardar la ubicación
              $.ajax({
                url: '{{ route("guardar-ubicacion") }}',
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': csrfToken
                },
                data: {
                  nombre: nombre,
                  calle: calle,
                  num_calle: numCalle,
                  ciudad: ciudad,
                  latitud: latlng.lat,
                  longitud: latlng.lng
                  // Otros campos y valores vacíos como lo solicitaste
                },
                success: function(response) {
                  // Mostrar una alerta de éxito
                  swal("¡Éxito!", response.message, "success");
                },
                error: function(xhr, status, error) {
                  // Mostrar una alerta de error
                  swal("Error", "Ocurrió un error al guardar la ubicación", "error");
                  console.error(error);
                }
              });
            }
          }
        });

        L.marker(latlng).addTo(map).bindPopup(nombre).openPopup();
      } else {
        swal("Error", "Debe ingresar un nombre válido para el marcador.", "error");
      }
    }
  });
});






        var control = L.Routing.control({
            waypoints: [
                L.latLng(41.34991702441951, 2.1072904270792003)
            ],
            routeWhileDragging: true,
        }).addTo(map);

        map.on('click', function(event) {
            var destino = event.latlng;
            control.spliceWaypoints(control.getWaypoints().length - 1, 1, destino);
        });

        // Google Maps API call to get place details
        map.on('click', function(event) {
            var latlng = event.latlng;
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                'location': latlng
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        var placeId = results[0].place_id;
                        var content = "";
                        if (placeId) {
                            var service = new google.maps.places.PlacesService(document.createElement(
                                'div'));
                            service.getDetails({
                                placeId: placeId
                            }, function(place, status) {
                                if (status === google.maps.places.PlacesServiceStatus.OK) {
                                    var name = place.name;
                                    var address = results[0].formatted_address;
                                    var rating = place.rating ? place.rating : 'No disponible';
                                    content += "<h1 style='color: blue; font-size: 20px;'>" + name +
                                        "</h1><br><b>Coordenadas:</b> " + latlng.lat + ", " + latlng
                                        .lng + "<br><b>Dirección:</b> " + address +
                                        "<br><b>Puntuación en Google Maps:</b> " + rating + "/5";
                                    L.popup()
                                        .setLatLng(latlng)
                                        .setContent(content)
                                        .openOn(map);
                                }
                            });
                        } else {
                            var address = results[0].formatted_address;
                            content += "<h1 style='color: blue; font-size: 20px;'>" + address +
                                "</h1><br><b>Coordenadas:</b> " + latlng.lat + ", " + latlng.lng + "<br>";
                            L.popup()
                                .setLatLng(latlng)
                                .setContent(content)
                                .openOn(map);
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>

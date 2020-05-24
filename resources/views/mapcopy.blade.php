<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style> html, body, #map { height: 100%; width: 100%; padding: 0; margin: 0; } </style>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Leaflet (JS/CSS) -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
        <!-- Leaflet- KMZ -->
        <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
    </head>

    <body>
        

        <div id="map">
        </div>

        <script>
            var map = L.map('map');
            // map.setView(new L.LatLng(43.5978, 12.7059), 5);
            map.setView(new L.LatLng(-8.691325, 115.193538), 11);

            // var OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
            //     maxZoom: 17,
            //     attribution: 'Map data: &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)',
            //     opacity: 0.90
            // });
            // OpenTopoMap.addTo(map);

            L.tileLayer('https://api.maptiler.com/maps/streets/256/{z}/{x}/{y}.png?key=ryTGNLroM8LwjCfSWkCH', {
                attribution: '<a href="https://www.maptiler.com/copyright/" target="_blank">&copy; MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">&copy; OpenStreetMap contributors</a>', 
            }).addTo(map);

            // Instantiate KMZ parser (async)
            var kmzParser = new L.KMZParser({
                onKMZLoaded: function(layer, name) {
                    control.addOverlay(layer, name);
                    layer.addTo(map);
                },
                // interactive: false,
                pointable: true,
            });

            // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
            kmzParser.load('warnakabupaten.kmz');

            var control = L.control.layers(null, null, { collapsed:false }).addTo(map);
        </script>
    </body>
</html>
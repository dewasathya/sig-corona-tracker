<!DOCTYPE html>
<html>
    <head>
        <title>Layer KMZ</title>

        <style> html, body, #map { height: 100%;} </style>
        <!-- Leaflet (JS/CSS) -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
        <!-- Leaflet- KMZ -->
        <script src="https://unpkg.com/leaflet-kmz@latest/dist/leaflet-kmz.js"></script>
    </head>

    <body>
        <b>Sistem Informasi Geografis - Layer KMZ</b>
        <table>
            <tr>
                <td>NIM:</td>
                <td>1705551005</td>
            </tr>
            <tr>
                <td>Nama:</td>
                <td>I Dewa Gede Sathyananda Diva</td>
            </tr>
        </table>

        <div id="map">
        </div>

        <script>
            var map = L.map('map');

            map.setView(new L.LatLng(-8.4560705, 115.1118982), 10);

            var OpenTopoMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            // Instantiate KMZ parser (async)
            var kmzParser = new L.KMZParser({
                onKMZLoaded: function (layer, name) {
                    // add layer to layer control
                    control.addOverlay(layer, name);
                    layer.addTo(map);
                    // get all sub layer on kmz_layers
                    var layerData = layer.getLayers()[0].getLayers();
                    // fetching data sub layer
                    layerData.forEach(function (data, index) {
                        // ambil data sub layer
                        var negara = data.feature.properties.NAME_0;
                        var provinsi = data.feature.properties.NAME_1;
                        var kabupaten = data.feature.properties.NAME_2;
                        //Ganti warna Layer
                        if (kabupaten == 'Badung') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#FF0000' });
                        } else if (kabupaten == 'Bangli') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#808000' });
                        } else if (kabupaten == 'Buleleng') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#FFFF00' });
                        } else if (kabupaten == 'Denpasar') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#00FF00' });
                        } else if (kabupaten == 'Gianyar') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#FF7F00' });
                        } else if (kabupaten == 'Jembrana') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#964B00' });
                        } else if (kabupaten == 'Karangasem') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#0000FF' });
                        } else if (kabupaten == 'Klungkung') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#BF00FF' });
                        } else if (kabupaten == 'Tabanan') {
                            data.setStyle({ fillOpacity: '0.5', fillColor: '#C0C0C0' });
                        }

                        data.addTo(map);
                        data.bindPopup('<h3>Kabupaten/Kota : <a>' + kabupaten + '<a></h3><br />Total Kasus Positif: ' + );
                    });

                }
            });
            // Add remote KMZ files as layers (NB if they are 3rd-party servers, they MUST have CORS enabled)
            kmzParser.load('{{ route('kmz')}}');

            var control = L.control.layers(null, null, { collapsed: false }).addTo(map);
        </script>
    </body>
</html>
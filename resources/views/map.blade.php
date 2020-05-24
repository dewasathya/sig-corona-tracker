<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>#map { min-height: 500px;} </style>

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
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ route('map') }}">
                        {{ config('app.name') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('map')}}">{{ __('Peta')}}</a>
                            </li>

                            @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('district.index')}}">{{ __('Data Kabupaten')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('report.index')}}">{{ __('Data Laporan')}}</a>
                            </li>
                            @endauth
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                <div class="container">
                    <div class="row justify-content-center mb-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold mb-0">Data Kasus Positif</p>
                                </div>
                                <div class="card-body">
                                    <table class="table table-stripped">
                                        <thead class="thead-primary">
                                            <tr role="row">
                                                <th rowspan="1" colspan="1" class="text-center">Kabupaten</th>
                                                <th rowspan="1" colspan="6" class="text-center">Positif</th>
                                                <th rowspan="1" colspan="1" class="text-center">Dirawat</th>
                                                <th rowspan="1" colspan="1" class="text-center">Sembuh</th>
                                                <th rowspan="1" colspan="1" class="text-center">Meninggal</th>
                                            </tr>
                                            <tr role="row">
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="2" class="text-center">PPLN</th>
                                                <th rowspan="1" colspan="1" class="text-center">PPDN</th>
                                                <th rowspan="1" colspan="1" class="text-center">Transmisi Lokal</th>
                                                <th rowspan="1" colspan="1" class="text-center">Positif Lainnya</th>
                                                <th rowspan="1" colspan="1" class="text-center">Total Positif</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                            </tr>
                                            <tr role="row">
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1" class="text-center">WNA</th>
                                                <th rowspan="1" colspan="1" class="text-center">WNI</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                                <th rowspan="1" colspan="1">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                            @foreach($reports as $report)
                                            <tr>
                                                <td class="text-center">{{$report->district_name}}</td>
                                                <td class="text-center">{{$report->foreign_travel_agent_foreign}}</td>
                                                <td class="text-center">{{$report->foreign_travel_agent_indonesian}}</td>
                                                <td class="text-center">{{$report->domestic_travel_agent}}</td>
                                                <td class="text-center">{{$report->local_transmission}}</td>
                                                <td class="text-center">{{$report->other_positive}}</td>
                                                <td class="text-center">{{$report->total_positive}}</td>
                                                <td class="text-center">{{$report->treated}}</td>
                                                <td class="text-center">{{$report->recovered}}</td>
                                                <td class="text-center">{{$report->died}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <p class="font-weight-bold mb-0">Peta Sebaran Kasus Positif</p>
                                </div>
                                <div class="card-body">
                                    <div id="map">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>


        <script>
            var map = L.map('map');
            map.invalidateSize();
            map.setView(new L.LatLng(-8.691325, 115.193538), 11);

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
            kmzParser.load('bali_districts.kmz');

            var control = L.control.layers(null, null, { collapsed:false }).addTo(map);
        </script>
    </body>
</html>
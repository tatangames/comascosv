@include('frontend.menu.superior')
@include('frontend.menu.body.bodynormal')
@include("frontend.menu.navbar")
<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

<link href="{{ asset('frontend/css/leaflet.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/leaflet-gesture-handling.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/leaflet.markercluster.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/css/leaflet.markercluster.default.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


<div id="map" style="height: 600px;"></div>


<!-- STAR HEADER SEARCH -->
<section style="
         display: flex;
    justify-content: center;
    align-items: center; margin-top: 50px; margin-bottom: 50px">

    <div class="tab-pane fade show active">
        <div class="row">

            <div class="rld-single-input">
                <input type="text" id="nombre-propiedad" placeholder="Buscar..." style="width: 455px !important;">
            </div>

            <a class="btn btn-yellow" onclick="buscarPropiedad()" style="margin-left: 5px">Buscar</a>

        </div>

    </div>

</section>
<!-- END HEADER SEARCH -->




@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")

<script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('frontend/js/map-style2.js') }}"></script>
<script src="{{ asset('frontend/js/leaflet.js') }}"></script>
<script src="{{ asset('frontend/js/leaflet-gesture-handling.min.js') }}"></script>
<script src="{{ asset('frontend/js/leaflet-providers.js') }}"></script>
<script src="{{ asset('frontend/js/leaflet.markercluster.js') }}"></script>

<script>
    var map = L.map('map').setView([51.5, -0.09], 13);





    @foreach($arrayPropiedades as $marcador)

    var customIcon = L.divIcon({
        className: 'custom-marker',
        html: '<div class="leaflet-marker-icon leaflet-div-icon leaflet-zoom-animated leaflet-clickable" tabindex="0" style="margin-left: -50px; margin-top: -50px; width: 50px; height: 50px; transform: translate3d(248px, 799px, 0px); z-index: 799; opacity: 1;"> <i class="fa fa-home"></i> </div>',
        iconSize: [32, 32],
        iconAnchor: [16, 32],
        popupAnchor: [0, -32]
    });



    var marker = L.marker([{{ $marcador['latitud'] }}, {{ $marcador['longitud'] }}]).addTo(map);
    marker.bindPopup("{{ $marcador['titulo'] }}");

    @endforeach





    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);


</script>

<style>
    .custom-marker {
        background-color: transparent;
        border: none;
    }

    .marker-content {
        font-size: 24px;
    }
</style>


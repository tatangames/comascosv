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



<div style="margin-left: 15px; margin-top: 15px">
    <h5 style="color: black;"><strong>Propiedades Disponibles: </strong> {{ $conteo }}</h5>
</div>


<div id="map" style="height: 600px; margin-top: 20px"></div>


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

    var inputNombre = document.getElementById("nombre-propiedad");

    inputNombre.addEventListener("keyup", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            buscarPropiedad();
        }
    });

    function buscarPropiedad(){
        var nombre = document.getElementById('nombre-propiedad').value;
        var url = '/busqueda?nombre=' + encodeURIComponent(nombre);
        window.location.href = url;
    }


    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            options: {
                gestureHandling: 'greedy'
            },
            center: {lat: 14.33202641066866, lng: -89.44123588597019} // Ajusta el centro y el zoom según tus necesidades
        });

        // Itera sobre los marcadores
        @foreach($marcadores as $marcador)

            var marker = new google.maps.Marker({
                position: {lat: {{ $marcador->latitud }}, lng: {{ $marcador->longitud }}},
                map: map,
                title: "Propiedad",
                icon: {
                    url: '{{ asset("images/marcadorgoogle.png") }}', // Ruta a tu icono personalizado
                    scaledSize: new google.maps.Size(50, 70) // Ajusta el tamaño del icono según tu preferencia
                },
                id: "{{ $marcador->slug }}"
            });

            // Agregar evento click al marcador
            marker.addListener('click', function() {
                // Llama a la función handleClickMarker con el ID del marcador
               redireccionar(this.id)
            });

        @endforeach
    }

    function redireccionar(slug){
        var nuevaURL = "{{ url('/propiedad') }}/" + slug;
        window.open(nuevaURL, '_blank');
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{ $apiKey }}&callback=initMap" async defer></script>


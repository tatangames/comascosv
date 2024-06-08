@include('frontend.menu.superior')
@include("frontend.menu.body.bodynormal")
@include("frontend.menu.navbar")


<style>

    #contenedor {
        text-align: left; /* Centrar el contenido horizontalmente */
    }

    #boton {
        margin-left: 100px;
    }






    /* Estilos para la sección 1 */
    .section1 {
        background-color: #f0f0f0;
        padding: 20px;
    }

    /* Estilos para la sección 2 */
    .section2 {
        background-color: #e0e0e0;
        padding: 20px;
    }

    /* Media query para pantallas más pequeñas, como teléfonos */
    @media only screen and (max-width: 768px) {
        /* Cambiar la disposición de las secciones */
        .caja {
            display: flex;
            flex-direction: column;
        }

        /*buscador*/
        .caja .section1 {
            order: 1;
        }
        /*cuadros*/
        .caja .section2 {
            order: 3;
        }
        /*propiedades*/
        .caja .section3 {
            order: 2;
        }
        /*ubicaciones*/
        .caja .section4 {
            order: 4;
        }
    }



</style>

<!-- PORTADA -->
<div id="container">
    <img style="width: 100%;" src="{{ asset('images/portada.jpg') }}">
</div>
<!-- END PORTADA -->



<div class="caja">


<!-- BUSCADOR -->
<section class="how-it-works bg-white rec-pro section1">
    <div class="container-fluid">
        <div class="sec-title">
            <h2>Buscar Propiedades</h2>
        </div>

        <div class="rld-single-input" style="display: flex; justify-content: center;">
                <input type="text" id="nombre-propiedad" autocomplete="off" placeholder="Buscar..." style="width: 500px !important;">
            </div>

        <div style="display: flex; justify-content: center; align-items: center; margin-top: 20px">
            <a class="btn btn-yellow" id="boton" onclick="buscarPropiedad()" style="margin-left: 0px">Buscar</a>
        </div>
    </div>
</section>

<!-- END SECCION - PORQUE ESCOGERNOS-->









<!-- SECCION - PORQUE ESCOGERNOS-->
<section class="how-it-works bg-white rec-pro section2">
    <div class="container-fluid">

        <div class="row service-1" style="margin-top: 50px">
            @foreach($arrayInicio as $dato)

                <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="150">
                    <div class="serv-flex">

                        <div class="art-1 img-13">
                            <img src="{{ asset('storage/archivos/'.$dato->imagen) }}" style="fill: red" alt="">
                            <h3 style="text-align: center !important;">{{ $dato->titulo }}</h3>
                        </div>

                            <div style="text-align: left !important;">
                            {!! $dato->descripcion !!}
                            </div>

                        @if($dato->id == 1)

                            @if($infoRecursos->telefono != null)

                                <p class="text-left">{{ $dato->telefonoFormat }}<a
                                        href="https://wa.me/503{{$infoRecursos->telefono}}"> <img src="{{ asset('images/logowasap.png') }}"
                                                                                                  style=" height: 45px !important; width: 50px !important; margin: 0 10px 0 10px"
                                                                                                  alt="whatsapp"></a> <br>
                                </p>

                            @endif

                        @endif

                    </div>
                </article>




            @endforeach


        </div>
    </div>
</section>
<!-- END SECCION - PORQUE ESCOGERNOS-->



    @if($hayMisionActivo)

    <hr>


    <!-- PARA VISION, MISION Y VALORES -->
    <section class="how-it-works bg-white rec-pro section2">
        <div class="container-fluid">

            <div class="row service-1" style="margin-top: 50px">
                @foreach($arrayMision as $dato)

                    @if($dato->activo == 1)

                        <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="150">
                            <div class="serv-flex">

                                <div class="art-1 img-13">
                                    <h3 style="text-align: center !important; font-size: 18px; font-weight: bold">{{ $dato->titulo }}</h3>
                                </div>

                                <div style="text-align: left !important;">
                                    {!! $dato->mensaje !!}
                                </div>

                            </div>
                        </article>

                    @endif

                @endforeach

            </div>
        </div>
    </section>
    <!-- END SECCION - PORQUE ESCOGERNOS-->



    @endif









    <!-- START SECTION FEATURED PROPERTIES -->
    <section class="featured portfolio bg-white-2 rec-pro full-l section3">
        <div class="container-fluid">
            <div class="sec-title">
                <h2>Propiedades</h2>
                <p></p>
            </div>
            <div class="row portfolio-items">


                @foreach($arrayPropiedades as $dato)


                    <div class="item col-xl-6 col-lg-12 col-md-12 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="fade-right">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="{{ url('propiedad/'.$dato->slug) }}" class="homes-img">

                                        @if($dato->etiquetaizquierda != null)
                                            <div class="homes-tag button alt featured">{{ $dato->etiquetaizquierda }}</div>
                                        @endif

                                        @if($dato->etiquetaderecha != null)
                                            <div class="homes-tag button alt sale">{{ $dato->etiquetaderecha }}</div>
                                        @endif

                                        <img src="{{ asset('storage/archivos/'.$dato->propiimagen) }}" alt="comascosv" class="img-responsive">

                                    </a>
                                </div>
                                <div class="button-effect">
                                    @if($dato->video_url != null)
                                        <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                    @endif
                                    <a href="{{ url('propiedad/'.$dato->slug) }}" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                </div>
                            </div>
                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a href="{{ url('propiedad/'.$dato->slug) }}">{{ $dato->titulo }}</a></h3>
                                <p class="homes-address mb-3">
                                    <a href="{{ url('propiedad/'.$dato->slug) }}">
                                        <i class="fa fa-map-marker"></i><span>{{ $dato->subtitulo }}</span>
                                    </a>
                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix pb-3">

                                    @foreach($dato->detalle as $jj)

                                        <li class="the-icons">
                                            <img src="{{ url('storage/archivos/'.$jj->imagen) }}" style="height: 20px; width: 20px">
                                            <span style="margin-left: 2px"> {{ $jj->nombre }}</span>
                                        </li>

                                    @endforeach


                                </ul>
                                <div class="price-properties footer pt-3 pb-0">
                                    <h3 class="title mt-3">
                                        <a href="{{ url('propiedad/'.$dato->slug) }}">{{ $dato->precioFormat }}</a>
                                    </h3>
                                    <a href="{{ url('propiedad/'.$dato->slug) }}" title="Ver">
                                        <h3 style="margin-top: 15px; font-weight: bold; color: #114beb">Ver Más</h3>
                                    </a>



                                    <div class="compare">
                                        <a href="{{ url('propiedad/'.$dato->slug) }}" title="Ver">
                                            <i class="fa fa-eye" style="font-size:28px"></i>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach



            </div>
            <div class="bg-all">
                <a style="cursor: pointer" onclick="buscarPropiedad()" class="btn btn-outline-light">Ver Todos</a>
            </div>
        </div>
    </section>
    <!-- END SECTION FEATURED PROPERTIES -->








    @if(count($arrayLugarInicio) > 0)
        <section class="feature-categories bg-white rec-pro section4">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2>Ubicaciones</h2>
                    <p></p>
                </div>
                <div class="row">

                    @foreach($arrayLugarInicio as $jj)

                        <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                            <div class="small-category-2">
                                <div class="small-category-2-thumb img-1">
                                    <a style="cursor: pointer" class="sc-jb-title" onclick="buscarPropiedadUbicacion({{ $jj->id_lugares }})">
                                        <img src="{{ url('storage/archivos/'.$jj->imagen) }}" alt=""></a>
                                </div>
                                <div class="sc-2-detail">
                                    <h4 style="cursor: pointer" class="sc-jb-title" onclick="buscarPropiedadUbicacion({{ $jj->id_lugares }})"><a>{{ $jj->nombre }}</a></h4>
                                    <span>{{ $jj->conteo }} propiedades
                                    </span>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </section>
    @endif


    @if($infoRecursos->responsabilidad_titulo != null)
        <section class="feature-categories bg-white rec-pro section4">
            <div class="container-fluid">
                <div class="sec-title">
                    <h2>{{ $infoRecursos->responsabilidad_titulo }}</h2>

                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-sm-12" data-aos="fade-up" data-aos-delay="150">

                        <div class="card-body">
                            <!-- Contenido de la tarjeta -->
                            <p>
                                {!! $infoRecursos->responsabilidad_mensaje !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif








</div> <!-- END CAJA -->



<div id="cookieBanner" style="display: none">

    <div class="aviso-cookies activo" id="aviso-cookies">
        <img class="galleta" src="{{ asset('images/cookie.svg') }}" alt="Galleta">
        <h3 class="titulo">Cookies</h3>
        <p class="parrafo">Utilizamos cookies propias y de terceros para mejorar nuestros servicios.</p>
        <button class="boton" id="acceptCookies">De acuerdo</button>
        <a class="enlace" href="{{ url('aviso/cookies') }}">Aviso de Cookies</a>
    </div>
    <div class="fondo-aviso-cookies activo" id="fondo-aviso-cookies"></div>

</div>


@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")

<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>


<script>

    document.addEventListener("DOMContentLoaded", function() {

        dataLayer = [];

        // Comprobar si la cookie de aceptación ya existe
        if (!getCookie("cookiesAccepted")) {
            document.getElementById("cookieBanner").style.display = "block";
        }else{
            // COOKIES, ADA
            dataLayer.push({'event': 'cookies-aceptadas'});
        }

        // Manejar la aceptación de cookies
        document.getElementById("acceptCookies").addEventListener("click", function() {
            setCookie("cookiesAccepted", "true", 365);
            document.getElementById("cookieBanner").style.display = "none";

            dataLayer.push({'event': 'cookies-aceptadas'});
        });

        // Función para establecer una cookie
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days*24*60*60*1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "")  + expires + "; path=/";
        }

        // Función para obtener una cookie
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for(var i=0;i < ca.length;i++) {
                var c = ca[i];
                while (c.charAt(0)==' ') c = c.substring(1,c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
            }
            return null;
        }
    });

</script>


<script>


    document.getElementById('nombre-propiedad').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            buscarPropiedad();
        }
    });


    function buscarPropiedad(){
        var nombre = document.getElementById('nombre-propiedad').value;
        var url = '/busqueda?nombre=' + encodeURIComponent(nombre);
        window.location.href = url;
    }

    function buscarPropiedadUbicacion(idlugar){
        var url = '/busqueda?ubicacion=' + encodeURIComponent(idlugar) ;
        window.location.href = url;
    }




</script>

<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-YC9JVQ7Y2Y');
</script>


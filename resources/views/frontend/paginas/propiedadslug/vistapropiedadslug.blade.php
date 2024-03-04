@include('frontend.menu.superior')
@include('frontend.menu.body.bodypropiedad')
@include("frontend.menu.navbar")


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"/>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

<!-- START SECTION PROPERTIES LISTING -->
<section class="single-proper blog details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 blog-pots">
                <div class="row">
                    <div class="col-md-12">
                        <section class="headings-2 pt-0">
                            <div class="pro-wrapper">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <h3>{{ $infoPropi->nombre }}
                                            @if($infoPropi->vineta_izquierda != null)
                                            <span class="mrg-l-5 category-tag">

                                                    {{ $infoPropi->vineta_izquierda }}

                                            </span></h3>
                                        @endif

                                        <div class="mt-0">
                                            <a href="#listing-location" class="listing-address">
                                                <i class="fa fa-map-marker pr-2 ti-location-pin mrg-r-5"></i>{{ $infoPropi->direccion }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single detail-wrapper mr-2">
                                    <div class="detail-wrapper-body">
                                        <div class="listing-title-bar">
                                            <h4>{{ $precioFormat }}</h4>
                                            <div class="mt-0">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- main slider carousel items -->
                        <div id="listingDetailsSlider" class="carousel listing-details-sliders slide mb-30">
                            <h5 class="mb-4">Galería</h5>
                            <div class="carousel-inner">

                                @foreach($arrayImagenes as $dato)

                                    @if ($loop->first)

                                        <div class="active item carousel-item" data-slide-number="{{ $dato->contador }}">
                                            <img src="{{ asset('storage/archivos/'.$dato->imagen) }}" class="img-fluid" alt="slider-listing">
                                        </div>
                                    @else
                                        <div class="item carousel-item" data-slide-number="{{ $dato->contador }}">
                                            <img src="{{ asset('storage/archivos/'.$dato->imagen) }}" class="img-fluid" alt="slider-listing">
                                        </div>
                                    @endif

                                @endforeach


                                <a class="carousel-control left" href="#listingDetailsSlider" data-slide="prev"><i class="fa fa-angle-left" style="color: white !important;"></i></a>
                                <a class="carousel-control right" href="#listingDetailsSlider" data-slide="next"><i class="fa fa-angle-right" style="color: white !important;"></i></a>

                            </div>
                            <!-- main slider carousel nav controls -->
                            <ul class="carousel-indicators smail-listing list-inline">


                                @foreach($arrayImagenes as $dato)

                                    @if ($loop->first)
                                        <li class="list-inline-item active">
                                            <a id="carousel-selector-{{$dato->contador}}" class="selected" data-slide-to="{{$dato->contador}}" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('storage/archivos/'.$dato->imagen) }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>

                                    @else
                                        <li class="list-inline-item">
                                            <a id="carousel-selector-{{$dato->contador}}" data-slide-to="{{$dato->contador}}" data-target="#listingDetailsSlider">
                                                <img src="{{ asset('storage/archivos/'.$dato->imagen) }}" class="img-fluid" alt="listing-small">
                                            </a>
                                        </li>
                                    @endif

                                @endforeach




                            </ul>
                            <!-- main slider carousel items -->
                        </div>
                        <div class="blog-info details mb-30">
                            <h5 class="mb-4">Descripción</h5>

                            {!! $infoPropi->descripcion !!}

                        </div>
                    </div>
                </div>


                @if($datosArray['almenos1dato'])

                    <div class="single homes-content details mb-30">

                        @if(count($arrayDetalle1) > 0)
                            <h5 class="mb-4">Detalles</h5>
                            <ul class="homes-list clearfix">

                                @foreach($arrayDetalle1 as $dato)
                                    <li>
                                        <span class="font-weight-bold mr-1">{{ $dato->titulo }}</span>
                                        <span class="det">{{ $dato->descripcion }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if(count($arrayDetalle2) > 0)
                                <h5 class="mt-5">Extras</h5>
                                <ul class="homes-list clearfix">

                                @foreach($arrayDetalle2 as $dato)
                                    <li>
                                        <i class="fa fa-check-square" style="color: #FF385C !important;" aria-hidden="true"></i>
                                        <span>{{ $dato->titulo }}</span>
                                    </li>
                                @endforeach
                                </ul>
                        @endif
                    </div>
                @endif



                @if(count($arrayPlanos) > 0)
                    <div class="floor-plan property wprt-image-video w50 pro">
                    <h5>Planos</h5>
                        @foreach($arrayPlanos as $dato)
                            <div class="floor-plan property wprt-image-video w50 pro">
                                <img alt="comascosv" src="{{ url('storage/archivos/'.$dato->imagen) }}">
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($infoPropi->video_url != null)

                    <div class="property wprt-image-video w50 pro">
                        <h5>Video</h5>
                        <iframe width="100%" height="360" src="https://www.youtube.com/embed/{{ $infoPropi->video_url }}" frameborder="0" allowfullscreen></iframe>
                    </div>


                @endif

                @if(count($array360) > 0)

                    <div class="blog-info details mb-30">
                        <h5 class="mb-4">Imagen 360</h5>

                        @foreach($array360 as $dato)

                            <div id="panorama{{ $dato->id }}" style="width: 99%; height: 400px;"></div>

                            <hr>

                            <script>
                                pannellum.viewer('panorama{{ $dato->id }}', {
                                    "type": "equirectangular",
                                    "panorama": "{{ url('storage/archivos/'.$dato->imagen) }}",
                                    "autoLoad": true,
                                });
                            </script>

                        @endforeach
                    </div>

                @endif




                @if($infoPropi->latitud != null && $infoPropi->longitud != null)

                    <div class="property-location map">
                        <h5>Mapa</h5>
                        <div class="divider-fade"></div>
                        <div id="colorlib-reservation">
                            <div class="container">
                                <div class="row animate-box">

                                    <iframe
                                        width="600"
                                        height="450"
                                        frameborder="0"
                                        style="border:0"
                                        src="https://maps.google.com/maps?q={{ $infoPropi->latitud }},{{ $infoPropi->longitud }}&z=15&output=embed"
                                        allowfullscreen>
                                    </iframe>

                                </div>
                            </div>
                        </div>
                    </div>

                @endif






            </div>
            <aside class="col-lg-4 col-md-12 car">
                <div class="single widget">

                    <!-- end author-verified-badge -->
                    <div class="sidebar">
                        <div class="widget-boxed mt-33 mt-5">
                            <div class="widget-boxed-header">
                                <h4>Información Agente</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="sidebar-widget author-widget2">
                                    <div class="author-box clearfix">
                                        <img src="{{ asset('storage/archivos/'.$infoVendedor->imagen) }}" alt="author-image" class="author__img">
                                        <h4 class="author__title">{{ $infoVendedor->nombre }}</h4>

                                    </div>
                                    <ul class="author__contact">


                                        @foreach($arrayContactos as $dato)

                                            @if($dato->id_tipocontacto == 1)
                                                <li>
                                                    <span class="la la-phone">
                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                    </span>
                                                    <a
                                                        href="https://wa.me/503{{$dato->titulo}}">{{ $dato->telefonoFormat }} <img src="{{ asset('images/logowasap.png') }}"
                                                                                                                  style=" height: 30px !important; width: 30px !important; margin: 0 10px 0 10px"
                                                                                                                  alt="whatsapp"></a> <br>
                                                </li>

                                            @elseif($dato->id_tipocontacto == 2)
                                                <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>{{ $dato->titulo }}</li>
                                            @elseif($dato->id_tipocontacto == 3)
                                                <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#">{{ $dato->titulo }}</a></li>
                                            @endif

                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>




                        @if(count($arrayPropiVendedor) > 0)

                            <div class="main-search-field-2">
                                <div class="widget-boxed mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Propiedades</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">

                                           @foreach($arrayPropiVendedor as $dato)

                                                <div class="recent-main">
                                                    @if($dato->imagen != null)
                                                        <div class="recent-img">
                                                            <a href="{{ url('propiedad/'.$dato->slug) }}"><img src="{{ url('storage/archivos/'.$dato->imagen) }}" alt=""></a>
                                                        </div>
                                                    @endif

                                                    <div class="info-img">
                                                        <a href="{{ url('propiedad/'.$dato->slug) }}"><h6>{{ $dato->nombre }}</h6></a>
                                                        <p>{{ $dato->precioFormat }}</p>
                                                    </div>

                                                </div>

                                            @endforeach




                                        </div>
                                    </div>
                                </div>


                        @endif




                            <!-- ANUNCIOS
                            <div class="widget-boxed popular mt-5">
                                <div class="widget-boxed-header">
                                    <h4>Specials of the day</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="banner"><img src="images/single-property/banner.jpg" alt=""></div>
                                </div>
                            </div>
                            -->



                            @if(count($arrayTagPopular) > 0)

                                <div class="widget-boxed popular mt-5">
                                    <div class="widget-boxed-header">
                                        <h4>Etiquetas</h4>
                                    </div>
                                    <div class="widget-boxed-body">
                                        <div class="recent-post">

                                            <div class="row">

                                            @foreach($arrayTagPopular as $dato)

                                                    <div class="tags">
                                                        <span><a href="#" class="btn btn-outline-primary">{{ $dato->nombre }}</a></span>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endif













                        </div>
                    </div>
                </div>
            </aside>
        </div>


        @if(count($arrayPropiAletorias) > 0)

            <!-- START SIMILAR PROPERTIES -->
            <section class="similar-property featured portfolio p-0 bg-white-inner">
                <div class="container">
                    <h5>Propiedad Similares</h5>
                    <div class="row portfolio-items">
            @foreach($arrayPropiAletorias as $dato)

                <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                                <div class="project-single">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                @if($dato->vineta_izquierda != null)
                                                    <div class="homes-tag button alt featured">{{ $dato->vineta_izquierda }}</div>
                                                @endif

                                                @if($dato->vineta_derecha != null)
                                                    <div class="homes-tag button alt sale">{{ $dato->vineta_derecha }}</div>
                                                @endif

                                                <img src="{{ url('storage/archivos/'.$dato->imagen) }}" alt="home-1" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="{{ url('propiedad/'.$dato->slug) }}" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">

                                        <h3><a href="{{ url('propiedad/'.$dato->slug) }}">Real House Luxury Villa</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="single-property-1.html">
                                                <i class="fa fa-dollar">{{ $dato->precioFormat }}</i><span></span>
                                            </a>
                                        </p>

                                        <ul class="homes-list clearfix pb-3">
                                            @foreach($dato->detalle as $jj)

                                                <li class="the-icons">
                                                    <img src="{{ url('storage/archivos/'.$jj->imagen) }}" style="height: 20px; width: 20px">
                                                    <span style="margin-left: 2px"> {{ $jj->nombre }}</span>
                                                </li>

                                            @endforeach
                                        </ul>

                                        <div class="footer">
                                            <a href="{{ url('propiedad/'.$dato->slug) }}">
                                                <img src="{{ url('storage/archivos/'.$dato->imagenvendedor) }}" alt="" class="mr-2"> {{ $dato->nombrevendedor }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


            @endforeach

                    </div>
                </div>
            </section>
            <!-- END SIMILAR PROPERTIES -->
        @endif

    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->




@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")




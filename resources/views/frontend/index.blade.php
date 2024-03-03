@include('frontend.menu.superior')
@include("frontend.menu.body.bodynormal")
@include("frontend.menu.navbar")


<!-- PORTADA -->
<div id="container">
    <img style="width: 100%;" src="{{ asset('images/portada.jpg') }}">
</div>
<!-- END PORTADA -->


<!-- SECCION - PORQUE ESCOGERNOS-->
<section class="how-it-works bg-white rec-pro">
    <div class="container-fluid">
        <div class="sec-title">
            <h2>Bienvenido a comascosv</h2>
        </div>
        <div class="row service-1">


            @foreach($arrayInicio as $dato)

                <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="150">
                    <div class="serv-flex">
                        <div class="art-1 img-13">
                            <img src="{{ asset('storage/archivos/'.$dato->imagen) }}" style="fill: red" alt="">
                            <h3>{{ $dato->titulo }}</h3>
                        </div>
                        <div class="service-text-p">
                            <p class="text-center">
                                {!! $dato->descripcion !!}
                            </p>

                            @if($dato->id == 1)

                                @if($infoRecursos->telefono != null)

                                    <p class="text-center">{{ $dato->telefonoFormat }}<a
                                            href="https://wa.me/503{{$infoRecursos->telefono}}"> <img src="{{ asset('images/logowasap.png') }}"
                                                                                   style=" height: 45px !important; width: 50px !important; margin: 0 10px 0 10px"
                                                                                   alt="whatsapp"></a> <br>

                                    </p>

                                @endif



                            @endif
                        </div>
                    </div>
                </article>

            @endforeach










        </div>
    </div>
</section>
<!-- END SECCION - PORQUE ESCOGERNOS-->


<!-- START SECTION FEATURED PROPERTIES -->
<section class="featured portfolio bg-white-2 rec-pro full-l">
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

                                    <img src="{{ asset('storage/archivos/'.$dato->propiimagen) }}" alt="home-1" class="img-responsive">

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
            <a href="properties-full-grid-1.html" class="btn btn-outline-light">Ver Todos</a>
        </div>
    </div>
</section>
<!-- END SECTION FEATURED PROPERTIES -->

<!-- START SECTION POPULAR PLACES -->
<section class="feature-categories bg-white rec-pro">
    <div class="container-fluid">
        <div class="sec-title">
            <h2>Ubicaciones</h2>
            <p></p>
        </div>
        <div class="row">





            <!-- Single category -->
            <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                <div class="small-category-2">
                    <div class="small-category-2-thumb img-1">
                        <a href="properties-full-grid-1.html"><img src="{{ asset('images/b-11.jpg') }}" alt=""></a>
                    </div>
                    <div class="sc-2-detail">
                        <h4 class="sc-jb-title"><a href="properties-full-grid-1.html">Metapan</a></h4>
                        <span>203 propiedades</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="250">
                <div class="small-category-2">
                    <div class="small-category-2-thumb img-1">
                        <a href="properties-full-grid-1.html"><img src="{{ asset('images/b-11.jpg') }}" alt=""></a>
                    </div>
                    <div class="sc-2-detail">
                        <h4 class="sc-jb-title"><a href="properties-full-grid-1.html">Santa Ana</a></h4>
                        <span>5 propeidades</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                <div class="small-category-2">
                    <div class="small-category-2-thumb img-1">
                        <a href="properties-full-grid-1.html"><img src="{{ asset('images/b-11.jpg') }}" alt=""></a>
                    </div>
                    <div class="sc-2-detail">
                        <h4 class="sc-jb-title"><a href="properties-full-grid-1.html">Texistepeque</a></h4>
                        <span>8 propiedades</span>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-lg-6 col-sm-6" data-aos="fade-up" data-aos-delay="450">
                <div class="small-category-2">
                    <div class="small-category-2-thumb img-1">
                        <a href="properties-full-grid-1.html"><img src="{{ asset('images/b-11.jpg') }}" alt=""></a>
                    </div>
                    <div class="sc-2-detail">
                        <h4 class="sc-jb-title"><a href="properties-full-grid-1.html">El Congo</a></h4>
                        <span>9 propiedades</span>
                    </div>
                </div>
            </div>


        </div>
        <!-- /row -->
    </div>
</section>
<!-- END SECTION POPULAR PLACES -->


@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")



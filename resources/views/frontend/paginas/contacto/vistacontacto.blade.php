@include('frontend.menu.superior')
@include('frontend.menu.body.bodycontacto')
@include("frontend.menu.navbar")



<!-- IMAGEN DE PORTADA-->
<section class="headings">
    <div class="text-heading text-center">
        <div class="container">

        </div>
    </div>
</section>


<div class="text-left">
    <div class="container">
        <!-- START SECTION CONTACT US -->
        <section class="contact-us">
            <div class="container">

                <div class="row">


                    <div class="row">
                        <!-- START SECTION ABOUT -->
                        <section>
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12 who-1">
                                        <div>
                                            <h2 class="text-left mb-4">Detalle <span>de Contacto</span></h2>
                                        </div>
                                        <div class="col-lg-12 col-md-12 bgc">
                                            <ul>
                                                <li>
                                                    <div class="info">
                                                        <p class="mb-5" style="color: white !important; font-weight: normal; font-size: 16px">Puedes contactarnos en nuestras Redes Sociales</p>

                                                        @foreach($arrayContacto as $dato)

                                                            @if($dato->visible == 1 && $dato->id_tipos_contactos == 1)

                                                                <span class="fa fa-phone" style="color: white !important; font-size: 17px"/>
                                                                <a href="https://wa.me/503{{ $dato->nombre }}" style="color: #ffffff !important;">{{ $dato->numeroFormat }}
                                                                    <img src="{{ asset('images/logowasap.png') }}" style="width: 30px; height: 30px; margin-left: 15px"></a>

                                                                <br>
                                                                <br>
                                                            @endif

                                                            @if($dato->visible == 1 && $dato->id_tipos_contactos == 2)

                                                                <a href="{{ $dato->nombre }}" style="color: #ffffff !important;">Canal Youtube
                                                                    <img src="{{ asset('images/youtube.png') }}" style="width: 30px; height: 30px; margin-left: 15px"></a>

                                                                <br>
                                                                <br>
                                                            @endif


                                                            @if($dato->visible == 1 && $dato->id_tipos_contactos == 3)


                                                                <a href="{{ $dato->nombre }}" style="color: #ffffff !important;">Facebook
                                                                    <img src="{{ asset('images/facebook.png') }}" style="width: 30px; height: 30px; margin-left: 15px"></a>
                                                                <br>
                                                                <br>
                                                            @endif

                                                            @if($dato->visible == 1 && $dato->id_tipos_contactos == 4)


                                                                <a href="{{ $dato->nombre }}" style="color: #ffffff !important;">Facebook
                                                                    <img src="{{ asset('images/tiktok.png') }}" style="width: 30px; height: 30px; margin-left: 15px"></a>
                                                                <br>
                                                                <br>
                                                            @endif

                                                            @if($dato->visible == 1 && $dato->id_tipos_contactos == 5)


                                                                <a href="{{ $dato->nombre }}" style="color: #ffffff !important;">Facebook
                                                                    <img src="{{ asset('images/instagram.png') }}" style="width: 30px; height: 30px; margin-left: 15px"></a>
                                                                <br>
                                                                <br>
                                                            @endif

                                                        @endforeach



                                                    </div>
                                                </li>


                                            </ul>
                                        </div>

                                    </div>
                                    <div class="col-lg-3 col-md-3 col-xs-3">
                                        <img alt="image" src="{{ asset('images/logotipo.png') }}">
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>








                </div>
            </div>
        </section>
        <!-- END SECTION CONTACT US -->

    </div>
</div>


@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")

<!-- START FOOTER -->
<footer class="first-footer">
    <div class="top-footer bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="netabout">
                        <a href="{{ route('inicio') }}" class="logo">
                            <img src="{{ asset('images/logocomasco.png') }}" style="width: 65px !important; height: 65px !important;" alt="Comascosv">
                        </a>
                        <p>{{ $filasRecursos['descripcionPagina'] }}</p>
                    </div>
                    <div class="contactus">
                        <ul>
                            <li>
                                <div class="info">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <p class="in-p">El Salvador</p>
                                </div>
                            </li>
                            <li>
                                <div class="info">

                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <p class="in-p"><a href="https://wa.me/503{{ $filasRecursos['telefono'] }}" style="color: #484545 !important;"> {{ $filasRecursos['telefonoFormat'] }} </a></p>

                                </div>
                            </li>
                        </ul>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="widget">
                        <h3>{{ $filasRecursos['columna1'] }}</h3>
                        <div class="twitter-widget contuct">
                            <div class="twitter-area">

                                @foreach($filasRecursos['listado1'] as $dato)

                                    <div class="single-item">
                                        <div class="icon-holder">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
                                        <div class="text">
                                            <h5>{{ $dato->nombre }}</h5>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="widget">
                        <h3>{{ $filasRecursos['columna2'] }}</h3>
                        <div class="twitter-widget contuct">
                            <div class="twitter-area">

                                @foreach($filasRecursos['listado2'] as $dato)

                                    <div class="single-item">
                                        <div class="icon-holder">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </div>
                                        <div class="text">
                                            <h5>{{ $dato->nombre }}</h5>
                                        </div>
                                    </div>

                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="second-footer bg-white-3">
        <div class="container">
            <p style="color: white !important;">2024 © Copyright - Comascosv.</p>
            <ul class="netsocials">
                <li><a href="https://wa.me/503{{ $filasRecursos['telefono'] }}">   <img src="{{ asset('images/logowasap.png') }}" style=" height: 45px !important; width: 45px !important; margin: 0 10px 0 10px" alt="whatsapp"> </a></li>
                <li><a href="https://www.facebook.com/icenterelsalvador/?locale=es_LA">   <img src="{{ asset('images/facebook.png') }}" style=" height: 38px !important; width: 38px !important; margin: 0 10px 0 10px" alt="Facebook"> </a></li>
                <li><a href="https://www.youtube.com/watch?v=fESBCxo7K8A">   <img src="{{ asset('images/youtube.png') }}" style=" height: 38px !important; width: 38px !important; margin: 0 10px 0 10px" alt="Youtube"> </a></li>

            </ul>
        </div>
    </div>
</footer>

@include('frontend.menu.superior')
@include('frontend.menu.body.bodycontacto')
@include("frontend.menu.navbar")


<style>


</style>

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
                    <!-- START SECTION ABOUT -->
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-md-12 who-1">
                                    <div>
                                        <h2 class="text-left mb-4">Acerca <span>de Nosotros</span></h2>
                                    </div>
                                    <div>

                                        {!! $infoRecursos->quienes_somos !!}


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
        </section>

    </div>
</div>


@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")

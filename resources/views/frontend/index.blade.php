@include('frontend.menu.superior')
@include("frontend.menu.navbar")



<!-- PORTADA -->
<section id="hero-area" class="parallax-searchs home17 overlay" data-stellar-background-ratio="0.5">
    <div class="hero-main">
        <div class="container" data-aos="zoom-in">
            <div class="banner-inner-wrap">
                <div class="row">

                </div>
            </div>
        </div>
    </div>
</section>
<!-- END PORTADA -->






<!-- SECCION - PORQUE ESCOGERNOS-->
<section class="how-it-works bg-white rec-pro">
    <div class="container-fluid">
        <div class="sec-title">
            <h2>Bienvenido a comascosv</h2>
        </div>
        <div class="row service-1">
            <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="150">
                <div class="serv-flex">
                    <div class="art-1 img-13">
                        <img src="{{ asset('images/icons/casa-svg.svg') }}" style="fill: red" alt="">
                        <h3>¿Que hacemos?</h3>
                    </div>
                    <div class="service-text-p">
                        <p class="text-center">Comascosv ofrece servicios de promoción de inmuebles y crea pequeños proyectos inmobiliarios.</p>
                    </div>
                </div>
            </article>
            <article class="col-lg-3 col-md-6 col-xs-12 serv mb-0 pt its-2" data-aos="fade-up" data-aos-delay="450">
                <div class="serv-flex">
                    <div class="art-1 img-14">
                        <img src="{{ asset('images/icons/casallave-svg.svg') }}" alt="">
                        <h3>¿Porque unirse?</h3>
                    </div>
                    <div class="service-text-p">
                        <p class="text-center">Tu Anuncio Estará Visible Nacional E Internacional. <br>
                            Todo Esto A Un Super Costo, Ya Que Pretendemos Ayudar. <br>
                            Sobre Todo A Aquellos Que Buscan Comprar Algo Cómodo.</p>
                    </div>
                </div>
            </article>
            <article class="col-lg-3 col-md-6 col-xs-12 serv" data-aos="fade-up" data-aos-delay="250">
                <div class="serv-flex">
                    <div class="art-1 img-14">
                        <img src="{{ asset('images/icons/mano-svg.svg') }}" alt="">
                        <h3>Beneficios</h3>
                    </div>
                    <div class="service-text-p">
                        <p class="text-center">Vender sin pagar altos precios de comisión.<br>
                                - Te permite administrar la información del anuncio; subir fotos, poner la información <br>
                                - Enlace de redireccionamiento a un video guiado que ayudará a que tu anuncio sea efectivo.</p>
                    </div>
                </div>
            </article>

            <article class="col-lg-3 col-md-6 col-xs-12 serv mb-0 pt its-2" data-aos="fade-up" data-aos-delay="450">
                <div class="serv-flex">
                    <div class="art-1 img-14">
                        <img src="{{ asset('images/icons/casallave-svg.svg') }}" alt="">
                        <h3>Como unirte a Comascosv</h3>
                    </div>
                    <div class="service-text-p">
                        <p class="text-center">Consulta el precio para solicitar que te promocione comascosv. <img src="{{ asset('images/logowasap.png') }}" style=" height: 45px !important; width: 50px !important; margin: 0 10px 0 10px" alt="whatsapp"></p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
<!-- END SECCION - PORQUE ESCOGERNOS-->




















@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")



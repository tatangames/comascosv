@include('frontend.menu.superior')
@include('frontend.menu.body.bodycontacto')
@include("frontend.menu.navbar")


<style>


</style>

<!-- IMAGEN DE PORTADA-->
<section class="headings">
</section>


<div class="text-left">
    <div class="container">
        <!-- START SECTION CONTACT US -->
        <section class="contact-us">
            <div class="container">

                <div class="row">

                    <div class="col-lg-4 col-md-12 bgc">

                        <div class="call-info">
                            <h3>Detalle de Contacto</h3>
                            <p class="mb-5">Puedes contactarnos a nuestro Teléfono o a nuestro WhatsApp!</p>
                            <ul>
                                <li>
                                    <div class="info">
                                        <i class="fa fa-phone" style="color: #FFFFFF" aria-hidden="true"></i>
                                        <p class="in-p"><a href="https://wa.me/50372068714" style="color: #ffffff !important;">+503 7206-8714 <img src="{{ asset('images/logowasap.png') }}"
                                                                                                                                                   style=" height: 35px !important; width: 38px !important; margin: 0 10px 0 10px"
                                                                                                                                                   alt="whatsapp"></a> </p>
                                    </div>
                                </li>


                            </ul>
                        </div>
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

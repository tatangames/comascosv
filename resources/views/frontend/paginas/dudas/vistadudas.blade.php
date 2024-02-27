@include('frontend.menu.superior')
@include('frontend.menu.body.bodyfaq')
@include("frontend.menu.navbar")


<!-- IMAGEN DE PORTADA-->
<section class="headings">
</section>



<!-- END SECTION HEADINGS -->

<!-- START SECTION FAQ -->
<section class="faq service-details bg-white">
    <div class="container">
        <h3 class="mb-5">PREGUNTAS FRECUENTES</h3>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <ul class="accordion accordion-1 one-open">


                    @foreach($listado as $dato)
                        @if($loop->first)
                            <li class="active">
                                <div class="title">
                                    <span>{{ $dato->titulo }}</span>
                                </div>
                                <div class="content">
                                    <p>
                                        {{ $dato->descripcion }}
                                    </p>
                                </div>
                            </li>
                        @else

                            <li>
                                <div class="title">
                                    <span>{{ $dato->titulo }}</span>
                                </div>
                                <div class="content">
                                    <p>
                                        {{ $dato->descripcion }}
                                    </p>
                                </div>
                            </li>

                        @endif
                    @endforeach


                </ul>
                <!--end of accordion-->
            </div>
        </div>
    </div>
</section>
<!-- END SECTION FAQ -->


@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")

<script>
    $(".accordion li").click(function() {
        $(this).closest(".accordion").hasClass("one-open") ? ($(this).closest(".accordion").find("li").removeClass("active"), $(this).addClass("active")) : $(this).toggleClass("active"), "undefined" != typeof window.mr_parallax && setTimeout(mr_parallax.windowLoad, 500)
    });

</script>

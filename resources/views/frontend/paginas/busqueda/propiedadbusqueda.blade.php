@include('frontend.menu.superior')
@include('frontend.menu.body.bodypaginate')
@include("frontend.menu.navbar")


<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">



<!-- START SECTION PROPERTIES LISTING -->
<section class="properties-list featured portfolio blog">
    <div class="container">






        <!-- START SECTION PROPERTIES LISTING -->
        <section class="properties-right featured portfolio blog pt-5">
            <div class="container">
                <section class="headings-2 pt-0 pb-55">
                    <div class="pro-wrapper">
                        <div class="detail-wrapper-body">
                            <div class="listing-title-bar">
                                <h3>Propiedades</h3>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="row">
                    <div class="col-lg-8 col-md-12 blog-pots">
                        <section class="headings-2 pt-0">
                            <div class="pro-wrapper">
                                <div class="detail-wrapper-body">
                                    <div class="listing-title-bar">
                                        <div class="text-heading text-left">
                                            <p class="font-weight-bold mb-0 mt-3">{{ $arrayPropiedad->count() }} resultados</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="cod-pad single detail-wrapper mr-2 mt-0 d-flex justify-content-md-end align-items-center grid">
                                    <div class="input-group border rounded input-group-lg w-auto mr-4">
                                        <label class="input-group-text bg-transparent border-0 text-uppercase letter-spacing-093 pr-1 pl-3" for="inputGroupSelect01"><i class="fas fa-align-left fs-16 pr-2"></i>Ordenar:</label>
                                        <select class="form-control border-0 bg-transparent shadow-none p-0 selectpicker sortby" data-style="bg-transparent border-0 font-weight-600 btn-lg pl-0 pr-3" id="select-ordenado"
                                        onchange="cambiarOrdenada()">

                                         @if($formaOrdenado == 'ASC')
                                                <option value="ASC" selected>Precio (menor a mayor)</option>
                                                <option value="DESC">Precio (mayor a menor)</option>
                                         @else
                                                <option value="ASC">Precio (menor a mayor)</option>
                                                <option value="DESC" selected>Precio (mayor a menor)</option>
                                         @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="row">
                            <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                <div class="project-single" data-aos="fade-up">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                <div class="homes-tag button alt featured">Featured</div>
                                                <div class="homes-tag button alt sale">For Sale</div>
                                                <div class="homes-price">$9,000/mo</div>
                                                <img src="images/blog/b-11.jpg" alt="home-1" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                            <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="single-property-1.html">
                                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix pb-3">
                                            <li class="the-icons">
                                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                <span>6 Bedrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                <span>3 Bathrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                <span>720 sq ft</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                                <span>2 Garages</span>
                                            </li>
                                        </ul>
                                        <div class="footer">
                                            <a href="agent-details.html">
                                                <img src="images/testimonials/ts-1.jpg" alt="" class="mr-2"> Lisa Jhonson
                                            </a>
                                            <span>2 months ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                <div class="project-single" data-aos="fade-up">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                <div class="homes-tag button alt featured">Featured</div>
                                                <div class="homes-tag button alt sale">For Sale</div>
                                                <div class="homes-price">$9,000/mo</div>
                                                <img src="images/blog/b-11.jpg" alt="home-1" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                            <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="single-property-1.html">
                                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix pb-3">
                                            <li class="the-icons">
                                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                <span>6 Bedrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                <span>3 Bathrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                <span>720 sq ft</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                                <span>2 Garages</span>
                                            </li>
                                        </ul>
                                        <div class="footer">
                                            <a href="agent-details.html">
                                                <img src="images/testimonials/ts-1.jpg" alt="" class="mr-2"> Lisa Jhonson
                                            </a>
                                            <span>2 months ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                <div class="project-single" data-aos="fade-up">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                <div class="homes-tag button alt featured">Featured</div>
                                                <div class="homes-tag button alt sale">For Sale</div>
                                                <div class="homes-price">$9,000/mo</div>
                                                <img src="images/blog/b-11.jpg" alt="home-1" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                            <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="single-property-1.html">
                                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix pb-3">
                                            <li class="the-icons">
                                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                <span>6 Bedrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                <span>3 Bathrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                <span>720 sq ft</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                                <span>2 Garages</span>
                                            </li>
                                        </ul>
                                        <div class="footer">
                                            <a href="agent-details.html">
                                                <img src="images/testimonials/ts-1.jpg" alt="" class="mr-2"> Lisa Jhonson
                                            </a>
                                            <span>2 months ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item col-lg-6 col-md-6 col-xs-12 landscapes sale">
                                <div class="project-single" data-aos="fade-up">
                                    <div class="project-inner project-head">
                                        <div class="homes">
                                            <!-- homes img -->
                                            <a href="single-property-1.html" class="homes-img">
                                                <div class="homes-tag button alt featured">Featured</div>
                                                <div class="homes-tag button alt sale">For Sale</div>
                                                <div class="homes-price">$9,000/mo</div>
                                                <img src="images/blog/b-11.jpg" alt="home-1" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="button-effect">
                                            <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                            <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                            <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                        </div>
                                    </div>
                                    <!-- homes content -->
                                    <div class="homes-content">
                                        <!-- homes address -->
                                        <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                        <p class="homes-address mb-3">
                                            <a href="single-property-1.html">
                                                <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
                                            </a>
                                        </p>
                                        <!-- homes List -->
                                        <ul class="homes-list clearfix pb-3">
                                            <li class="the-icons">
                                                <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                                <span>6 Bedrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                                <span>3 Bathrooms</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                                <span>720 sq ft</span>
                                            </li>
                                            <li class="the-icons">
                                                <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                                <span>2 Garages</span>
                                            </li>
                                        </ul>
                                        <div class="footer">
                                            <a href="agent-details.html">
                                                <img src="images/testimonials/ts-1.jpg" alt="" class="mr-2"> Lisa Jhonson
                                            </a>
                                            <span>2 months ago</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>



                    <aside class="col-lg-4 col-md-12 car">
                        <div class="widget">
                            <!-- Search Fields -->
                            <div class="widget-boxed main-search-field">
                                <div class="widget-boxed-header">
                                    <h4>Buscador</h4>
                                </div>
                                <!-- Search Form -->
                                <div class="trip-search">
                                    <form class="form">



                                        <div class="form-group looking">
                                            <div class="first-select wide">
                                                <div class="main-search-input-item">
                                                    <input type="text" placeholder="Buscar..."  id="nombre-propiedad" value="{{ $nombre }}" />
                                                </div>
                                            </div>
                                        </div>




                                        <div class="form-group looking">
                                            <div class="first-select wide">
                                                <p>Rango de Precios</p>
                                                <div class="main-search-input-item">
                                                    <input type="number" placeholder="Mínimo" min="0" id="minimo-propiedad" value="{{ $precioMinimo }}" />
                                                </div>

                                                <div class="main-search-input-item" style="margin-top: 25px">
                                                    <input type="number" placeholder="Mínimo"  min="0" max="15000000" id="maximo-propiedad" value="{{ $precioMaximo }}" />
                                                </div>
                                            </div>
                                        </div>




                                        <!--/ End Form Bathrooms -->
                                    </form>
                                </div>

                                <div class="col-lg-12 no-pds">
                                    <div class="at-col-default-mar">
                                        <button class="btn btn-default hvr-bounce-to-right" type="button" onclick="buscador()">Buscar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </aside>
                </div>
                <nav aria-label="..." class="agents pt-55">
                    <ul class="pagination disabled">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </section>
        <!-- END SECTION PROPERTIES LISTING -->








        @if ($arrayPropiedad->isEmpty())
            <p>Ninguna Propiedad encontrada</p>
        @else
            <div class="row">

            @foreach ($arrayPropiedad as $dato)

                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                        <div class="project-single" data-aos="fade-up">

                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="single-property-1.html" class="homes-img">
                                        <div class="homes-tag button alt featured">Featured</div>
                                        <div class="homes-tag button alt sale">For Sale</div>
                                        <div class="homes-price">$9,000/mo</div>
                                        <img src="images/blog/b-11.jpg" alt="home-1" class="img-responsive">
                                    </a>
                                </div>
                                <div class="button-effect">
                                    <a href="single-property-1.html" class="btn"><i class="fa fa-link"></i></a>
                                    <a href="https://www.youtube.com/watch?v=14semTlwyUY" class="btn popup-video popup-youtube"><i class="fas fa-video"></i></a>
                                    <a href="single-property-2.html" class="img-poppu btn"><i class="fa fa-photo"></i></a>
                                </div>
                            </div>


                            <!-- homes content -->
                            <div class="homes-content">
                                <!-- homes address -->
                                <h3><a href="single-property-1.html">Real House Luxury Villa</a></h3>
                                <p class="homes-address mb-3">
                                    <a href="single-property-1.html">
                                        <i class="fa fa-map-marker"></i><span>Est St, 77 - Central Park South, NYC</span>
                                    </a>
                                </p>
                                <!-- homes List -->
                                <ul class="homes-list clearfix pb-3">
                                    <li class="the-icons">
                                        <i class="flaticon-bed mr-2" aria-hidden="true"></i>
                                        <span>6 Bedrooms</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-bathtub mr-2" aria-hidden="true"></i>
                                        <span>3 Bathrooms</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-square mr-2" aria-hidden="true"></i>
                                        <span>720 sq ft</span>
                                    </li>
                                    <li class="the-icons">
                                        <i class="flaticon-car mr-2" aria-hidden="true"></i>
                                        <span>2 Garages</span>
                                    </li>
                                </ul>
                                <div class="footer">
                                    <a href="agent-details.html">
                                        <img src="images/testimonials/ts-1.jpg" alt="" class="mr-2"> Lisa Jhonson
                                    </a>
                                    <span>2 months ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div> <!-- END ROW -->


            {{ $arrayPropiedad->appends(['nombre' => $nombre, 'minimo' => $precioMinimo, 'maximo' => $precioMaximo])->links() }}


        @endif










    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->


@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")

<script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>

<script>

    var opcionesPersonalizadas = {
        closeButton: true,
        progressBar: true,
        timeOut: 5000,
        extendedTimeOut: 2000,
        myCustomOption: 'custom-value',
        toastClass: 'toast-custom'
    };

    toastr.options = opcionesPersonalizadas;


    function cambiarOrdenada(){

        var minimo = document.getElementById('minimo-propiedad').value;
        var maximo = document.getElementById('maximo-propiedad').value;

        var nombre = document.getElementById('nombre-propiedad').value;
        var ordenado = document.getElementById('select-ordenado').value;

        var reglaNumeroDosDecimal = /^([0-9]+\.?[0-9]{0,2})$/;

        if(minimo.length > 0){
            if(!minimo.match(reglaNumeroDosDecimal)) {
                toastr.error('Precio Mínimo debe ser Decimal Positivo. Solo se permite 2 Decimales');
                return;
            }

            if(minimo < 0){
                toastr.error('Precio Mínimo no debe ser negativo');
                return;
            }

            if(minimo > 9000000){
                toastr.error('Precio Mínimo debe tener máximo 9 millones');
                return;
            }
        }

        if(maximo.length > 0){
            if(!maximo.match(reglaNumeroDosDecimal)) {
                toastr.error('Precio Máximo debe ser Decimal Positivo. Solo se permite 2 Decimales');
                return;
            }

            if(maximo < 0){
                toastr.error('Precio Máximo no debe ser negativo');
                return;
            }

            if(maximo > 9000000){
                toastr.error('Precio Máximo debe tener máximo 9 millones');
                return;
            }
        }

        var url = '/busqueda?nombre=' + encodeURIComponent(nombre) + '&ordenado=' + encodeURIComponent(ordenado) + '&minimo=' + encodeURIComponent(minimo) + '&maximo=' + encodeURIComponent(maximo);
        window.location.href = url;
    }

    function buscador(){
        var minimo = document.getElementById('minimo-propiedad').value;
        var maximo = document.getElementById('maximo-propiedad').value;

        var nombre = document.getElementById('nombre-propiedad').value;
        var ordenado = document.getElementById('select-ordenado').value;

        var reglaNumeroDosDecimal = /^([0-9]+\.?[0-9]{0,2})$/;

        if(minimo.length > 0){
            if(!minimo.match(reglaNumeroDosDecimal)) {
                toastr.error('Precio Mínimo debe ser Decimal Positivo. Solo se permite 2 Decimales');
                return;
            }

            if(minimo < 0){
                toastr.error('Precio Mínimo no debe ser negativo');
                return;
            }

            if(minimo > 9000000){
                toastr.error('Precio Mínimo debe tener máximo 9 millones');
                return;
            }
        }

        if(maximo.length > 0){
            if(!maximo.match(reglaNumeroDosDecimal)) {
                toastr.error('Precio Máximo debe ser Decimal Positivo. Solo se permite 2 Decimales');
                return;
            }

            if(maximo < 0){
                toastr.error('Precio Máximo no debe ser negativo');
                return;
            }

            if(maximo > 9000000){
                toastr.error('Precio Máximo debe tener máximo 9 millones');
                return;
            }
        }




        var url = '/busqueda?nombre=' + encodeURIComponent(nombre) + '&ordenado=' + encodeURIComponent(ordenado) + '&minimo=' + encodeURIComponent(minimo) + '&maximo=' + encodeURIComponent(maximo);
        window.location.href = url;
    }



</script>




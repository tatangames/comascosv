@include('frontend.menu.superior')
@include('frontend.menu.body.bodypaginate')
@include("frontend.menu.navbar")






<!-- START SECTION PROPERTIES LISTING -->
<section class="properties-list featured portfolio blog">
    <div class="container">



        <!-- STAR HEADER SEARCH -->
        <section>

            <div class="tab-pane fade show active">

                <div class="row">

                    <div class="col-md-4">
                        <div class="rld-single-input">
                            <input type="text" id="nombre-propiedad" placeholder="Buscar..." style="width: 100%">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label>Rago de Precio</label>
                        <div class="range-slider" style="margin-left: 5px; margin-top: 8px">
                            <div id="price-range" type="range" data-min="0" data-max="800000" data-unit="$" name="rangoPrecio"></div>
                            <div class="clearfix"></div>
                        </div>



                    </div>

                    <div class="col-md-4">

                        <div class="col-xl-2 col-lg-2 col-md-4 pl-0">
                            <a class="btn btn-yellow" onclick="buscarPropiedad()" style="margin-left: 20px">Buscar</a>
                        </div>

                    </div>







                </div>

            </div>

        </section>
        <!-- END HEADER SEARCH -->





        <div class="row">
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


        </div>


        <nav aria-label="..." class="pt-3">
            <ul class="pagination mt-0">
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




@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")





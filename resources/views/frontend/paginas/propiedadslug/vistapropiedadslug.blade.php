@include('frontend.menu.superior')
@include('frontend.menu.body.bodypropiedad')
@include("frontend.menu.navbar")




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

                        @if($arrayDetalle1 != null)
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

                        @if($arrayDetalle2 != null)
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



                @if($arrayPlanos != null)
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
                        <img alt="image" src="{{ url('storage/archivos/'.$infoPropi->video_imagen) }}">
                        <a class="icon-wrap popup-video popup-youtube" href="{{ $infoPropi->video_url }}">
                            <i class="fa fa-play"></i>
                        </a>
                        <div class="iq-waves">
                            <div class="waves wave-1"></div>
                            <div class="waves wave-2"></div>
                            <div class="waves wave-3"></div>
                        </div>
                    </div>



                @endif





                @if($infoPropi->latitud != null && $infoPropi->longitud2 != null)

                    <div class="property-location map">
                        <h5>Mapa</h5>
                        <div class="divider-fade"></div>
                        <div id="colorlib-reservation">
                            <div class="container">
                                <div class="row animate-box">
                                    <div class="col-md-12">
                                        <iframe
                                            width="600"
                                            height="450"
                                            frameborder="0" style="border:0"
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3877.1868313109383!2d{{ $infoPropi->longitud }}!3d{{ $infoPropi->latitud }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259e53546e9cf%3A0x1c3bb99243deb742!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1646076979147!5m2!1sen!2sus" allowfullscreen>
                                        </iframe>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                @endif






            </div>
            <aside class="col-lg-4 col-md-12 car">
                <div class="single widget">
                    <!-- Start: Schedule a Tour -->
                    <div class="schedule widget-boxed mt-33 mt-0">
                        <div class="widget-boxed-header">
                            <h4><i class="fa fa-calendar pr-3 padd-r-10"></i>Schedule a Tour</h4>
                        </div>
                        <div class="widget-boxed-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 book">
                                    <input type="text" id="reservation-date" data-lang="en" data-large-mode="true" data-min-year="2017" data-max-year="2020" data-disabled-days="08/17/2017,08/18/2017" data-id="datedropper-0" data-theme="my-style" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-6 col-md-12 book2">
                                    <input type="text" id="reservation-time" class="form-control" readonly="">
                                </div>
                            </div>
                            <div class="row mrg-top-15 mb-3">
                                <div class="col-lg-6 col-md-12 mt-4">
                                    <label class="mb-4">Adult</label>
                                    <div class="input-group">
                                                <span class="input-group-btn">
										 <button type="button" class="btn counter-btn theme-cl btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
											 <i class="fa fa-minus"></i>
										 </button>
									        </span>
                                        <input type="text" name="quant[1]" class="border-0 text-center form-control input-number" data-min="0" data-max="10" value="0">
                                        <span class="input-group-btn">
											 <button type="button" class="btn counter-btn theme-cl btn-number" data-type="plus" data-field="quant[1]">
											  <i class="fa fa-plus"></i>
											 </button>
									        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 mt-4">
                                    <label class="mb-4">Children</label>
                                    <div class="input-group">
                                                <span class="input-group-btn">
										 <button type="button" class="btn counter-btn theme-cl btn-number" disabled="disabled" data-type="minus" data-field="quant[2]">
											 <i class="fa fa-minus"></i>
										 </button>
									        </span>
                                        <input type="text" name="quant[2]" class="border-0 text-center form-control input-number" data-min="0" data-max="10" value="0">
                                        <span class="input-group-btn">
											 <button type="button" class="btn counter-btn theme-cl btn-number" data-type="plus" data-field="quant[2]">
											  <i class="fa fa-plus"></i>
											 </button>
									        </span>
                                    </div>
                                </div>
                            </div>
                            <a href="payment-method.html" class="btn reservation btn-radius theme-btn full-width mrg-top-10">Submit Request</a>
                        </div>
                    </div>
                    <!-- End: Schedule a Tour -->
                    <!-- end author-verified-badge -->
                    <div class="sidebar">
                        <div class="widget-boxed mt-33 mt-5">
                            <div class="widget-boxed-header">
                                <h4>Agent Information</h4>
                            </div>
                            <div class="widget-boxed-body">
                                <div class="sidebar-widget author-widget2">
                                    <div class="author-box clearfix">
                                        <img src="images/testimonials/ts-1.jpg" alt="author-image" class="author__img">
                                        <h4 class="author__title">Lisa Clark</h4>
                                        <p class="author__meta">Agent of Property</p>
                                    </div>
                                    <ul class="author__contact">
                                        <li><span class="la la-map-marker"><i class="fa fa-map-marker"></i></span>302 Av Park, New York</li>
                                        <li><span class="la la-phone"><i class="fa fa-phone" aria-hidden="true"></i></span><a href="#">(234) 0200 17813</a></li>
                                        <li><span class="la la-envelope-o"><i class="fa fa-envelope" aria-hidden="true"></i></span><a href="#">lisa@gmail.com</a></li>
                                    </ul>
                                    <div class="agent-contact-form-sidebar">
                                        <h4>Request Inquiry</h4>
                                        <form name="contact_form" method="post" action="functions.php">
                                            <input type="text" id="fname" name="full_name" placeholder="Full Name" required />
                                            <input type="number" id="pnumber" name="phone_number" placeholder="Phone Number" required />
                                            <input type="email" id="emailid" name="email_address" placeholder="Email Address" required />
                                            <textarea placeholder="Message" name="message" required></textarea>
                                            <input type="submit" name="sendmessage" class="multiple-send-message" value="Submit Request" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="main-search-field-2">
                            <div class="widget-boxed mt-5">
                                <div class="widget-boxed-header">
                                    <h4>Recent Properties</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="recent-post">
                                        <div class="recent-main">
                                            <div class="recent-img">
                                                <a href="blog-details.html"><img src="images/feature-properties/fp-1.jpg" alt=""></a>
                                            </div>
                                            <div class="info-img">
                                                <a href="blog-details.html"><h6>Family Home</h6></a>
                                                <p>$230,000</p>
                                            </div>
                                        </div>
                                        <div class="recent-main my-4">
                                            <div class="recent-img">
                                                <a href="blog-details.html"><img src="images/feature-properties/fp-2.jpg" alt=""></a>
                                            </div>
                                            <div class="info-img">
                                                <a href="blog-details.html"><h6>Family Home</h6></a>
                                                <p>$230,000</p>
                                            </div>
                                        </div>
                                        <div class="recent-main">
                                            <div class="recent-img">
                                                <a href="blog-details.html"><img src="images/feature-properties/fp-3.jpg" alt=""></a>
                                            </div>
                                            <div class="info-img">
                                                <a href="blog-details.html"><h6>Family Home</h6></a>
                                                <p>$230,000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-boxed mt-5">
                                <div class="widget-boxed-header mb-5">
                                    <h4>Feature Properties</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="slick-lancers">
                                        <div class="agents-grid mr-0">
                                            <div class="listing-item compact">
                                                <a href="properties-details.html" class="listing-img-container">
                                                    <div class="listing-badges">
                                                        <span class="featured">$ 230,000</span>
                                                        <span>For Sale</span>
                                                    </div>
                                                    <div class="listing-img-content">
                                                        <span class="listing-compact-title">House Luxury <i>New York</i></span>
                                                        <ul class="listing-hidden-content">
                                                            <li>Area <span>720 sq ft</span></li>
                                                            <li>Rooms <span>6</span></li>
                                                            <li>Beds <span>2</span></li>
                                                            <li>Baths <span>3</span></li>
                                                        </ul>
                                                    </div>
                                                    <img src="images/feature-properties/fp-1.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="agents-grid mr-0">
                                            <div class="listing-item compact">
                                                <a href="properties-details.html" class="listing-img-container">
                                                    <div class="listing-badges">
                                                        <span class="featured">$ 6,500</span>
                                                        <span class="rent">For Rent</span>
                                                    </div>
                                                    <div class="listing-img-content">
                                                        <span class="listing-compact-title">House Luxury <i>Los Angles</i></span>
                                                        <ul class="listing-hidden-content">
                                                            <li>Area <span>720 sq ft</span></li>
                                                            <li>Rooms <span>6</span></li>
                                                            <li>Beds <span>2</span></li>
                                                            <li>Baths <span>3</span></li>
                                                        </ul>
                                                    </div>
                                                    <img src="images/feature-properties/fp-2.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="agents-grid mr-0">
                                            <div class="listing-item compact">
                                                <a href="properties-details.html" class="listing-img-container">
                                                    <div class="listing-badges">
                                                        <span class="featured">$ 230,000</span>
                                                        <span>For Sale</span>
                                                    </div>
                                                    <div class="listing-img-content">
                                                        <span class="listing-compact-title">House Luxury <i>San Francisco</i></span>
                                                        <ul class="listing-hidden-content">
                                                            <li>Area <span>720 sq ft</span></li>
                                                            <li>Rooms <span>6</span></li>
                                                            <li>Beds <span>2</span></li>
                                                            <li>Baths <span>3</span></li>
                                                        </ul>
                                                    </div>
                                                    <img src="images/feature-properties/fp-3.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="agents-grid mr-0">
                                            <div class="listing-item compact">
                                                <a href="properties-details.html" class="listing-img-container">
                                                    <div class="listing-badges">
                                                        <span class="featured">$ 6,500</span>
                                                        <span class="rent">For Rent</span>
                                                    </div>
                                                    <div class="listing-img-content">
                                                        <span class="listing-compact-title">House Luxury <i>Miami FL</i></span>
                                                        <ul class="listing-hidden-content">
                                                            <li>Area <span>720 sq ft</span></li>
                                                            <li>Rooms <span>6</span></li>
                                                            <li>Beds <span>2</span></li>
                                                            <li>Baths <span>3</span></li>
                                                        </ul>
                                                    </div>
                                                    <img src="images/feature-properties/fp-4.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="agents-grid mr-0">
                                            <div class="listing-item compact">
                                                <a href="properties-details.html" class="listing-img-container">
                                                    <div class="listing-badges">
                                                        <span class="featured">$ 230,000</span>
                                                        <span>For Sale</span>
                                                    </div>
                                                    <div class="listing-img-content">
                                                        <span class="listing-compact-title">House Luxury <i>Chicago IL</i></span>
                                                        <ul class="listing-hidden-content">
                                                            <li>Area <span>720 sq ft</span></li>
                                                            <li>Rooms <span>6</span></li>
                                                            <li>Beds <span>2</span></li>
                                                            <li>Baths <span>3</span></li>
                                                        </ul>
                                                    </div>
                                                    <img src="images/feature-properties/fp-5.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="agents-grid mr-0">
                                            <div class="listing-item compact">
                                                <a href="properties-details.html" class="listing-img-container">
                                                    <div class="listing-badges">
                                                        <span class="featured">$ 6,500</span>
                                                        <span class="rent">For Rent</span>
                                                    </div>
                                                    <div class="listing-img-content">
                                                        <span class="listing-compact-title">House Luxury <i>Toronto CA</i></span>
                                                        <ul class="listing-hidden-content">
                                                            <li>Area <span>720 sq ft</span></li>
                                                            <li>Rooms <span>6</span></li>
                                                            <li>Beds <span>2</span></li>
                                                            <li>Baths <span>3</span></li>
                                                        </ul>
                                                    </div>
                                                    <img src="images/feature-properties/fp-6.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Start: Specials offer -->
                            <div class="widget-boxed popular mt-5">
                                <div class="widget-boxed-header">
                                    <h4>Specials of the day</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="banner"><img src="images/single-property/banner.jpg" alt=""></div>
                                </div>
                            </div>
                            <!-- End: Specials offer -->
                            <div class="widget-boxed popular mt-5">
                                <div class="widget-boxed-header">
                                    <h4>Popular Tags</h4>
                                </div>
                                <div class="widget-boxed-body">
                                    <div class="recent-post">
                                        <div class="tags">
                                            <span><a href="#" class="btn btn-outline-primary">Houses</a></span>
                                            <span><a href="#" class="btn btn-outline-primary">Real Home</a></span>
                                        </div>
                                        <div class="tags">
                                            <span><a href="#" class="btn btn-outline-primary">Baths</a></span>
                                            <span><a href="#" class="btn btn-outline-primary">Beds</a></span>
                                        </div>
                                        <div class="tags">
                                            <span><a href="#" class="btn btn-outline-primary">Garages</a></span>
                                            <span><a href="#" class="btn btn-outline-primary">Family</a></span>
                                        </div>
                                        <div class="tags">
                                            <span><a href="#" class="btn btn-outline-primary">Real Estates</a></span>
                                            <span><a href="#" class="btn btn-outline-primary">Properties</a></span>
                                        </div>
                                        <div class="tags no-mb">
                                            <span><a href="#" class="btn btn-outline-primary">Location</a></span>
                                            <span><a href="#" class="btn btn-outline-primary">Price</a></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
        <!-- START SIMILAR PROPERTIES -->
        <section class="similar-property featured portfolio p-0 bg-white-inner">
            <div class="container">
                <h5>Similar Properties</h5>
                <div class="row portfolio-items">
                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes">
                        <div class="project-single">
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
                    <div class="item col-lg-4 col-md-6 col-xs-12 people">
                        <div class="project-single">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="single-property-1.html" class="homes-img">
                                        <div class="homes-tag button sale rent">For Rent</div>
                                        <div class="homes-price">$3,000/mo</div>
                                        <img src="images/blog/b-12.jpg" alt="home-1" class="img-responsive">
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
                                        <img src="images/testimonials/ts-2.jpg" alt="" class="mr-2"> Karl Smith
                                    </a>
                                    <span>2 months ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item col-lg-4 col-md-6 col-xs-12 people landscapes no-pb pbp-3">
                        <div class="project-single no-mb mbp-3">
                            <div class="project-inner project-head">
                                <div class="homes">
                                    <!-- homes img -->
                                    <a href="single-property-1.html" class="homes-img">
                                        <div class="homes-tag button alt sale">For Sale</div>
                                        <div class="homes-price">$9,000/mo</div>
                                        <img src="images/blog/b-1.jpg" alt="home-1" class="img-responsive">
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
                                        <img src="images/testimonials/ts-3.jpg" alt="" class="mr-2"> katy Teddy
                                    </a>
                                    <span>2 months ago</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END SIMILAR PROPERTIES -->
    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->





@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")








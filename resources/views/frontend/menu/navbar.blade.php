<header id="header-container">
    <!-- Header -->
    <div id="header">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="{{ route('inicio') }}"><img src="{{ asset('images/logocomasco.png') }}" alt=""></a>
                </div>
                <!-- Mobile Navigation -->
                <div class="mmenu-trigger">
                    <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
							<span class="hamburger-inner"></span>
                                </span>
                    </button>
                </div>
                <!-- Main Navigation -->
                <nav id="navigation" class="style-1">
                    <ul id="responsive">

                        <li><a href="{{ route('inicio') }}">Inicio</a></li>

                        <li><a href="#">Listing</a>
                            <ul>
                                <li><a href="#">Listing Grid</a>
                                    <ul>
                                        <li><a href="properties-grid-1.html">Grid View 1</a></li>
                                        <li><a href="properties-grid-2.html">Grid View 2</a></li>
                                        <li><a href="properties-grid-3.html">Grid View 3</a></li>
                                        <li><a href="properties-grid-4.html">Grid View 4</a></li>
                                        <li><a href="properties-full-grid-1.html">Grid Fullwidth 1</a></li>
                                        <li><a href="properties-full-grid-2.html">Grid Fullwidth 2</a></li>
                                        <li><a href="properties-full-grid-3.html">Grid Fullwidth 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Listing List</a>
                                    <ul>
                                        <li><a href="properties-full-list-1.html">List View 1</a></li>
                                        <li><a href="properties-list-1.html">List View 2</a></li>
                                        <li><a href="properties-full-list-2.html">List View 3</a></li>
                                        <li><a href="properties-list-2.html">List View 4</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Listing Map</a>
                                    <ul>
                                        <li><a href="properties-half-map-1.html">Half Map 1</a></li>
                                        <li><a href="properties-half-map-2.html">Half Map 2</a></li>
                                        <li><a href="properties-half-map-3.html">Half Map 3</a></li>
                                        <li><a href="properties-top-map-1.html">Top Map 1</a></li>
                                        <li><a href="properties-top-map-2.html">Top Map 2</a></li>
                                        <li><a href="properties-top-map-3.html">Top Map 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Agent View</a>
                                    <ul>
                                        <li><a href="agents-listing-grid.html">Agent View 1</a></li>
                                        <li><a href="agents-listing-row.html">Agent View 2</a></li>
                                        <li><a href="agents-listing-row-2.html">Agent View 3</a></li>
                                        <li><a href="agent-details.html">Agent Details</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Agencies View</a>
                                    <ul>
                                        <li><a href="agencies-listing-1.html">Agencies View 1</a></li>
                                        <li><a href="agencies-listing-2.html">Agencies View 2</a></li>
                                        <li><a href="agencies-details.html">Agencies Details</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#">Property</a>
                            <ul>
                                <li><a href="single-property-1.html">Single Property 1</a></li>
                                <li><a href="single-property-2.html">Single Property 2</a></li>
                                <li><a href="single-property-3.html">Single Property 3</a></li>
                                <li><a href="single-property-4.html">Single Property 4</a></li>
                                <li><a href="single-property-5.html">Single Property 5</a></li>
                                <li><a href="single-property-6.html">Single Property 6</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Página</a>
                            <ul>
                                <li><a href="{{ route('preguntas.frecuentes') }}">Preguntas Frecuentes</a></li>
                                <li><a href="faq.html">Faq</a></li>
                                <li><a href="pricing-table.html">Pricing Tables</a></li>
                                <li><a href="404.html">Page 404</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                                <li><a href="under-construction.html">Under Construction</a></li>
                                <li><a href="ui-element.html">UI Elements</a></li>
                            </ul>
                        </li>


                        <li><a href="{{ route('quienes.somos') }}">Quienes Somos</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto</a></li>

                    </ul>
                </nav>
                <!-- Main Navigation / End -->
            </div>
            <!-- Left Side Content / End -->







        </div>
    </div>
    <!-- Header / End -->

</header>

<div class="clearfix"></div>
<!-- Header Container / End -->

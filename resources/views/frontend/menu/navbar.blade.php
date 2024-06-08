
<style>
    @media only screen and (max-width: 768px) {
        .mobile-only {
            display: block !important; /* Mostrar el elemento en dispositivos móviles */
        }
    }

    /* Opcional: ocultar el elemento en dispositivos que no son móviles */
    @media only screen and (min-width: 769px) {
        .mobile-only {
            display: none !important; /* Ocultar el elemento en dispositivos que no son móviles */
        }
    }
</style>


<header id="header-container">
    <!-- Header -->
    <div id="header">
        <div class="container container-header">
            <!-- Left Side Content -->
            <div class="left-side">
                <!-- Logo -->
                <div id="logo">
                    <a href="{{ route('inicio') }}"><img src="{{ asset('images/iconlogo.png') }}" alt=""></a>
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
                        <li><a href="{{ route('propiedad.mapa') }}">Mapa</a></li>
                        <li><a href="{{ route('preguntas.frecuentes') }}">Preguntas Frecuentes</a></li>
                        <li><a href="{{ route('quienes.somos') }}">Quienes Somos</a></li>
                        <li><a href="{{ route('contacto') }}">Contacto</a></li>

                        <li class="mobile-only"><a href="{{ route('propiedad.buscada') }}">Propiedades</a></li>

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

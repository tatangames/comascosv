<!-- ARCHIVES JS -->
<script src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>


<script src="{{ asset('frontend/js/rangeSlider.js') }}"></script>
<script src="{{ asset('frontend/js/tether.min.js') }}"></script>
<script src="{{ asset('frontend/js/moment.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/mmenu.min.js') }}"></script>
<script src="{{ asset('frontend/js/mmenu.js') }}"></script>
<script src="{{ asset('frontend/js/aos.js') }}"></script>
<script src="{{ asset('frontend/js/aos2.js') }}"></script>
<script src="{{ asset('frontend/js/animate.js') }}"></script>
<script src="{{ asset('frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend/js/fitvids.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('frontend/js/typed.min.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('frontend/js/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('frontend/js/lightcase.js') }}"></script>
<script src="{{ asset('frontend/js/search.js') }}"></script>
<script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend/js/ajaxchimp.min.js') }}"></script>
<script src="{{ asset('frontend/js/newsletter.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.form.js') }}"></script>
<script src="{{ asset('frontend/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('frontend/js/searched.js') }}"></script>
<script src="{{ asset('frontend/js/forms-2.js') }}"></script>
<script src="{{ asset('frontend/js/map-style2.js') }}"></script>
<script src="{{ asset('frontend/js/range.js') }}"></script>
<script src="{{ asset('frontend/js/color-switcher.js') }}"></script>

<script>
    $(window).on('scroll load', function() {
        $("#header.cloned #logo img").attr("src", $('#header #logo img').attr('data-sticky-logo'));
    });

</script>


<script src="{{ asset('frontend/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('frontend/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

<script>
    var typed = new Typed('.typed', {
        strings: ["House ^2000", "Apartment ^2000", "Plaza ^4000"],
        smartBackspace: false,
        loop: true,
        showCursor: true,
        cursorChar: "|",
        typeSpeed: 50,
        backSpeed: 30,
        startDelay: 800
    });

</script>

<script>
    $('.slick-lancers').slick({
        infinite: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true,
        responsive: [{
            breakpoint: 1292,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 993,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                dots: true,
                arrows: false
            }
        }, {
            breakpoint: 769,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                dots: true,
                arrows: false
            }
        }]
    });

</script>

<script>
    $('.job_clientSlide').owlCarousel({
        items: 2,
        loop: true,
        margin: 30,
        autoplay: false,
        nav: true,
        smartSpeed: 1000,
        slideSpeed: 1000,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            991: {
                items: 3
            }
        }
    });

</script>

<script>
    $('.style2').owlCarousel({
        loop: true,
        margin: 0,
        dots: false,
        autoWidth: false,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive: {
            0: {
                items: 2,
                margin: 20
            },
            400: {
                items: 2,
                margin: 20
            },
            500: {
                items: 3,
                margin: 20
            },
            768: {
                items: 4,
                margin: 20
            },
            992: {
                items: 5,
                margin: 20
            },
            1000: {
                items: 7,
                margin: 20
            }
        }
    });

</script>

<script>
    $(".dropdown-filter").on('click', function() {

        $(".explore__form-checkbox-list").toggleClass("filter-block");

    });

</script>

<!-- MAIN JS -->
<script src="{{ asset('frontend/js/script.js') }}"></script>

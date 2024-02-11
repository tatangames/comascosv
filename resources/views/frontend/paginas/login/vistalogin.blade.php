@include('frontend.menu.superior')
@include("frontend.menu.navbar")


<section class="headings">

</section>
<!-- END SECTION HEADINGS -->

<link rel="stylesheet" href="{{ asset('login/css/stylelogin.css') }}">


    <div class="container" style="margin-top: 30px">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                        <div class="text w-100">
                            <h2>Bienvenido/a</h2>
                            <p>Quieres pertenecer a la familia de Comascosv</p>
                            <p>contactanos a nuestro WhatsApp</p>

                            <a href="https://wa.me/50372068714" class="btn btn-white btn-outline-white">
                                <img src="{{ asset('images/logowasap.png') }}" width="35px" height="35px" alt="Descripción del logo"> 7206-8714</a>
                        </div>
                    </div>
                    <div class="login-wrap p-4 p-lg-5">
                        <div class="d-flex">

                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-facebook"></span></a>
                                    <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-youtube"></span></a>
                                </p>
                            </div>
                        </div>
                        <form action="#" class="signin-form">
                            <div class="form-group mb-3">
                                <label class="label" for="name">Usuario</label>
                                <input type="text" class="form-control" maxlength="100" placeholder="usuario" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Contraseña</label>
                                <input type="password" maxlength="20" class="form-control" placeholder="contraseña" required>
                            </div>
                            <div class="form-group">
                                <button type="button" class="form-control btn btn-primary submit px-3">Iniciar Sesión</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">

                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#">Olvide contraseña?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>








@include("frontend.menu.footer")
@include("frontend.menu.footer-js")
@include("frontend.menu.final")

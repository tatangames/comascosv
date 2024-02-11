@include('frontend.menu.superior')
@include("frontend.menu.navbar")

<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">



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
                                <input type="text" id="usuario" class="form-control" maxlength="100" placeholder="usuario" required>
                            </div>
                            <div class="form-group mb-3">
                                <label class="label" for="password">Contraseña</label>
                                <input type="password" id="password" maxlength="100" class="form-control" placeholder="contraseña" required>
                            </div>
                            <div class="form-group">
                                <button type="button" onclick="login()" class="form-control btn btn-primary submit px-3">Iniciar Sesión</button>
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

<script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/alertaPersonalizada.js') }}" type="text/javascript"></script>

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

    var inputPassword = document.getElementById("password");
    var inputUsuario = document.getElementById("usuario");

    inputPassword.addEventListener("keyup", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            login();
        }
    });

    inputUsuario.addEventListener("keyup", function(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            login();
        }
    });

    function login() {

        var usuario = document.getElementById('usuario').value;
        var password = document.getElementById('password').value;

        if(usuario === ''){
            toastr.error("Usuario es requerido");
            return;
        }

        if(password === ''){
            toastr.error("Contraseña es requerido");
            return;
        }

        openLoading()

        let formData = new FormData();
        formData.append('usuario', usuario);
        formData.append('password', password);

        axios.post('/admin/login', formData, {
        })
            .then((response) => {

                verificar(response);
                closeLoading()

            })
            .catch((error) => {
                closeLoading();
                toastr.error("Error en la respuesta");
            });
    }

    function verificar(response) {

        if (response.data.success === 0) {
            toastr.error("Validación incorrecta");
        } else if (response.data.success === 1) {
            window.location = response.data.ruta;
        } else if (response.data.success === 2) {
            toastr.error("Datos incorrectos");
        }
        else {
            toastr.error('Error');
        }
    }



</script>

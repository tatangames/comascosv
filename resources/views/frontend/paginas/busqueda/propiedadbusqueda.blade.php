@include('frontend.menu.superior')
@include('frontend.menu.body.bodypaginate')
@include("frontend.menu.navbar")


<link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">

<style>

    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
    }

    .pagination li {
        margin: 0 5px;
    }

    .pagination li a,
    .pagination li span {
        display: inline-block;
        padding: 8px 12px;
        color: #333;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        text-decoration: none;
    }

    .pagination li.active span {
        font-weight: bold;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }

    .pagination li.disabled span {
        color: #6c757d;
        cursor: not-allowed;
        background-color: #f8f9fa;
        border-color: #dee2e6;
    }

</style>




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
                                <h4>{{ $nombreUbicacion }}</h4>
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



                        @if ($arrayPropiedad->isEmpty())
                            <p>Ninguna Propiedad encontrada</p>
                        @else
                            <div class="row">

                                @foreach ($arrayPropiedad as $dato)


                                    <div class="item col-lg-4 col-md-6 col-xs-12 landscapes sale">
                                        <div class="project-single" data-aos="fade-up">
                                            <a href="{{ url('propiedad/'.$dato->slug) }}">
                                            <div class="project-inner project-head">
                                                <div class="homes">
                                                    <!-- homes img -->

                                                        <img src="{{ url('storage/archivos/'.$dato->imagen) }}" alt="home-1" class="img-responsive">
                                                </div>
                                            </div>
                                            </a>

                                            <div class="homes-content">

                                                <h3 style="color: #FF385C !important;"><a style="color: #FF385C !important;" href="{{ url('propiedad/'.$dato->slug) }}">{{ $dato->precioFormat }}</a></h3>

                                                <p><a style="color: #444444 !important; font-weight: bold" href="{{ url('propiedad/'.$dato->slug) }}">{{ $dato->nombre }}</a></p>

                                                <p class="homes-address mb-3">
                                                    @if($dato->direccion != null)
                                                        <a href="{{ url('propiedad/'.$dato->slug) }}">
                                                            <i class="fa fa-map-marker"></i><span>{{ $dato->direccion }}</span>
                                                        </a>
                                                    @endif
                                                </p>


                                                <div class="footer">
                                                    <a href="{{ url('propiedad/'.$dato->slug) }}">
                                                        <img src="{{ url('storage/archivos/'.$dato->imagenvendedor) }}" alt="" class="mr-2"> {{ $dato->nombrevendedor }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                @endforeach


                            </div> <!-- END ROW -->




                        @endif
                    </div>


                    <!-- BUSCADOR -->

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
                                                    <input type="number" placeholder="Máximo"  min="0" max="15000000" id="maximo-propiedad" value="{{ $precioMaximo }}" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group looking">
                                            <div class="first-select wide">

                                        <p style="margin-top: 15px">Ubicaciones</p>
                                            </div> </div>
                                        <div>
                                            <!-- Checkboxes -->
                                            <div class="checkboxes one-in-row margin-bottom-10 ch-1">
                                                @foreach ($arrayUbicaciones as $opcion)

                                                    @if($opcion->marcado)
                                                        <input type="checkbox" id="check-{{ $opcion->id }}" name="opciones[]" checked value="{{ $opcion->id }}">
                                                    @else
                                                        <input type="checkbox" id="check-{{ $opcion->id }}" name="opciones[]" value="{{ $opcion->id }}">
                                                    @endif


                                                    <label for="check-{{ $opcion->id }}">{{ $opcion->nombre }}</label>
                                                @endforeach



                                            </div>
                                            <!-- Checkboxes / End -->
                                        </div>


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


            </div>
        </section>
        <!-- END SECTION PROPERTIES LISTING -->



    </div>
</section>
<!-- END SECTION PROPERTIES LISTING -->





<div class="pagination">
    {{ $arrayPropiedad->appends(['nombre' => $nombre, 'minimo' => $precioMinimo, 'maximo' => $precioMaximo])->links('backend.admin.propiedad.paginacion.vistacustom') }}
</div>





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

        var opcionesSeleccionadas = document.querySelectorAll('input[name="opciones[]"]:checked');
        var valoresSeleccionados = [];
        opcionesSeleccionadas.forEach(function(opcion) {
            valoresSeleccionados.push(opcion.value);
        });


        var url = '/busqueda?nombre=' + encodeURIComponent(nombre) + '&ordenado=' + encodeURIComponent(ordenado) + '&minimo=' + encodeURIComponent(minimo) + '&maximo=' + encodeURIComponent(maximo) + '&opciones=' + encodeURIComponent(JSON.stringify(valoresSeleccionados));
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

        var opcionesSeleccionadas = document.querySelectorAll('input[name="opciones[]"]:checked');
        var valoresSeleccionados = [];
        opcionesSeleccionadas.forEach(function(opcion) {
            valoresSeleccionados.push(opcion.value);
        });


        var url = '/busqueda?nombre=' + encodeURIComponent(nombre) + '&ordenado=' + encodeURIComponent(ordenado) + '&minimo=' + encodeURIComponent(minimo) + '&maximo=' + encodeURIComponent(maximo) + '&opciones=' + encodeURIComponent(JSON.stringify(valoresSeleccionados));
        window.location.href = url;
    }


</script>

<script>
    $(".dropdown-filter").on('click', function() {

        $(".explore__form-checkbox-list").toggleClass("filter-block");

    });

</script>



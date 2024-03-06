@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
@stop

<section class="content-header">
    <div class="container-fluid">

    </div>
</section>

<section class="content" id="divcontenedor" style="display: none">
    <div class="container-fluid" style="margin-left: 15px">
        <div class="row">
            <div class="col-md-10">
                <div class="card card-green">
                    <div class="card-header">
                        <h3 class="card-title">Título Pie de Página</h3>
                    </div>
                    <form>


                        <div class="card-body">
                            <p style="font-weight: bold">Columna 1</p>
                            <div class="form-group" style="width: 40%">
                                <input type="text" maxlength="100" class="form-control" id="columna1" value="{{ $columna1 }}">
                            </div>
                        </div>

                        <button type="button" style="margin-left: 30px" class="btn btn-info btn-xs" onclick="infoFila1()">
                            <i class="fas fa-edit" title="Fila Columna 1"></i>&nbsp; Fila Columna 1
                        </button>

                        <div class="card-body">
                            <p style="font-weight: bold">Columna 2</p>
                            <div class="form-group" style="width: 40%">
                                <input type="text" maxlength="100" class="form-control" id="columna2" value="{{ $columna2 }}">
                            </div>
                        </div>

                        <div class="card-footer" style="float: right;">
                            <button type="button" style="font-weight: bold; background-color: #28a745; color: white !important;" class="button button-3d button-rounded button-pill button-small" onclick="actualizar()">Actualizar</button>
                        </div>

                        <button type="button" style="margin-left: 30px" class="btn btn-info btn-xs" onclick="infoFila2()">
                            <i class="fas fa-edit" title="Fila Columna 2"></i>&nbsp; Fila Columna 2
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</section>

@extends('backend.menus.footerjs')
@section('archivos-js')

    <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>

        function actualizar(){
            var columna1 = document.getElementById('columna1').value;
            var columna2 = document.getElementById('columna2').value;

            if(columna1 === ''){
                toastr.error('Columna 1 es requerido')
                return;
            }

            if(columna2 === ''){
                toastr.error('Columna 2 es requerido')
                return;
            }

            openLoading();
            var formData = new FormData();
            formData.append('columna1', columna1);
            formData.append('columna2', columna2);

            axios.post('/admin/piepagina/actualizar', formData, {
            })
                .then((response) => {
                    closeLoading()

                    if (response.data.success === 1) {
                        toastr.success('Actualizado');
                    }else {
                        toastr.error('Error al actualizar');
                    }
                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('Error al actualizar');
                });
        }


        function infoFila1(){
            window.location.href="{{ url('/admin/piepagina/columna/index') }}/" + 1;
        }

        function infoFila2(){
            window.location.href="{{ url('/admin/piepagina/columna/index') }}/" + 2;
        }

    </script>



@stop

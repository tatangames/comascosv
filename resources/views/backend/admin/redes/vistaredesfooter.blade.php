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
                        <h3 class="card-title">Redes en Pie de Página</h3>
                    </div>
                    <form>

                        <div class="card-body">
                            <p style="font-weight: bold">URL para Youtube</p>
                            <div class="form-group" style="width: 50%">
                                <input type="text" maxlength="200" class="form-control" id="youtube" value="{{ $infoRecursos->url_youtube }}">
                            </div>
                        </div>


                        <div class="card-body">
                            <p style="font-weight: bold">URL para Facebook</p>
                            <div class="form-group" style="width: 50%">
                                <input type="text" maxlength="200" class="form-control" id="facebook" value="{{ $infoRecursos->url_facebook }}">
                            </div>
                        </div>


                        <div class="card-footer" style="float: right;">
                            <button type="button" style="font-weight: bold; background-color: #28a745; color: white !important;" class="button button-3d button-rounded button-pill button-small" onclick="actualizar()">Actualizar</button>
                        </div>
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
    <script src="{{ asset('plugins/ckeditor5v1/build/ckeditor.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>

        function actualizar(){

            var facebook = document.getElementById('facebook').value;
            var youtube = document.getElementById('youtube').value;

            openLoading();
            var formData = new FormData();
            formData.append('youtube', youtube);
            formData.append('facebook', facebook);

            axios.post('/admin/redessociales/actualizar', formData, {
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

    </script>



@stop

@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
@stop

<section class="content-header">
    <div class="container-fluid">
        <div class="col-sm-12">
            <h3>Texto para Página (Quienes Somos)</h3>
        </div>

    </div>
</section>

<section class="content" id="divcontenedor" style="display: none">
    <div class="container-fluid" style="margin-left: 15px">
        <div class="row">
            <div class="col-md-10">
                <div class="card card-green">
                    <div class="card-header">
                        <h3 class="card-title">Descripción</h3>
                    </div>
                    <form>
                        <div class="card-body">

                            <div class="form-group">
                                <textarea name="content" class="form-control" id="editor" rows="12" cols="50">{{ $infoRecurso->quienes_somos }}</textarea>
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

            window.varGlobalEditorNuevo;

            ClassicEditor
                .create(document.querySelector('#editor'), {
                    language: 'es',
                })
                .then(editor => {
                    varGlobalEditorNuevo = editor;
                })
                .catch(error => {

                });

            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>

        function actualizar(){
            const editorData = varGlobalEditorNuevo.getData();

            if (editorData.trim() === '') {
                toastr.error("Descripción es requerida");
                return;
            }

            openLoading()
            var formData = new FormData();
            formData.append('texto', editorData);

            axios.post('/admin/quienessomos/actualizar', formData, {
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

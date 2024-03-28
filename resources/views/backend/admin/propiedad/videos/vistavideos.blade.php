@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />

@stop

<style>
    table{
        /*Ajustar tablas*/
        table-layout:fixed;
    }
</style>

<div id="divcontenedor" style="display: none">

    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <button type="button" onclick="modalAgregar()" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-square"></i>
                    Nuevo Video
                </button>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Videos</li>
                    <li class="breadcrumb-item active">Listado</li>
                </ol>
            </div>

        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Listado</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tablaDatatable">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Nuevo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formulario-nuevo">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">


                                    <div class="form-group">
                                        <label class="control-label">Tipo de Video</label>
                                        <select class="form-control" id="select-tipo">
                                            <option value="1">Youtube</option>
                                            <option value="2">Tik Tok</option>
                                            <option value="3">Youtube Short</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text"  class="form-control" id="url-nuevo" autocomplete="off">
                                    </div>


                                    <div class="form-group">
                                        <label>Título</label>
                                        <input type="text" maxlength="300" class="form-control" id="titulo-nuevo" autocomplete="off">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="nuevo()">Guardar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- modal editar -->
    <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Propiedad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formulario-editar">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <input type="hidden" id="id-editar">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Ubicación</label>
                                        <select class="form-control" id="select-tipo-editar">
                                            <option value="1">Youtube</option>
                                            <option value="2">Tik Tok</option>
                                            <option value="3">Youtube Short</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>URL</label>
                                        <input type="text"  class="form-control" id="url-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Título</label>
                                        <input type="text" maxlength="300" class="form-control" id="titulo-editar" autocomplete="off">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="editar()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>


</div>


@extends('backend.menus.footerjs')
@section('archivos-js')

    <script src="{{ asset('js/jquery-ui-drag.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-drag.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            var idpropiedad = {{ $idpropiedad }};
            var ruta = "{{ URL::to('/admin/porpiedadvideo/tabla') }}/" + idpropiedad;
            $('#tablaDatatable').load(ruta);

            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>

        // recarga tabla
        function recargar(){
            var idpropiedad = {{ $idpropiedad }};
            var ruta = "{{ URL::to('/admin/porpiedadvideo/tabla') }}/" + idpropiedad;
            $('#tablaDatatable').load(ruta);
        }

        function modalAgregar(){
            document.getElementById("formulario-nuevo").reset();
            $('#modalAgregar').modal('show');
        }

        function nuevo(){
            var tipo = document.getElementById('select-tipo').value;
            var url = document.getElementById('url-nuevo').value;
            var titulo = document.getElementById('titulo-nuevo').value;

            let idpropiedad = {{ $idpropiedad }};

            if(url === ''){
                toastr.error('URL es requerido');
                return;
            }

            openLoading();
            let formData = new FormData();
            formData.append('tipo', tipo);
            formData.append('urlvideo', url);
            formData.append('titulo', titulo);
            formData.append('idpropiedad', idpropiedad);

            axios.post('/admin/porpiedadvideo/registrar', formData, {
            })
                .then((response) => {
                    closeLoading();

                    if(response.data.success === 1){
                        toastr.success('Registrado correctamente');
                        $('#modalAgregar').modal('hide');
                        recargar();
                    }
                    else {
                        toastr.error('Error al registrar');
                    }
                })
                .catch((error) => {
                    toastr.error('Error al registrar');
                    closeLoading();
                });
        }



        function informacionEditar(id){
            openLoading();
            document.getElementById("formulario-editar").reset();

            axios.post('/admin/porpiedadvideo/informacion',{
                'id': id
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){
                        $('#modalEditar').modal('show');
                        $('#id-editar').val(id);

                        $('#url-editar').val(response.data.info.url_video);
                        $('#titulo-editar').val(response.data.info.titulo);

                        var select = document.getElementById("select-tipo-editar");

                        if(response.data.info.tipo == 1){
                            select.selectedIndex = 0;
                        }else if(response.data.info.tipo == 2){
                            select.selectedIndex = 1;
                        }
                        else{
                            select.selectedIndex = 2;
                        }

                    }else{
                        toastr.error('Información no encontrada');
                    }
                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('Información no encontrada');
                });
        }


        function editar(){
            var tipo = document.getElementById('select-tipo-editar').value;
            var id = document.getElementById('id-editar').value;
            var url = document.getElementById('url-editar').value;
            var titulo = document.getElementById('titulo-editar').value;

            if(url === ''){
                toastr.error('URL es requerido');
                return;
            }

            openLoading();
            let formData = new FormData();
            formData.append('id', id);
            formData.append('urlvideo', url);
            formData.append('titulo', titulo);
            formData.append('tipo', tipo);

            axios.post('/admin/porpiedadvideo/actualizar', formData, {
            })
                .then((response) => {
                    closeLoading();

                    if(response.data.success === 1){
                        toastr.success('Actualizado correctamente');
                        $('#modalEditar').modal('hide');
                        recargar();
                    }
                    else {
                        toastr.error('Error al actualizar');
                    }
                })
                .catch((error) => {
                    toastr.error('Error al actualizar');
                    closeLoading();
                });
        }


        function modalBorrar(idfila){
            Swal.fire({
                title: 'Borrar?',
                text: "",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    solicitarBorrar(idfila);
                }
            })
        }

        function solicitarBorrar(idfila){

            openLoading();

            axios.post('/admin/porpiedadvideo/borrar',{
                'id': idfila
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){

                        toastr.success('Fila Borrada');
                        recargar();
                    }else{
                        toastr.error('Error al borrar');
                    }
                })
                .catch((error) => {
                    toastr.error('Error al borrar');
                    closeLoading();
                });
        }


    </script>


@endsection

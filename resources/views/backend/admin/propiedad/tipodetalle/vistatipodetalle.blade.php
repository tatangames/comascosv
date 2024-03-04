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
                    Nueva Etiqueta
                </button>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Detalle Etiquetas</li>
                    <li class="breadcrumb-item active">Listado</li>
                </ol>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label">Tipo de Etiqueta</label>
            <select class="form-control" id="select-etiqueta" style="width: 20%" onchange="recargar()">
                @foreach($arrayTipoDetalle as $item)
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
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
                    <h4 class="modal-title">Nueva Etiqueta</h4>
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
                                        <label>Título</label>
                                        <input type="text" maxlength="100" class="form-control" id="titulo-nuevo" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input type="text" maxlength="200" class="form-control" id="descripcion-nuevo" autocomplete="off">
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

            var idpropiedad = {{ $idpropi }};

            // primera vez, cargara con id tipo
            let tipo = 1;
            var ruta = "{{ URL::to('/admin/propiedaddetalle/etiqueta/tabla') }}/" + idpropiedad + "/" + tipo;
            $('#tablaDatatable').load(ruta);

            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>

        // recarga tabla
        function recargar(){
            var idpropiedad = {{ $idpropi }};
            var etiqueta = document.getElementById('select-etiqueta').value;
            var ruta = "{{ URL::to('/admin/propiedaddetalle/etiqueta/tabla') }}/" + idpropiedad + "/" + etiqueta;

            $('#tablaDatatable').load(ruta);
        }

        function modalAgregar(){
            document.getElementById("formulario-nuevo").reset();

            var etiqueta = document.getElementById('select-etiqueta').value;
            var descripcion = document.getElementById('descripcion-nuevo');

            if(etiqueta == '1'){
                descripcion.disabled = false;
            }else{
                descripcion.disabled = true;
            }

            $('#modalAgregar').modal('show');
        }

        function nuevo(){
            var etiqueta = document.getElementById('select-etiqueta').value;
            var titulo = document.getElementById('titulo-nuevo').value;
            var descripcion = document.getElementById('descripcion-nuevo').value;


            let idpropiedad = {{ $idpropi }};

            openLoading();
            let formData = new FormData();
            formData.append('etiqueta', etiqueta);
            formData.append('idpropiedad', idpropiedad);
            formData.append('titulo', titulo);
            formData.append('descripcion', descripcion);

            axios.post('/admin/propiedaddetalle/registrar', formData, {
            })
                .then((response) => {
                    closeLoading();

                    if(response.data.success === 1){
                        toastr.success('Registrado correctamente');

                        document.getElementById('titulo-nuevo').value = '';
                        document.getElementById('descripcion-nuevo').value = '';

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

            axios.post('/admin/propiedaddetalle/borrar',{
                'id': idfila
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){

                        toastr.success('Etiqueta Borrada');
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

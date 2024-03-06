@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" type="text/css" rel="stylesheet">
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
                    Nueva Propiedad
                </button>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Propiedad Inicio</li>
                    <li class="breadcrumb-item active">Listado</li>
                </ol>
            </div>

        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Listado de Propiedad en Inicio</h3>
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
                    <h4 class="modal-title">Registro</h4>
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
                                        <label class="control-label">Nombre de Propiedad</label>
                                        <select class="form-control" id="select-propiedad" onchange="buscarFoto(this)">
                                            <option value="0">Seleccionar Opción</option>
                                            @foreach($arrayPropiedad as $item)
                                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <p id="textofoto"><strong>Imagen Vendedor</strong></p>
                                    <div class="list-group mail-list m-t-20" align="center">
                                        <img id="foto-ficha" class="thumb" alt="" width="120px" height="120px" style="border: 2px solid black;">
                                    </div>

                                    <br>
                                    <hr>

                                    <div class="form-group">
                                        <label>Fecha Inicia</label>
                                        <input type="text" disabled class="form-control" id="fechainicia" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Fecha Finaliza</label>
                                        <input type="text" disabled class="form-control" id="fechafin" autocomplete="off">
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
    <script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            var ruta = "{{ URL::to('/admin/propiedadinicio/tabla') }}";
            $('#tablaDatatable').load(ruta);

            $('#select-propiedad').select2({
                theme: "bootstrap-5",
                "language": {
                    "noResults": function(){
                        return "Búsqueda no encontrada";
                    }
                },
            });

            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>

        // recarga tabla
        function recargar(){
            var ruta = "{{ URL::to('/admin/propiedadinicio/tabla') }}";
            $('#tablaDatatable').load(ruta);
        }

        function buscarFoto(e){

            let idpropiedad = $(e).val();

            if(idpropiedad == '0'){
                $('#fechainicia').val('');
                $('#fechafin').val('');
                return;
            }

            openLoading();

            axios.post('/admin/propiedad/informacionextra',{
                'id': idpropiedad
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){
                        let imagen = response.data.imagen;

                        $('#foto-ficha').prop("src","{{ url('storage/archivos') }}"+'/'+ imagen);
                        let nombreVendedor = response.data.vendedor;
                        document.getElementById('textofoto').innerHTML = "Vendedor: " + nombreVendedor;

                        $('#fechainicia').val(response.data.fechainicio);
                        $('#fechafin').val(response.data.fechafin);

                    }else{
                        toastr.error('Información no encontrada');
                    }
                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('Información no encontrada');
                });
        }


        // abre modal para agregar nuevo pais
        function modalAgregar(){
            document.getElementById("formulario-nuevo").reset();
            $('#modalAgregar').modal('show');
        }



        function nuevo(){
            var idpropiedad = document.getElementById('select-propiedad').value;

            if(idpropiedad == '0'){
                toastr.error('Seleccionar Propiedad')
                return;
            }

            openLoading();
            let formData = new FormData();
            formData.append('idpropiedad', idpropiedad);

            axios.post('/admin/propiedadinicio/registrar', formData, {
            })
                .then((response) => {
                    closeLoading();

                    if(response.data.success === 1) {
                        toastr.error('Propiedad ya registrada');
                    }else if(response.data.success === 2){
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

            axios.post('/admin/propiedadinicio/borrar',{
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

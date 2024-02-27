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
                    Nueva Propiedad
                </button>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">Vendedores</li>
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
                    <h4 class="modal-title">Nuevo Vendedor</h4>
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
                                        <label class="control-label">Agente Vendedor</label>
                                        <select class="form-control" id="select-vendedor" onchange="buscarFoto(this)">
                                            <option value="0">Seleccionar Opción</option>
                                            @foreach($arrayVendedor as $item)
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
                                        <label>Nombre Propiedad</label>
                                        <input type="text" maxlength="100" class="form-control" id="nombre-nuevo" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Dirección (Opcional)</label>
                                        <input type="text" maxlength="25" class="form-control" id="direccion-nuevo" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Precio (Opcional)</label>
                                        <input type="text" class="form-control" id="precio-nuevo" autocomplete="off">
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="form-group" style="width: 25%">
                                        <label>Fecha Inicio</label>
                                        <input type="date" class="form-control" id="fechainicio-nuevo" autocomplete="off">
                                    </div>

                                    <div class="form-group" style="width: 25%">
                                        <label>Fecha Fin</label>
                                        <input type="date" class="form-control" id="fechafin-nuevo" autocomplete="off">
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
                    <h4 class="modal-title">Editar Vendedor</h4>
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
                                        <label>Nombre</label>
                                        <input type="text" maxlength="50" class="form-control" id="nombre-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Teléfono (Opcional)</label>
                                        <input type="text" maxlength="25" class="form-control" id="telefono-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Correo (Opcional)</label>
                                        <input type="text" maxlength="100" class="form-control" id="correo-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Canal Youtube (Opcional)</label>
                                        <input type="text" maxlength="100" class="form-control" id="urlyoutube-editar" autocomplete="off">
                                    </div>


                                    <div class="form-group">
                                        <div>
                                            <label>Imagen Vendedor</label>
                                            <p>Recomendación no superar: 800 x 800 px</p>
                                        </div>
                                        <br>
                                        <div class="col-md-10">
                                            <input type="file" style="color:#191818" id="imagen-editar" accept="image/jpeg, image/jpg, image/png"/>
                                        </div>
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

    <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            var ruta = "{{ URL::to('/admin/propiedad/tabla') }}";
            $('#tablaDatatable').load(ruta);

            document.getElementById("divcontenedor").style.display = "block";
        });
    </script>

    <script>

        // recarga tabla
        function recargar(){
            var ruta = "{{ URL::to('/admin/propiedad/tabla') }}";
            $('#tablaDatatable').load(ruta);
        }

        function buscarFoto(e){

            let idvendedor = $(e).val();

            if(idvendedor == '0'){
                document.getElementById('textofoto').innerHTML = "FOTOGRAFIA";
                return;
            }

            openLoading();
            document.getElementById("formulario-editar").reset();

            axios.post('/admin/propiedad/infovendedor',{
                'id': idvendedor
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){
                       let imagen = response.data.imagen;

                        $('#foto-ficha').prop("src","{{ url('storage/archivos') }}"+'/'+ imagen);

                        document.getElementById('textofoto').innerHTML = "FOTOGRAFIA";
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

        // envia datos de nuevo pais al servidor
        function nuevo(){
            var idvendedor = document.getElementById('select-vendedor').value;
            var nombre = document.getElementById('nombre-nuevo').value;
            var direccion = document.getElementById('direccion-nuevo').value;
            var precio = document.getElementById('precio-nuevo').value;
            var fechainicio = document.getElementById('fechainicio-nuevo').value;
            var fechafin = document.getElementById('fechafin-nuevo').value;

            if(idvendedor == '0'){
                toastr.error('Seleccionar Vendedor')
                return;
            }

            // direccion es null

            var reglaNumeroDosDecimal = /^([0-9]+\.?[0-9]{0,2})$/;

            if(precio.length > 0){
                if(!precio.match(reglaNumeroDosDecimal)) {
                    toastr.error('Precio debe ser Decimal Positivo. Solo se permite 2 Decimales');
                    return;
                }

                if(precio < 0){
                    toastr.error('Precio no debe ser negativo'); // puede ser cero
                    return;
                }

                if(precio > 9000000){
                    toastr.error('Precio debe tener máximo 9 millón');
                    return;
                }
            }



            var finicio = new Date(fechainicio);
            var ffin = new Date(fechafin);

            if(finicio > ffin){
                toastr.error('Fecha Inicio no puede ser Mayor');
                return;
            }

            openLoading();
            let formData = new FormData();
            formData.append('idvendedor', idvendedor);
            formData.append('nombre', nombre);
            formData.append('direccion', direccion);
            formData.append('precio', precio);
            formData.append('fechainicio', fechainicio);
            formData.append('fechafin', fechafin);

            axios.post('/admin/propiedad/registrar', formData, {
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

        // informacion de un pais
        function informacionEditar(id){
            openLoading();
            document.getElementById("formulario-editar").reset();

            axios.post('/admin/vendedores/informacion',{
                'id': id
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){
                        $('#modalEditar').modal('show');
                        $('#id-editar').val(id);
                        $('#nombre-editar').val(response.data.info.nombre);
                        $('#telefono-editar').val(response.data.info.telefono);
                        $('#correo-editar').val(response.data.info.correo);
                        $('#urlyoutube-editar').val(response.data.info.url_youtube);
                    }else{
                        toastr.error('Información no encontrada');
                    }
                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('Información no encontrada');
                });
        }


        // editar datos de un pais
        function editar(){
            var id = document.getElementById('id-editar').value;
            var nombre = document.getElementById('nombre-editar').value;
            var telefono = document.getElementById('telefono-editar').value;
            var correo = document.getElementById('correo-editar').value;
            var urlyoutube = document.getElementById('urlyoutube-editar').value;
            var imagen = document.getElementById('imagen-editar');

            if(nombre === ''){
                toastr.error('Nombre es requerido');
                return;
            }

            if(imagen.files && imagen.files[0]){ // si trae imagen
                if (!imagen.files[0].type.match('image/jpeg|image/jpeg|image/png')){
                    toastr.error('Formato de imagen permitido: .png .jpg .jpeg');
                    return;
                }
            }

            openLoading();
            let formData = new FormData();
            formData.append('id', id);
            formData.append('nombre', nombre);
            formData.append('telefono', telefono);
            formData.append('correo', correo);
            formData.append('urlyoutube', urlyoutube);
            formData.append('imagen', imagen.files[0]);

            axios.post('/admin/vendedores/actualizar', formData, {
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



    </script>


@endsection

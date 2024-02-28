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
                                        <label class="control-label">Ubicación</label>
                                        <select class="form-control" id="select-lugar">
                                            @foreach($arrayLugar as $item)
                                                <option value="{{$item->id}}">{{$item->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Nombre Propiedad</label>
                                        <input type="text" maxlength="100" class="form-control" id="nombre-nuevo" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Dirección (Opcional)</label>
                                        <input type="text" maxlength="25" class="form-control" id="direccion-nuevo" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Precio</label>
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

                                    <br>
                                    <hr>

                                    <p>Coordenadas (Opcional)</p>

                                    <div class="form-group">
                                        <label>Latitud</label>
                                        <input type="text" maxlength="100" class="form-control" id="latitud-nuevo" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Longitud</label>
                                        <input type="text" maxlength="100" class="form-control" id="longitud-nuevo" autocomplete="off">
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
                                        <label class="control-label">Agente Vendedor</label>
                                        <select class="form-control" id="select-vendedor-editar" onchange="buscarFotoEditar(this)">
                                        </select>
                                    </div>

                                    <p id="textofoto-editar"><strong>Imagen Vendedor</strong></p>
                                    <div class="list-group mail-list m-t-20" align="center">
                                        <img id="foto-ficha-editar" class="thumb" alt="" width="120px" height="120px" style="border: 2px solid black;">
                                    </div>

                                    <br>
                                    <hr>

                                    <div class="form-group">
                                        <label class="control-label">Ubicación</label>
                                        <select class="form-control" id="select-lugar-editar">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Nombre Propiedad</label>
                                        <input type="text" maxlength="100" class="form-control" id="nombre-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Dirección (Opcional)</label>
                                        <input type="text" maxlength="25" class="form-control" id="direccion-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Precio</label>
                                        <input type="text" class="form-control" id="precio-editar" autocomplete="off">
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="form-group" style="width: 25%">
                                        <label>Fecha Inicio</label>
                                        <input type="date" class="form-control" id="fechainicio-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group" style="width: 25%">
                                        <label>Fecha Fin</label>
                                        <input type="date" class="form-control" id="fechafin-editar" autocomplete="off">
                                    </div>

                                    <br>
                                    <hr>

                                    <p>Coordenadas (Opcional)</p>

                                    <div class="form-group">
                                        <label>Latitud</label>
                                        <input type="text" maxlength="100" class="form-control" id="latitud-editar" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Longitud</label>
                                        <input type="text" maxlength="100" class="form-control" id="longitud-editar" autocomplete="off">
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





<div class="modal fade" id="modalOpciones">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Opciones</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario-opciones">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">


                                <div class="form-group">
                                    <input type="hidden" id="id-opciones">
                                </div>

                                <div class="list-group b-0 mail-list" id="configuracion">

                                    <button type="button" onclick="vistaEtiquetas();" class="btn btn-success btn-block waves-effect waves-light">Etiquetas</button>
                                    <button type="button" onclick="modalVineta();" class="btn btn-warning btn-block waves-effect waves-light" style="color: white">Viñeta </button>
                                    <button type="button" onclick="preguntaLiberarSala()" class="btn btn-danger btn-block waves-effect waves-light">Liberar sala</button>
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








<div class="modal fade" id="modalVineta">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Viñetas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario-vineta">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <input type="hidden" id="id-vineta">
                                </div>

                                <div class="form-group">
                                    <label>Viñeta derecha</label>
                                    <input type="text" maxlength="50" class="form-control" id="vineta-derecha" autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <label>Viñeta izquierda</label>
                                    <input type="text" maxlength="50" class="form-control" id="vineta-izquierda" autocomplete="off">
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="actualizarVineta()">Actualizar</button>
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

        function buscarFotoEditar(e){
            let idvendedor = $(e).val();

            if(idvendedor == '0'){
                document.getElementById('textofoto-editar').innerHTML = "FOTOGRAFIA";
                return;
            }

            openLoading();

            axios.post('/admin/propiedad/infovendedor',{
                'id': idvendedor
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){
                        let imagen = response.data.imagen;

                        $('#foto-ficha-editar').prop("src","{{ url('storage/archivos') }}"+'/'+ imagen);

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



        function nuevo(){
            var idvendedor = document.getElementById('select-vendedor').value;
            var nombre = document.getElementById('nombre-nuevo').value;
            var direccion = document.getElementById('direccion-nuevo').value;
            var precio = document.getElementById('precio-nuevo').value;
            var fechainicio = document.getElementById('fechainicio-nuevo').value;
            var fechafin = document.getElementById('fechafin-nuevo').value;
            var latitud = document.getElementById('latitud-nuevo').value;
            var longitud = document.getElementById('longitud-nuevo').value;
            var idlugar = document.getElementById('select-lugar').value;

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

            if(latitud.length > 0){
                if(longitud === ''){
                    toastr.error("Longitud es requerido");
                }
            }

            if(longitud.length > 0){
                if(latitud === ''){
                    toastr.error("Latitud es requerido");
                }
            }


            openLoading();
            let formData = new FormData();
            formData.append('idvendedor', idvendedor);
            formData.append('nombre', nombre);
            formData.append('direccion', direccion);
            formData.append('precio', precio);
            formData.append('fechainicio', fechainicio);
            formData.append('fechafin', fechafin);
            formData.append('latitud', latitud);
            formData.append('longitud', longitud);
            formData.append('idlugar', idlugar);

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


        function informacionEditar(id){
            openLoading();
            document.getElementById("formulario-editar").reset();

            axios.post('/admin/propiedad/informacion',{
                'id': id
            })
                .then((response) => {
                    closeLoading();
                    if(response.data.success === 1){
                        $('#modalEditar').modal('show');
                        $('#id-editar').val(id);

                        // listado de vendedores
                        document.getElementById("select-vendedor-editar").options.length = 0;
                        document.getElementById("select-lugar-editar").options.length = 0;

                        let imagen = response.data.imagen;
                        $('#foto-ficha-editar').prop("src","{{ url('storage/archivos') }}"+'/'+ imagen);


                        $.each(response.data.listado, function( key, val ){
                            if(response.data.info.id_vendedor == val.id){
                                $('#select-vendedor-editar').append('<option value="' +val.id +'" selected="selected">'+val.nombre+'</option>');
                            }else{
                                $('#select-vendedor-editar').append('<option value="' +val.id +'">'+val.nombre+'</option>');
                            }
                        });


                        $.each(response.data.listadoubi, function( key, val ){

                            if(response.data.info.id_lugar == val.id){
                                $('#select-lugar-editar').append('<option value="' +val.id +'" selected="selected">'+val.nombre+'</option>');
                            }else{
                                $('#select-lugar-editar').append('<option value="' +val.id +'">'+val.nombre+'</option>');
                            }
                        });


                        $('#nombre-editar').val(response.data.info.nombre);
                        $('#direccion-editar').val(response.data.info.direccion);
                        $('#precio-editar').val(response.data.info.precio);
                        $('#fechainicio-editar').val(response.data.info.fecha_inicio);
                        $('#fechafin-editar').val(response.data.info.fecha_fin);
                        $('#latitud-editar').val(response.data.info.latitud);
                        $('#longitud-editar').val(response.data.info.longitud);

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
            var id = document.getElementById('id-editar').value;
            var idvendedor = document.getElementById('select-vendedor-editar').value;
            var nombre = document.getElementById('nombre-editar').value;
            var direccion = document.getElementById('direccion-editar').value;
            var precio = document.getElementById('precio-editar').value;
            var fechainicio = document.getElementById('fechainicio-editar').value;
            var fechafin = document.getElementById('fechafin-editar').value;
            var latitud = document.getElementById('latitud-editar').value;
            var longitud = document.getElementById('longitud-editar').value;
            var idlugar = document.getElementById('select-lugar-editar').value;

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

            if(latitud.length > 0){
                if(longitud === ''){
                    toastr.error("Longitud es requerido");
                }
            }

            if(longitud.length > 0){
                if(latitud === ''){
                    toastr.error("Latitud es requerido");
                }
            }

            openLoading();
            let formData = new FormData();
            formData.append('id', id);
            formData.append('idvendedor', idvendedor);
            formData.append('nombre', nombre);
            formData.append('direccion', direccion);
            formData.append('precio', precio);
            formData.append('fechainicio', fechainicio);
            formData.append('fechafin', fechafin);
            formData.append('latitud', latitud);
            formData.append('longitud', longitud);
            formData.append('idlugar', idlugar);

            axios.post('/admin/propiedad/actualizar', formData, {
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


        function modalOpciones(id){

            $('#id-opciones').val(id);
            $('#modalOpciones').modal('show');
        }

        function vistaEtiquetas(){
            var id = document.getElementById('id-opciones').value;
            window.location.href="{{ url('/admin/propiedad/etiqueta/index') }}/" + id;
        }

        function modalVineta(){
            document.getElementById("formulario-vineta").reset();

            var id = document.getElementById('id-opciones').value;
            openLoading();
            let formData = new FormData();
            formData.append('id', id);

            axios.post('/admin/propiedad/informacion', formData, {
            })
                .then((response) => {
                    closeLoading();

                    if(response.data.success === 1){

                        let derecha = response.data.info.vineta_derecha;
                        let izquierda = response.data.info.vineta_izquierda;

                        $('#vineta-derecha').val(derecha);
                        $('#vineta-izquierda').val(izquierda);

                        $('#id-vineta').val(id);
                        $('#modalVineta').modal('show');
                    }
                    else {
                        toastr.error('Error al buscar');
                    }
                })
                .catch((error) => {
                    toastr.error('Error al buscar');
                    closeLoading();
                });
        }

        function actualizarVineta(){

            var id = document.getElementById('id-vineta').value;
            var vinetaDerecha = document.getElementById('vineta-derecha').value;
            var vinetaIzquierda = document.getElementById('vineta-izquierda').value;


            // pueden ser null


            openLoading();
            let formData = new FormData();
            formData.append('id', id);
            formData.append('derecha', vinetaDerecha);
            formData.append('izquierda', vinetaIzquierda);

            axios.post('/admin/propiedad/vineta/actualizar', formData, {
            })
                .then((response) => {
                    closeLoading();

                    if(response.data.success === 1){
                        toastr.success('Actualizado correctamente');
                        $('#modalVineta').modal('hide');
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

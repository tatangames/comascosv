<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="tabla" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th style="width: 5%">Vendedor</th>
                                <th style="width: 5%">Fecha Registro</th>
                                <th style="width: 5%">Nombre</th>
                                <th style="width: 5%">Dirección</th>
                                <th style="width: 5%">Precio</th>
                                <th style="width: 5%">Fecha Visible</th>
                                <th style="width: 5%">Activo</th>
                                <th style="width: 4%">Opciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($listado as $dato)
                                <tr>
                                    <td style="width: 5%">{{ $dato->nombreVendedor }}</td>
                                    <td style="width: 8%">{{ $dato->fechaFormat }}</td>
                                    <td style="width: 8%">{{ $dato->nombre }}</td>
                                    <td style="width: 8%">{{ $dato->direccion }}</td>
                                    <td style="width: 8%">{{ $dato->precioFormat }}</td>
                                    <td style="width: 8%">{{ $dato->fechaVisible }}</td>
                                    <td>
                                        @if($dato->visible == 1)
                                            <span class="badge bg-success">Si</span>
                                        @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>

                                    <td style="width: 4%">
                                        <button type="button" class="btn btn-success btn-xs" onclick="informacionEditar({{ $dato->id }})">
                                            <i class="fas fa-eye" title="Editar"></i>&nbsp; Editar
                                        </button>

                                        <button type="button" style="margin: 5px" class="btn btn-info btn-xs" onclick="modalOpciones({{ $dato->id }})">
                                            <i class="fas fa-book" title="Opciones"></i>&nbsp; Opciones
                                        </button>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    $(function () {
        $("#tabla").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, 100, 150, -1], [10, 25, 50, 100, 150, "Todo"]],
            "language": {

                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix": "",
                "sSearch": "Buscar:",
                "sUrl": "",
                "sInfoThousands": ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }

            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
        });
    });


</script>

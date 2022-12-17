@extends('layout.base')

@section('page-info')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

<!-- mostramos el mensaje despues de hacer un cambio en los resgistros-->
<script src="{{ asset('mensaje.js') }}"> </script>


@endsection


@section('container')
<br>
<div class="row">
    <div class="col col-12">
        <h5>Listado de Ventas</h5>
        @if (session()->has('respuesta')) {{-- comprueba si existe el valor en sesión --}}
        <script>
            mensaje("{{session('respuesta')}}");
        </script>

        {!! session()->forget('respuesta') !!} {{-- borrar el error de sesión --}}
        @endif
    </div>
</div>
<div  >
    <div class="row">
        
        <div class="d-flex justify-content-end mb-2" data-kt-docs-table-toolbar="base">
            <a href="{{url('venta/create')}}" class="btn btn-primary">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"></path>
                    </svg>
                </span>
                Crear
            </a>
        </div>
        
        <div class=" col col-sm-4 col-lg-4  "> 
        <select class="form-select" aria-label="Default select example" name="selectestado" id="selectestado">
            <option selected disabled>Filtrar por Estado</option>
            <option value="PEDIDO">PEDIDO</option>
            <option value="PAGADO">PAGADO</option>
            <option value="ENTREGADO">ENTREGADO</option>
        </select>
        </div>
        <br><br><br>

        <div class="table-responsive">
            <div class="d-flex flex-stack">
                <div class="d-flex btn-excel-datatable"></div>
                <div class="d-flex justify-content-end">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
                            </svg>
                        </span>
                        <input type="text" id="buscador" class="form-control form-control-solid w-250px ps-15" autocomplete="off" placeholder="Buscar en el listado" />
                    </div>

                </div>
            </div>
            <table id="listado" data-page-length='5' class="table table-row-bordered table-row-success table-rounded border gs-7 align-middle" style="width: 92,5vw;">
                <thead>
                    <tr class=" text-primary fw-bold fs-6" id="fila">
                        <th class="w-80px">Id</th>
                        <th class="w-80px">Fecha</th>
                        <th class="w-80px">Nombre Cliente</th>
                        <th class="w-80px">Apellido Cliente</th>
                        <th class="w-80px">Tipo Documento</th>
                        <th class="w-80px">Nro Documento</th>
                        <th class="w-80px">Descripcion</th>
                        <th class="w-80px">Costo Venta</th>
                        <th class="w-80px">Estado Venta</th>
                        <th class="w-80px">Usuario</th>

                        <th class="w-80px">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>

        <div class="modal fade modal-lg" id="mimodal" tabindex="-1" aria-labelledby="mimodal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="mimodalLabel">Ver Venta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-4 col-lg-4 mb-5">
                                    <label for="fecha" class="col-form-label">Fecha:</label>
                                    <input type="text" class="form-control " id="verFecha" readonly>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-5">
                                    <label for="descripcion" class="col-form-label">Descripcion:</label>
                                    <input type="text" class="form-control" id="verDescripcion" readonly>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-5">
                                    <label for="costoventa" class="col-form-label">Costo Venta:</label>
                                    <input type="text" class="form-control" id="verCostoventa" readonly>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-5">
                                    <label for="estadoventa" class="col-form-label">Estado Venta:</label>
                                    <input type="text" class="form-control" id="verEstadoventa" readonly>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-5">
                                    <label for="cliente" class="col-form-label">Cliente:</label>
                                    <input type="text" class="form-control" id="verCliente" readonly>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-5">
                                    <label for="documento" class="col-form-label">Documento :</label>
                                    <input type="text" class="form-control" id="verDocumento" readonly>
                                </div>
                                <div class="col-sm-4 col-lg-4 mb-5">
                                    <label for="usuario" class="col-form-label">Usuario:</label>
                                    <input type="text" class="form-control" id="verUsuario" readonly>
                                </div>

                            </div>
                        </form>
                        <div class="table-responsive">
                            <table class="table table-row-bordered gy-5 gs-5" id="detallesventa">
                                <thead class="fw-bold text-primary">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Descuento</th>
                                        <th>Precio Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="generarboleta">Generar Boleta</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div>
        <section>

            <div id="pagination"></div>
        </section>
    </div>
    <br>
    <br>
</div>
@endsection


@section('script')
@include('helpers.data-managment')

<script>
    idventa = 0;
    const mimodal = document.getElementById('mimodal')
    mimodal.addEventListener('show.bs.modal', event => {

        const button = event.relatedTarget
        const id = button.getAttribute('data-id')
        var urlventa = "{{ url('venta/show') }}";
        $.get(urlventa + '/' + id, function(data) {
            //console.log(data);
            const modalTitle = mimodal.querySelector('.modal-title')
            modalTitle.textContent = `Ver Registro ${id}`;
            idventa = id;
            document.getElementById("verFecha").value = data[0].fecha;
            document.getElementById("verCostoventa").value = data[0].costoventa;
            document.getElementById("verDescripcion").value = data[0].descripcion;
            document.getElementById("verEstadoventa").value = data[0].estadoventa;
            document.getElementById("verCliente").value = data[0].nombres + ' ' + data[0].apellidos;

            document.getElementById("verDocumento").value = data[0].tipodocumento + ': ' + data[0].numerodocumento;
            document.getElementById("verUsuario").value = data[0].usuario;

            var tabla = document.getElementById(detallesventa);
            $('#detallesventa tbody tr').slice().remove();
            for (var i = 0; i < data.length; i++) {
                filaDetalle = '<tr id="fila' + i +
                    '"><td><input  type="hidden" name="Linventario[]" value="' + data[i].producto + '"required>' + data[i].producto +

                    '</td><td><input  type="hidden" name="Lcantidad[]" value="' + data[i].cantidad + '"required>' + data[i].cantidad +
                    '</td><td><input  type="hidden" name="Lpreciounidad[]" value="' + data[i].preciounidad + '"required>' + data[i].preciounidad +
                    '</td><td><input  type="hidden" name="Ldescuento[]" value="' + data[i].descuento + '"required>' + data[i].descuento +
                    '</td><td><input  type="hidden" name="Lpreciototal[]" value="' + data[i].preciototal + '"required>' + data[i].preciototal +
                    '</td></tr>';

                $("#detallesventa>tbody").append(filaDetalle);
            }

        });

    })


    var ventas = @json($ventas);
    var urlventas = "{{ url('venta') }}";


    var table = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], 'ventas', function() {}, true, true, false);

    $('#buscador').keyup(function(e) {
        table.search(e.target.value).draw();
    });
    var viewbtn = true;
    var editbtn = true;
    var deletetn = true;

    @php
    $rol = Auth::user()->rol_id;
    @endphp

    @if($rol != 1)
    deletetn = false;
    @endif
    listarOnTable(table, ventas, 0, [], viewbtn, editbtn, deletetn, urlventas, false, []);

    $('#generarboleta').click(function() {

        window.open( '/generarboletaventa/' + idventa );

    });

    $("select[name=selectestado]").change(function(e){
        table.search(e.target.value).draw();
        });
</script>


@endsection
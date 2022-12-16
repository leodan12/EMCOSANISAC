@extends('layout.base')

@section('container')

<div class="card">
    <div class="card-body">
        <div class="p-3">
            <h1 class="anchor fw-bolder">
                Editar Compra
            </h1>
        </div>
        <div class="p-4">
            <div class="rounded border p-10">
                <Form method="POST" action="{{ url('compra/update',$compra->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="fecha" class="required form-label">Fecha</label>
                            <input type="text" placeholder=" ingrese fecha" name="fecha" id="fecha" class="form-control" required value="{{$compra->fecha}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="decripcion" class="required form-label">Descripcion</label>
                            <input type="text" placeholder=" ingrese descripcion" name="descripcion" id="descripcion" class="form-control" required value="{{$compra->descripcion}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="descripcion" class="required form-label">Proveedor </label>
                            <select class="required form-select" name="proveedor_id" id="proveedor_id" readonly>
                                <option selected disabled>Seleccione una Proveedor</option>
                                @foreach($proveedores as $item)
                                <option value="{{$item->id}}" {{$item->id==$compra->proveedor_id ? 'selected':''}}>{{$item->proveedor}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="costocompra" class="required form-label">Costo Compra</label>
                            <input type="number" step=0.1 placeholder=" Ingrese Costo" name="costocompra" id="costocompra" class="form-control" required value="{{$compra->costocompra}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="costocompra" class="required form-label">Estado Compra</label>
                            <select class="required form-select" name="estadocompra" id="estadocompra" readonly>
                                <option selected disabled>Seleccione un Estado</option>
                                <option value="PEDIDO" {{$compra->estadocompra=='PEDIDO' ? 'selected':''}}>PEDIDO</option>
                                <option value="PAGADO" {{$compra->estadocompra=='PAGADO' ? 'selected':''}}>PAGADO</option>
                                <option value="RECIBIDO" {{$compra->estadocompra=='RECIBIDO' ? 'selected':''}}>RECIBIDO</option>

                            </select>
                        </div>
                        <h5>Agregar Detalle Compra</h5>

                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="inventario" class="form-label" required>Producto</label>
                            <select class="required form-select" name="inventario" id="inventario">
                                <option selected disabled>Seleccione un producto</option>
                                @foreach($productos as $item)
                                <option value="{{$item->idinventario}}">{{$item->producto}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="unidadMedida" class="form-label" required>Unidad de Medida</label>
                            <input type="text" placeholder=" Ingrese Unidad de Medida" name="unidadMedida" id="unidadMedida" class="form-control">
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="cantidad" class="form-label" required>Cantidad</label>
                            <input type="number" placeholder=" Ingrese Cantidad" name="cantidad" id="cantidad" class="form-control">
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="precioUnidad" class="form-label" required>Precio Unitario</label>
                            <input type="number" step=0.1 placeholder=" Ingrese Precio Unidad" name="precioUnidad" id="precioUnidad" class="form-control">
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="precioTotal" class="form-label" required>Precio Total</label>
                            <input type="number" step=0.1 placeholder=" Ingrese Precio Total" name="precioTotal" id="precioTotal" class="form-control">
                        </div>

                        @php $ind=0 ; @endphp
                        @php $indice=count($detallescompra) ; @endphp
                        <div class="d-flex justify-content-end ">
                            <button type="button" class="btn btn-info" id="addDetalleBatch" onclick="agregarFila('{{$indice}}')"><i class="fa fa-plus"></i> Agregar Detalle</button>
                        </div>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-row-bordered gy-5 gs-5" id="detallesCompra">
                                <thead class="fw-bold text-primary">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Unidad de Medida</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Precio Total</th>


                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detallescompra as $detalle)
                                    @php $ind++; @endphp
                                    <tr id="fila{{$ind}}">
                                        <td> {{$detalle->inventario_id}}</td>
                                        <td> {{$detalle->unidadmedida}}</td>
                                        <td> {{$detalle->cantidad}}</td>
                                        <td> {{$detalle->preciounidad}}</td>
                                        <td> {{$detalle->preciototal}}</td>
                                        <td><button type="button" class="btn btn-link btn-color-danger btn-sm delete" onclick="eliminarFila(  '{{$detalle->iddetallecompra}}','{{$ind}}'  )" data-id="0"><i class="bi bi-trash-fill"></i></button></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary" value="Guardar" id="Guardar"> 
                        <i class="far fa-check-circle"></i>
                        Aceptar
                    </button>
                    <a href="{{url('compra/index')}}" type="button" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i>
                        Cancelar
                    </a>
                </Form>
            </div>

        </div>
    </div>

</div>

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
    var costocompratotal = @json($compra->costocompra);
    var estadocompra = @json($compra->estadocompra);

    //alert(costocompratotal);
    $(document).ready(function() {

        document.getElementById("cantidad").onchange = function() {
            preciototal();
        };
        document.getElementById("precioUnidad").onchange = function() {
            preciototal();
        };

        
    @php
	$rol = Auth::user()->rol_id;
	@endphp

    @if($rol != 1  )
    if (estadocompra == 'RECIBIDO'  ) {
            $("#estadocompra option[value=PAGADO]").remove();
            $("#estadocompra option[value=PEDIDO]").remove();
            //document.getElementById('descripcion').isReadonly = true;
            $("#descripcion").attr("disabled","true");
            $("#costocompra").attr("disabled","true");
            $("#fecha").attr("disabled","true");
            $("#estadocompra").attr("disabled","true");
            $("#proveedor_id").attr("disabled","true");
        }
        if (estadocompra == 'PAGADO') {
            $("#estadocompra option[value=PEDIDO]").remove();
            $("#descripcion").attr("disabled","true");
            $("#costocompra").attr("disabled","true");
            $("#fecha").attr("disabled","true"); 
            $("#proveedor_id").attr("disabled","true");
        }
        var estado = document.getElementById("estadocompra").value;
        const btncompra = document.getElementById('addDetalleBatch');
        if (estado != 'PEDIDO') {
            btncompra.disabled = true;
        } else {
            btncompra.disabled = false;
        }
    @endif


       

        
        $('#Guardar').click(function() {
            
            $("#descripcion").removeAttr("disabled");
            $("#costocompra").removeAttr("disabled");
            $("#fecha").removeAttr("disabled"); 
            $("#estadocompra").removeAttr("disabled");
            $("#proveedor_id").removeAttr("disabled"); 

        });

    });

    //funcion para agregar una fila
    var indice = 0;
    var pv = 0;

    function verboton() {
        var estado = document.getElementById("estadocompra").value;
        if (estado != 'PEDIDO') {

            const btncompra = document.getElementById('addDetalleBatch');
            btncompra.disabled = true;

        }
    }

    function agregarFila(indice1) {


        if (pv == 0) {
            indice = indice1;
            pv++;
            indice++;
        } else {
            indice++;
        }

        //console.log(indice);
        //datos del detalleSensor
        var inventario = $('[name="inventario"]').val();
        var unidadMedida = $('[name="unidadMedida"]').val();
        var cantidad = $('[name="cantidad"]').val();
        var precioUnidad = $('[name="precioUnidad"]').val();
        var precioTotal = $('[name="precioTotal"]').val();


        //alertas para los detallesBatch
        if (!inventario) {
            alert("ingrese un inventario");
            return;
        }
        if (!unidadMedida) {
            alert("ingrese una Unidad Medida");
            return;
        }
        if (!cantidad) {
            alert("ingrese una Cantidad");
            return;
        }
        if (!precioUnidad) {
            alert("ingrese un Precio Unitario");
            return;
        }
        if (!precioTotal) {
            alert("ingrese una Precio Total");
            return;
        }


        var LDCompra = [];
        var tam = LDCompra.length;
        LDCompra.push(inventario, unidadMedida, cantidad, precioUnidad, precioTotal);

        filaDetalle = '<tr id="fila' + indice +
            '"><td><input  type="hidden" name="Linventario[]" value="' + LDCompra[0] + '"required>' + LDCompra[0] +
            '</td><td><input  type="hidden" name="Lunidadmedida[]" value="' + LDCompra[1] + '"required>' + LDCompra[1] +
            '</td><td><input  type="hidden" name="Lcantidad[]" value="' + LDCompra[2] + '"required>' + LDCompra[2] +
            '</td><td><input  type="hidden" name="Lpreciounidad[]" value="' + LDCompra[3] + '"required>' + LDCompra[3] +
            '</td><td><input id="preciot' + indice + '"  type="hidden" name="Lpreciototal[]" value="' + LDCompra[4] + '"required>' + LDCompra[4] +
            '</td><td><button type="button" class="btn btn-link btn-color-danger btn-sm delete" onclick="quitarFila(' + indice + ')" data-id="0"><i class="bi bi-trash-fill"></i></button></td></tr>';

        $("#detallesCompra>tbody").append(filaDetalle);

        indice++;
        //preciototal(); 
        document.getElementById('costocompra').value = costocompratotal;
        document.getElementById("inventario").value = "";
        document.getElementById("unidadMedida").value = "";
        document.getElementById("cantidad").value = "";
        document.getElementById("precioUnidad").value = "";
        document.getElementById("precioTotal").value = "";
    }
    //PARA ELIMINAR UN DATO DE LA TABLA
    function eliminarFila(idBD, ind) {
        Swal.fire({
            title: "¿Seguro que desea eliminar este registro?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Eliminar"
        }).then(function(result) {
            if (result.value) {
                var estado = document.getElementById("estadocompra").value;
                if (estado == 'PEDIDO') {
                    $.get('/deletedetallecompra/' + idBD, function(data) {
                        $('#fila' + ind).remove();
                    });
                    toDelete = true;
                    icon = "success";
                    message = "El registro fue eliminado";
                } else {
                    toDelete = false;
                    icon = "error";
                    message = "El registro no se puede eliminar";
                }

                Swal.fire({
                    text: message,
                    icon: icon
                });

            }
        });
    }

    function quitarFila(ind) {
        Swal.fire({
            title: "¿Seguro que desea eliminar este registro?",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Eliminar"
        }).then(function(result) {
            if (result.value) {
                var resta = 0;
                resta = $('[id="preciot' + ind + '"]').val();
                costocompratotal = costocompratotal - resta;
                $('#fila' + ind).remove();
                indice--;
                document.getElementById('costocompra').value = costocompratotal;
                toDelete = true;
                icon = "success";
                message = "El registro fue eliminado";
                Swal.fire({
                    text: message,
                    icon: icon
                });
            }


        });
    }

    function preciototal() {
        var preciototalI = 0;
        var cantidad = $('[name="cantidad"]').val();
        var precioUnidad = $('[name="precioUnidad"]').val();
        if (cantidad != null) {
            if (precioUnidad != null) {
                preciototalI = cantidad * precioUnidad;
                costocompratotal = costocompratotal + preciototalI;
                document.getElementById('precioTotal').value = preciototalI;
                //alert(costocompratotal);
            }
        }
    }
</script>
@endsection
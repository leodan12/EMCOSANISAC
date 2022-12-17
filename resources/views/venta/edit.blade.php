@extends('layout.base')

@section('container')

<div class="card">
    <div class="card-body">
        <div class="p-3">
            <h1 class="anchor fw-bolder">
                Editar Venta
            </h1>
        </div>
        <div class="p-4">
            <div class="rounded border p-10">
                <Form method="POST" action="{{ url('venta/update',$venta->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="fecha" class="required form-label">Fecha</label>
                            <input type="text" placeholder=" ingrese fecha" name="fecha" id="fecha" class="form-control" required value="{{$venta->fecha}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="decripcion" class="required form-label">Descripcion</label>
                            <input type="text" placeholder=" ingrese descripcion" name="descripcion" id="descripcion" class="form-control" required value="{{$venta->descripcion}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="cliente" class="required form-label">Cliente </label>
                            <select class="required form-select" name="cliente" id="cliente" readonly>
                                <option selected disabled>Seleccione una Proveedor</option>
                                @foreach($clientes as $item)
                                <option value="{{$item->id}}" {{$item->id==$venta->cliente_id ? 'selected':''}}>{{$item->nombres}} {{$item->apellidos}} Doc:{{$item->numerodocumento}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="costoventa" class="required form-label">Costo Venta</label>
                            <input type="number" step=0.1 placeholder=" Ingrese Costo" name="costoventa" id="costoventa" class="form-control" required value="{{$venta->costoventa}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="costoventa" class="required form-label">Estado Venta</label>
                            <select class="required form-select" name="estadoventa" id="estadoventa" readonly>
                                <option selected disabled>Seleccione un Estado</option>
                                <option value="PEDIDO" {{$venta->estadoventa=='PEDIDO' ? 'selected':''}}>PEDIDO</option>
                                <option value="PAGADO" {{$venta->estadoventa=='PAGADO' ? 'selected':''}}>PAGADO</option>
                                <option value="ENTREGADO" {{$venta->estadoventa=='ENTREGADO' ? 'selected':''}}>ENTREGADO</option>

                            </select>
                        </div>
                        <h5>Agregar Detalle venta</h5>

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
                            <label for="cantidad" class="form-label" required>Cantidad</label>
                            <input type="number" placeholder=" Ingrese Cantidad" name="cantidad" id="cantidad" class="form-control">
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="precioUnidad" class="form-label" required>Precio Unitario</label>
                            <input type="number" step=0.1 placeholder=" Ingrese Precio Unidad" name="precioUnidad" id="precioUnidad" class="form-control">
                        </div>

                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="descuento" class="form-label" required>Descuento</label>
                            <input type="text" placeholder=" Ingrese Unidad de Medida" name="descuento" id="descuento" class="form-control">
                        </div>
                        <div class="col-sm-6 col-lg-3 mb-5">
                            <label for="precioTotal" class="form-label" required>Precio Total</label>
                            <input type="number" step=0.1 placeholder=" Ingrese Precio Total" name="precioTotal" id="precioTotal" class="form-control">
                        </div>

                        @php $ind=0 ; @endphp
                        @php $indice=count($detallesventa) ; @endphp
                        <div class="d-flex justify-content-end ">
                            <button type="button" class="btn btn-info" id="addDetalleBatch" onclick="agregarFila('{{$indice}}')"><i class="fa fa-plus"></i> Agregar Detalle</button>
                        </div>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-row-bordered gy-5 gs-5" id="detallesventa">
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
                                    @foreach($detallesventa as $detalle)
                                    @php $ind++; @endphp
                                    <tr id="fila{{$ind}}">
                                        <td> {{$detalle->inventario_id}}</td>
                                        <td> {{$detalle->descuento}}</td>
                                        <td> {{$detalle->cantidad}}</td>
                                        <td> {{$detalle->preciounidad}}</td>
                                        <td> {{$detalle->preciototal}}</td>
                                        <td><button type="button" class="btn btn-link btn-color-danger btn-sm delete" onclick="eliminarFila(  '{{$detalle->iddetalleventa}}','{{$ind}}'  )" data-id="0"><i class="bi bi-trash-fill"></i></button></td>

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
                    <a href="{{url('venta/index')}}" type="button" class="btn btn-light">
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
    var costoventatotal = @json($venta -> costoventa);
    var estadoventa = @json($venta->estadoventa);
    var preciototalI = 0;
    //alert(costoventatotal);
    $(document).ready(function() {

        document.getElementById("cantidad").onchange = function() {
            preciototal();
        };
        document.getElementById("precioUnidad").onchange = function() {
            preciototal();
        };
        document.getElementById("descuento").onchange = function() {
            preciototal();
        };

        @php
	$rol = Auth::user()->rol_id;
	@endphp

    @if($rol != 1  )
    if (estadoventa == 'ENTREGADO'  ) {
            $("#estadoventa option[value=PAGADO]").remove();
            $("#estadoventa option[value=PEDIDO]").remove();
            //document.getElementById('descripcion').isReadonly = true;
            $("#descripcion").attr("disabled","true");
            $("#costoventa").attr("disabled","true");
            $("#fecha").attr("disabled","true");
            $("#estadoventa").attr("disabled","true");
            $("#cliente").attr("disabled","true");
        }
        if (estadoventa == 'PAGADO') {
            $("#estadoventa option[value=PEDIDO]").remove();
            $("#descripcion").attr("disabled","true");
            $("#costoventa").attr("disabled","true");
            $("#fecha").attr("disabled","true"); 
            $("#cliente").attr("disabled","true");
        }
        var estado = document.getElementById("estadoventa").value;
        const btnventa = document.getElementById('addDetalleBatch');
        if (estado != 'PEDIDO') {
            btnventa.disabled = true;
        } else {
            btnventa.disabled = false;
        }
    @endif

   $('#Guardar').click(function() {
            
            $("#descripcion").removeAttr("disabled");
            $("#costoventa").removeAttr("disabled");
            $("#fecha").removeAttr("disabled"); 
            $("#estadoventa").removeAttr("disabled");
            $("#cliente").removeAttr("disabled"); 

        });


    });

    //funcion para agregar una fila
    var indice = 0;
    var pv = 0;

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
        var descuento = $('[name="descuento"]').val();
        var cantidad = $('[name="cantidad"]').val();
        var precioUnidad = $('[name="precioUnidad"]').val();
        var precioTotal = $('[name="precioTotal"]').val();


        //alertas para los detallesBatch
        if (!inventario) {
            alert("ingrese un inventario");
            return;
        }
        if (!descuento) {
            alert("ingrese un Descuento");
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


        var LDventa = [];
        var tam = LDventa.length;
        LDventa.push(inventario, descuento, cantidad, precioUnidad, precioTotal);

        filaDetalle = '<tr id="fila' + indice +
            '"><td><input  type="hidden" name="Linventario[]" value="' + LDventa[0] + '"required>' + LDventa[0] +
            '</td><td><input  type="hidden" name="Ldescuento[]" value="' + LDventa[1] + '"required>' + LDventa[1] +
            '</td><td><input  type="hidden" name="Lcantidad[]" value="' + LDventa[2] + '"required>' + LDventa[2] +
            '</td><td><input  type="hidden" name="Lpreciounidad[]" value="' + LDventa[3] + '"required>' + LDventa[3] +
            '</td><td><input id="preciot' + indice + '" type="hidden" name="Lpreciototal[]" value="' + LDventa[4] + '"required>' + LDventa[4] +
            '</td><td><button type="button" class="btn btn-link btn-color-danger btn-sm delete" onclick="quitarFila(' + indice + ')" data-id="0"><i class="bi bi-trash-fill"></i></button></td></tr>';

        $("#detallesventa>tbody").append(filaDetalle);

        indice++;
        costoventatotal = costoventatotal + preciototalI;
        preciototalI = 0;
        document.getElementById('costoventa').value = costoventatotal;
        document.getElementById("inventario").value = "";
        document.getElementById("descuento").value = "";
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
                var estado = document.getElementById("estadoventa").value;
                if (estado == 'PEDIDO'  ) {
                    $.get('/deletedetalleventa/' + idBD, function(data) {
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
                costoventatotal = costoventatotal - resta;
                $('#fila' + ind).remove();
                indice--;
                document.getElementById('costoventa').value = costoventatotal;
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
        preciototalI = 0;
        var cantidad = $('[name="cantidad"]').val();
        var precioUnidad = $('[name="precioUnidad"]').val();
        var descuento = $('[name="descuento"]').val();
        if (cantidad.length != 0 && precioUnidad.length != 0 && descuento.length != 0) {

            //alert("final");
            preciototalI = (cantidad * precioUnidad) - descuento;
            //costoventatotal = costoventatotal + preciototalI;
            document.getElementById('precioTotal').value = preciototalI;


        }
    }
</script>
@endsection
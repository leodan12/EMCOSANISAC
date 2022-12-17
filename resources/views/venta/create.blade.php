@extends('layout.base')


@section('container')

<div class="card">
    <div class="card-body">
    <div class="p-3">
            <h1 class="anchor fw-bolder">
                Nueva Venta
            </h1>
        </div>
        <Form method="POST" action="{{ url('venta/store') }}">
            @csrf
            <div class="form-group">
                <div class="row">
                    
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="fecha" class="form-label" required>Fecha</label>
                        <input type="date"  placeholder="Ingrese Fecha" name="fecha" id="fecha" class="form-control" required  >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="descripcion" class="form-label" required>Descripcion</label>
                        <input type="text" placeholder=" ingrese Descripcion"   name="descripcion" id="descripcion" class="form-control" required >
                    </div> 
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="costoventa" class="form-label" required>Costo Venta</label>
                        <input type="number" step=0.01 placeholder=" Ingrese Costo Venta" readonly name="costoventa" id="costoventa" class="form-control" required  >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="estadoventa" class="form-label" required>Estado Venta</label>
                        
                        <select class="required form-select" name="estadoventa" id="estadoventa" readonly>
                            <option selected disabled>Seleccione un Estado</option>
                            <option value="PEDIDO"  >PEDIDO</option>
                            <option value="PAGADO"   >PAGADO</option>
                            <option value="ENTREGADO"   >ENTREGADO</option>
                        </select>
                         </div>
                    <div class="col-sm-6 col-lg-6 mb-5">
                        <label for="cliente" class="form-label" required>Cliente</label>
                        <select class="required form-select" name="cliente" id="cliente" >
                            <option selected disabled>Seleccione un cliente</option>
                            @foreach($clientes as $item)
                            <option value="{{$item->id}}" >{{$item->nombres}}  {{$item->apellidos}} Doc:{{$item->numerodocumento}}</option>
                             @endforeach
                        </select>
                    </div>
                    
                    <hr>

                    <h5>Agregar Detalle Venta</h5>
                    
                    <div class="col-sm-6 col-lg-3 mb-5">
                    <label for="inventario" class="form-label" required>Producto</label>
                    <select class="required form-select" name="inventario" id="inventario" >
                            <option selected disabled>Seleccione un producto</option>
                            @foreach($productos as $item)
                            <option value="{{$item->idinventario}}" >{{$item->producto}}</option>
                             @endforeach
                        </select>
                    </div> 
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="cantidad" class="form-label" required>Cantidad</label>
                        <input type="number"   placeholder=" Ingrese Cantidad"  name="cantidad" id="cantidad" class="form-control"     >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="precioUnidad" class="form-label" required>Precio Unitario</label>
                        <input type="number"  step=0.01 placeholder=" Ingrese Precio Unidad"  name="precioUnidad" id="precioUnidad" class="form-control"     >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="descuento" class="form-label" required>Descuento</label>
                        <input type="number" step=0.01  placeholder=" Ingrese Descuento"  name="descuento" id="descuento" class="form-control"     >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="precioTotal" class="form-label" required>Precio Total</label>
                        <input type="number" step=0.01  placeholder=" Ingrese Precio Total"  name="precioTotal" id="precioTotal" class="form-control"  readonly   >
                    </div>
                    
               <div class="d-flex justify-content-end ">
                        <button type="button" class="btn btn-info" id="addDetalleBatch"><i class="fa fa-plus"></i> Agregar Detalle</button>
                    </div>
                    <hr>

                    <div class="table-responsive">
                        <table class="table table-row-bordered gy-5 gs-5" id="detallesventa">
                            <thead class="fw-bold text-primary">
                                <tr>
                                    <th>Producto</th>
                                    
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Descuento</th>
                                    <th>Precio Total</th>
                                    

                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="text-align: center">
                    <div class="col-12">
                        <button type="submit" value="Guardar" id="Guardar" class="btn btn-primary" ><i class="fas fa-save"> </i>&nbsp;Guardar Venta</button>

                    </div>
                    <a href="{{url('venta/index')}}" type="button" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i>
                        Cancelar
                    </a>
                </div>
            </div>

        </Form>

        <!--end::Wrapper-->

    </div>

</div>
<br>

@endsection

@section('script')
@include('helpers.data-managment')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script type="text/javascript">
   var preciototalI=0;
   var costoventatotal = 0;
   var indice = 0;
    $(document).ready(function() {
       
        var hoy = new Date();  
        var fechaActual = hoy.getFullYear() + '-' + (String(hoy.getMonth() + 1).padStart(2, '0')) + '-' + String(hoy.getDate()).padStart(2, '0');
        document.getElementById("fecha").value = fechaActual;
        
       //var horaActual=String(hoy.getHours()).padStart(2, '0')+':'+String(hoy.getMinutes()).padStart(2, '0'); 
        //document.getElementById("horaInicio").value = horaActual;
        
        document.getElementById("cantidad").onchange = function() {
        preciototal();
        };
        document.getElementById("descuento").onchange = function() {
        preciototal();
        };
        document.getElementById("precioUnidad").onchange = function() {
        preciototal();
        };
 
        //PARA AGREGAR DETALLES DE BATCH A LA TABLA
        var tabla = document.getElementById(detallesventa);
       
        $('#addDetalleBatch').click(function() {
          
            //datos del detalleSensor
            var inventario = $('[name="inventario"]').val();
            var descuento = $('[name="descuento"]').val();
            var cantidad = $('[name="cantidad"]').val();
            var precioUnidad = $('[name="precioUnidad"]').val();
            var precioTotal = $('[name="precioTotal"]').val();
             
            //alertas para los detallesBatch
            if (!inventario) {  alert("ingrese un inventario"); return;   }
            if (!descuento) {  alert("ingrese un Descuento"); return;   }
            if (!cantidad) {  alert("ingrese una Cantidad"); return;   }
            if (!precioUnidad) {  alert("ingrese un Precio Unitario"); return;   }
            if (!precioTotal) {  alert("ingrese una Precio Total"); return;   }
           
             
            var LDventa = [];
            var tam = LDventa.length;
            LDventa.push(inventario,descuento, cantidad, precioUnidad, precioTotal);
        
                filaDetalle ='<tr id="fila' + indice + 
                '"><td><input  type="hidden" name="Linventario[]" value="' + LDventa[0]  + '"required>'+ LDventa[0]+
               
                '</td><td><input  type="hidden" name="Lcantidad[]" value="' + LDventa[2] + '"required>'+ LDventa[2]+ 
                '</td><td><input  type="hidden" name="Lpreciounidad[]" value="' + LDventa[3] + '"required>'+ LDventa[3]+
                '</td><td><input  type="hidden" name="Ldescuento[]" value="' + LDventa[1] + '"required>'+ LDventa[1]+  
                '</td><td ><input id="preciot' + indice +'"  type="hidden" name="Lpreciototal[]" value="' + LDventa[4] + '"required>'+ LDventa[4]+ 
                '</td><td><button type="button" class="btn btn-link btn-color-danger btn-sm delete" onclick="eliminarFila(' + indice + ')" data-id="0"><i class="bi bi-trash-fill"></i></button></td></tr>';
               
                $("#detallesventa>tbody").append(filaDetalle);
               
                 indice++;
                 costoventatotal = costoventatotal + preciototalI;
                 preciototalI=0;
                 document.getElementById('costoventa').value = costoventatotal;
                 document.getElementById("inventario").value = "";
                 document.getElementById("descuento").value = "";
                 document.getElementById("cantidad").value = "";
                 document.getElementById("precioUnidad").value = "";
                 document.getElementById("precioTotal").value = "";


        });

        $('#Guardar').click(function() {
            
            var fecha = $('[name="fecha"]').val();
            var descripcion = $('[name="descripcion"]').val();
            var costoventa = $('[name="costoventa"]').val();
            var estadoventa = $('[name="estadoventa"]').val();
            var cliente = $('[name="cliente"]').val();
           
            if (!fecha) {  alert("Ingrese una fecha"); return;   }
            if (!descripcion) {  alert("Ingrese una descripcion"); return;   }
            if (!costoventa) {  alert("Ingrese un costo venta");    return;  }
            if (!estadoventa) {  alert("Ingrese un estadoventa"); return;   }
            if (!cliente) {  alert("Ingrese un cliente");    return;  }

            confirm('Guardar ?');
        });

    });
    //PARA ELIMINAR UN DATO DE LA TABLA
    function eliminarFila(ind) {
        var resta =0;
    
          //document.getElementById('preciot' + ind).value();
          resta = $('[id="preciot' + ind+'"]').val();
          //alert(resta);
        costoventatotal = costoventatotal - resta;

    $('#fila' + ind).remove();
        indice-- ;
    // damos el valor
    document.getElementById('costoventa').value = costoventatotal;
    //alert(resta);

    return false;
}

       

    

    function preciototal() {
         preciototalI=0;
        var cantidad = $('[name="cantidad"]').val();
        var precioUnidad = $('[name="precioUnidad"]').val();
        var descuento = $('[name="descuento"]').val();
        if(cantidad.length != 0  && precioUnidad.length != 0 && descuento.length != 0){
             
                    //alert("final");
                    preciototalI = (cantidad * precioUnidad) - descuento;
                    //costoventatotal = costoventatotal + preciototalI;
                    document.getElementById('precioTotal').value = preciototalI;
                  
                
        }
   }

     
</script>
@endsection
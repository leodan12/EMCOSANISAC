@extends('layout.base')


@section('container')

<div class="card">
    <div class="card-body">
    <div class="p-3">
            <h1 class="anchor fw-bolder">
                Nueva Compra
            </h1>
        </div>
        <Form method="POST" action="{{ url('compra/store') }}">
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
                        <label for="costoCompra" class="form-label" required>Costo Compra</label>
                        <input type="number" step=0.01 placeholder=" Ingrese Costo Compra" readonly name="costoCompra" id="costoCompra" class="form-control" required  >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="estadoCompra" class="form-label" required>Estado Compra</label>
                        
                        <select class="required form-select" name="estadoCompra" id="estadoCompra" readonly>
                            <option selected disabled>Seleccione un Estado</option>
                            <option value="PEDIDO"  >PEDIDO</option>
                            <option value="PAGADO"   >PAGADO</option>
                            <option value="RECIBIDO"   >RECIBIDO</option>
                        </select>
                         </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="proveedor" class="form-label" required>Proveedor</label>
                        <select class="required form-select" name="proveedor" id="proveedor" >
                            <option selected disabled>Seleccione un proveedor</option>
                            @foreach($proveedores as $item)
                            <option value="{{$item->id}}" >{{$item->proveedor}}</option>
                             @endforeach
                        </select>
                    </div>
                    
                    <hr>

                    <h5>Agregar Detalle Compra</h5>
                    
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
                        <label for="unidadMedida" class="form-label" required>Unidad de Medida</label>
                        <input type="text"   placeholder=" Ingrese Unidad de Medida"  name="unidadMedida" id="unidadMedida" class="form-control"     >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="cantidad" class="form-label" required>Cantidad</label>
                        <input type="number"   placeholder=" Ingrese Cantidad"  name="cantidad" id="cantidad" class="form-control"     >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="precioUnidad" class="form-label" required>Precio Unitario</label>
                        <input type="number"  step=0.1 placeholder=" Ingrese Precio Unidad"  name="precioUnidad" id="precioUnidad" class="form-control"     >
                    </div>
                    <div class="col-sm-6 col-lg-3 mb-5">
                        <label for="precioTotal" class="form-label" required>Precio Total</label>
                        <input type="number" step=0.1  placeholder=" Ingrese Precio Total"  name="precioTotal" id="precioTotal" class="form-control"  readonly   >
                    </div>
                    
               <div class="d-flex justify-content-end ">
                        <button type="button" class="btn btn-info" id="addDetalleBatch"><i class="fa fa-plus"></i> Agregar Detalle</button>
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
                                <tr></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="text-align: center">
                    <div class="col-12">
                        <button type="submit" value="Guardar" id="Guardar" class="btn btn-primary" ><i class="fas fa-save"> </i>&nbsp;Guardar Compra</button>
                        <a href="{{url('compra/index')}}" type="button" class="btn btn-light">
                        <i class="fas fa-arrow-left"></i>
                        Cancelar
                    </a>
                    </div>
                   
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
   
   var costocompratotal = 0;
   var indice = 0;
   var preciototalI=0;
    $(document).ready(function() {
       
        var hoy = new Date();  
        var fechaActual = hoy.getFullYear() + '-' + (String(hoy.getMonth() + 1).padStart(2, '0')) + '-' + String(hoy.getDate()).padStart(2, '0');
        document.getElementById("fecha").value = fechaActual;
        
       //var horaActual=String(hoy.getHours()).padStart(2, '0')+':'+String(hoy.getMinutes()).padStart(2, '0'); 
        //document.getElementById("horaInicio").value = horaActual;
        
        document.getElementById("cantidad").onchange = function() {
        preciototal();
        };
        document.getElementById("precioUnidad").onchange = function() {
        preciototal();
        };
 
        //PARA AGREGAR DETALLES DE BATCH A LA TABLA
        var tabla = document.getElementById(detallesCompra);
       
        $('#addDetalleBatch').click(function() {
          
            //datos del detalleSensor
            var inventario = $('[name="inventario"]').val();
            var unidadMedida = $('[name="unidadMedida"]').val();
            var cantidad = $('[name="cantidad"]').val();
            var precioUnidad = $('[name="precioUnidad"]').val();
            var precioTotal = $('[name="precioTotal"]').val();
             
            //alertas para los detallesBatch
            if (!inventario) {  alert("ingrese un inventario"); return;   }
            if (!unidadMedida) {  alert("ingrese una Unidad Medida"); return;   }
            if (!cantidad) {  alert("ingrese una Cantidad"); return;   }
            if (!precioUnidad) {  alert("ingrese un Precio Unitario"); return;   }
            if (!precioTotal) {  alert("ingrese una Precio Total"); return;   }
           
             
            var LDCompra = [];
            var tam = LDCompra.length;
            LDCompra.push(inventario,unidadMedida, cantidad, precioUnidad, precioTotal);
        
                filaDetalle ='<tr id="fila' + indice + 
                '"><td><input  type="hidden" name="Linventario[]" value="' + LDCompra[0]  + '"required>'+ LDCompra[0]+
                '</td><td><input  type="hidden" name="Lunidadmedida[]" value="' + LDCompra[1] + '"required>'+ LDCompra[1]+ 
                '</td><td><input  type="hidden" name="Lcantidad[]" value="' + LDCompra[2] + '"required>'+ LDCompra[2]+ 
                '</td><td><input  type="hidden" name="Lpreciounidad[]" value="' + LDCompra[3] + '"required>'+ LDCompra[3]+ 
                '</td><td ><input id="preciot' + indice +'"  type="hidden" name="Lpreciototal[]" value="' + LDCompra[4] + '"required>'+ LDCompra[4]+ 
                '</td><td><button type="button" class="btn btn-link btn-color-danger btn-sm delete" onclick="eliminarFila(' + indice + ')" data-id="0"><i class="bi bi-trash-fill"></i></button></td></tr>';
               
                $("#detallesCompra>tbody").append(filaDetalle);
               
                 indice++;
                 costocompratotal = costocompratotal + preciototalI;
                 preciototalI=0;
                 document.getElementById('costoCompra').value = costocompratotal;
                 document.getElementById("inventario").value = "";
                 document.getElementById("unidadMedida").value = "";
                 document.getElementById("cantidad").value = "";
                 document.getElementById("precioUnidad").value = "";
                 document.getElementById("precioTotal").value = "";


        });

        $('#Guardar').click(function() {
            
            var fecha = $('[name="fecha"]').val();
            var descripcion = $('[name="descripcion"]').val();
            var costocompra = $('[name="costoCompra"]').val();
            var estadocompra = $('[name="estadoCompra"]').val();
            var proveedor = $('[name="proveedor"]').val();
           
            if (!fecha) {  alert("Ingrese una fecha"); return;   }
            if (!descripcion) {  alert("Ingrese una descripcion"); return;   }
            if (!costocompra) {  alert("Ingrese un costo compra");    return;  }
            if (!estadocompra) {  alert("Ingrese un estadocompra"); return;   }
            if (!proveedor) {  alert("Ingrese un proveedor");    return;  }

            confirm('Guardar ?');
        });

    });
    //PARA ELIMINAR UN DATO DE LA TABLA
    function eliminarFila(ind) {
        var resta =0;
    
          //document.getElementById('preciot' + ind).value();
          resta = $('[id="preciot' + ind+'"]').val();
          //alert(resta);
        costocompratotal = costocompratotal - resta;

    $('#fila' + ind).remove();
        indice-- ;
    // damos el valor
    document.getElementById('costoCompra').value = costocompratotal;
    //alert(resta);

    return false;
}

       

    

    function preciototal() {
         preciototalI=0;
        var cantidad = $('[name="cantidad"]').val();
        var precioUnidad = $('[name="precioUnidad"]').val();
        if(cantidad.length != 0){
            if(precioUnidad.length != 0){
                preciototalI = cantidad * precioUnidad;
                //costocompratotal = costocompratotal + preciototalI;
                document.getElementById('precioTotal').value = preciototalI;
            }
        }
   }

     
</script>
@endsection
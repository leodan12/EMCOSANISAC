@extends('layout.base')

@section('page-info')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />


<!-- mostramos el mensaje despues de hacer un cambio en los resgistros-->
<script src="{{ asset('mensaje.js') }}"> </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Productos', 'Stock', { role: "style" } ], 
            @foreach($masstock as $reg)
            ['{{$reg->producto}}', {{ $reg->stock  }}, "#2fb301"],
            @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Top 20 de los Productos con mas Stock",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);
  }
  </script>
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Productos', 'Stock', { role: "style" } ], 
            @foreach($menosstock as $reg)
            ['{{$reg->producto}}', {{ $reg->stock  }}, "#ffe225"],
            @endforeach
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Top 20 de los Productos con Menos Stock",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values1"));
      chart.draw(view, options);
  }
  </script>


 

@endsection


@section('container')
<div class="row" style="text-align: center;">
    <div class="col col-12">
        <h3>Reportes de Inventarios  de Productos   </h3>
        @if (session()->has('respuesta')) {{-- comprueba si existe el valor en sesión --}}
        <script>
            mensaje("{{session('respuesta')}}");
        </script>

        {!! session()->forget('respuesta') !!} {{-- borrar el error de sesión --}}
        @endif
    </div>
</div>

<div class="row">
<div class="col-sm-4">
        <div class="card" style="background-color: skyblue; height:190px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h5 class="card-title">Productos Comprados Hoy </h5>
                        <h2><span id="productosdeldiac"> </span> </h2>
                    </div>
                    <div class="col-4" style="text-align: right;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="#ff0000" d="M470.7 9.4c3 3.1 5.3 6.6 6.9 10.3s2.4 7.8 2.4 12.2l0 .1v0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32V109.3L310.6 214.6c-11.8 11.8-30.8 12.6-43.5 1.7L176 138.1 84.8 216.3c-13.4 11.5-33.6 9.9-45.1-3.5s-9.9-33.6 3.5-45.1l112-96c12-10.3 29.7-10.3 41.7 0l89.5 76.7L370.7 64H352c-17.7 0-32-14.3-32-32s14.3-32 32-32h96 0c8.8 0 16.8 3.6 22.6 9.3l.1 .1zM0 304c0-26.5 21.5-48 48-48H464c26.5 0 48 21.5 48 48V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V304zM48 416v48H96c0-26.5-21.5-48-48-48zM96 304H48v48c26.5 0 48-21.5 48-48zM464 416c-26.5 0-48 21.5-48 48h48V416zM416 304c0 26.5 21.5 48 48 48V304H416zm-96 80c0-35.3-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64s64-28.7 64-64z" />
                        </svg>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6" style="text-align: left;">
                        <h6>Esta Semana</h6>
                        <h4><span id="productosdelasemanac"> </span></h4>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <h6>Este Mes</h6>
                        <h4><span id="productosdelmesc"> </span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="background-color: skyblue; height:190px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h5 class="card-title">Productos Vendidos Hoy </h5>
                        <h2><span id="productosdeldia"> </span> </h2>
                    </div>
                    <div class="col-4" style="text-align: right;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="#00ff00" d="M160 80c0-26.5 21.5-48 48-48h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V80zM0 272c0-26.5 21.5-48 48-48H80c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V272zM368 96h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H368c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48z" />
                        </svg>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6" style="text-align: left;">
                        <h6>Esta Semana</h6>
                        <h4><span id="productosdelasemana"> </span></h4>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <h6>Este Mes</h6>
                        <h4><span id="productosdelmes"> </span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card" style="background-color: skyblue; height:190px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <h5 class="card-title">Productos sin Stock </h5>
                        <h2><span id="sinstock"> </span> </h2>
                    </div>
                    <div class="col-4" style="text-align: right;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path fill="#800080" d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                        </svg>

                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6" style="text-align: left;">
                        <h6>Productos con Stock Menor que  30</h6>
                        <h4><span id="stockmenor30"> </span></h4>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <h6>Productos con Stock Mayor que  30</h6>
                        <h4><span id="stockmayor30"> </span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-12">
        <br>
        <div class="row">
            
            <div class="col-10 mb-5">
                <label for="limitestock" class="required form-label">Limite de Stock</label>
                <input type="number" placeholder=" Ingrese Limite de Stock" name="limitestock" id="limitestock" class="form-control" required>
            </div>
            <div class="col-2 mb-5">
                <label for="fechafinal" class="  form-label"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                <button type="button" id="btnreporte" class="btn btn-info">Generar Reporte</button>
            </div>
        </div>
    </div>
    <div class="col-6">
    <div id="barchart_values" style="width: 100%; height: 300px;"></div>
    </div>
    <div class="col-6">
    <div id="barchart_values1" style="width: 100%; height: 300px;"></div>
    </div>
</div>

<br><br><br><br><br><br>  
<div class="row">
<div class="col-12"> <h4>Listado de Productos Mayor Stock </h4></div>
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
                        <th class="w-80px">Producto</th>
                        <th class="w-80px">Marca</th> 
                        <th class="w-80px">Categoria</th> 
                        <th class="w-80px">Precio</th>
                        <th class="w-80px">Stock</th>  
                    </tr>
                </thead>
                <tbody> 
                </tbody>
            </table> 
        </div> 
    </div>

    <div>
        <section> 
            <div id="pagination"></div>
        </section>
    </div>
 

<br>   
<div class="row">
<div class="col-12"> <h4>Listado de Productos Menor Stock </h4></div>
<div class="table-responsive">
            <div class="d-flex flex-stack">
                <div class="d-flex btn-excel-datatable"> </div> 
                <div class="d-flex justify-content-end">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"></rect>
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"></path>
                            </svg>
                        </span>
                        <input type="text" id="buscador2" class="form-control form-control-solid w-250px ps-15" autocomplete="off" placeholder="Buscar en el listado" />
                    </div>

                </div>
            </div>
            <table id="listado2" data-page-length='5' class="table table-row-bordered table-row-success table-rounded border gs-7 align-middle" style="width: 92,5vw;">
                <thead>
                    <tr class=" text-primary fw-bold fs-6" id="fila">
                        <th class="w-80px">Id</th> 
                        <th class="w-80px">Producto</th>
                        <th class="w-80px">Marca</th> 
                        <th class="w-80px">Categoria</th> 
                        <th class="w-80px">Precio</th>
                        <th class="w-80px">Stock</th>  
                    </tr>
                </thead>
                <tbody> 
                </tbody>
            </table> 
        </div> 
    </div>

    <div>
        <section> 
            <div id="pagination2"></div>
        </section>
    </div>
</div>


@endsection


@section('script')
@include('helpers.data-managment')
 
<script>
    $(document).ready(function() {

        
        document.getElementById("limitestock").value = 15;


        $.get('/productos', function(data) {
            var productosdiac = data['productosdiac'][0].productosdiac;
            var productossemanac = data['productossemanac'][0].productossemanac;
            var productosmesc = data['productosmesc'][0].productosmesc;

            var productosdia = data['productosdia'][0].productosdia;
            var productossemana = data['productossemana'][0].productossemana;
            var productosmes = data['productosmes'][0].productosmes;

            var sinstock = data['sinstock'][0].sinstock;
             var stockmenor30 = data['stockmenor30'][0].stockmenor30;
            var stockmayor30 = data['stockmayor30'][0].stockmayor30;
            // Selecciona el elemento h5
            document.getElementById('productosdeldiac').innerHTML = productosdiac;
            document.getElementById('productosdelasemanac').innerHTML = productossemanac;
            document.getElementById('productosdelmesc').innerHTML = productosmesc;

            document.getElementById('productosdeldia').innerHTML = productosdia;
            document.getElementById('productosdelasemana').innerHTML = productossemana;
            document.getElementById('productosdelmes').innerHTML = productosmes;

            document.getElementById('sinstock').innerHTML = sinstock;
             document.getElementById('stockmenor30').innerHTML = stockmenor30;
            document.getElementById('stockmayor30').innerHTML = stockmayor30;


        });
        //inicializamos la tabla listado
        globalThis.tablelistado = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5,], 'Productos_mas_vendidos', function() {}, true, true, false);
         globalThis.tablelistado2 = defineTable($('#listado2'), [], [0, 1, 2, 3, 4, 5,], 'Productos_mas_vendidos', function() {}, true, true, false);
 
    });

    var contd = 0;

    document.getElementById("btnreporte").addEventListener("click", function() {
        
        google.charts.load('current', {
        'packages': ['corechart']
    });
    globalThis.midata = [];
    midata.push(["Productos", "Stock", { role: "style" }]);

    globalThis.midata2 = [];
    midata2.push(["Productos", "Stock", { role: "style" }]);

    traerDatos();

    llenarTabla();
    });

    function llenarTabla(){
        var limite = document.getElementById('limitestock').value;
       
        
         $.get('/inventarioslimite/' + limite , function(data) { 
        var ProductosTabla = data; 
        generarTabla(ProductosTabla); 
       }); 
       $.get('/inventarioslimite2/' + limite, function(data) { 
             var ProductosTabla2 = data; 
             generarTabla2(ProductosTabla2); 
        }); 
    }



    function traerDatos(){
        
        var limite = document.getElementById('limitestock').value; 
        
         $.get('/inventariosmenor/' + limite, function(data) {
             
              for (var i = 0; i < data.stockmenor30.length; i++) {
                midata.push([ data.stockmenor30[i].producto ,parseInt( data.stockmenor30[i].stock ), "#2fb301"], );   
             }
             google.charts.setOnLoadCallback(drawChart);  
           
       }); 
    }
       function traerDatos2(){
        
        var limite = document.getElementById('limitestock').value; 
        
         $.get('/inventariosmayor/' + limite, function(data) {
             
              for (var i = 0; i < data.stockmayor30.length; i++) {
                midata2.push([ data.stockmayor30[i].producto ,parseInt( data.stockmayor30[i].stock ), "#ffe225"], );   
             }
             google.charts.setOnLoadCallback(drawChart2);  
           
       });  
    }
    
    function drawChart() {
        //console.log(midata);
       var data = google.visualization.arrayToDataTable(midata);    
       var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Top de los Productos con Menos Stock",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
      chart.draw(view, options);

      traerDatos2();
    }

    function drawChart2() {
        //console.log(midata);
       var data = google.visualization.arrayToDataTable(midata2);    
       var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Top de los Productos con Mas Stock",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.BarChart(document.getElementById("barchart_values1"));
      chart.draw(view, options); 
    }
 


    var contd = 0;
 
</script>

<script>
    $(document).ready(function() {
    var productostabla = @json($productosTabla);
    generarTabla(productostabla);

    var productostabla2 = @json($productosTabla2);
    generarTabla2(productostabla2);
 

    }); 

    function generarTabla(data){

         
        var urlVentas = "{{ url('productos') }}";

        let table1 = document.getElementById("listado");
        let rowCount = table1.getElementsByTagName("tr");

        for (let i = 0; i < rowCount; i++) {
            table1.deleteRow(i);
        }
 
         //tablelistado = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5,6,7], 'Ventas', function() {}, true, true, false);
 
        $('#buscador').keyup(function(e) {
            tablelistado.search(e.target.value).draw();
        });

        listarOnTable(tablelistado, data, 0, [], true, true, true, urlVentas, false, []);
    }
    function generarTabla2(data){

         
        var urlVentas = "{{ url('productos') }}";

        let table1 = document.getElementById("listado2");
        let rowCount = table1.getElementsByTagName("tr");

        for (let i = 0; i < rowCount; i++) {
            table1.deleteRow(i);
        }
 
         //tablelistado = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5,6,7], 'Ventas', function() {}, true, true, false);
 
        $('#buscador2').keyup(function(e) {
            tablelistado2.search(e.target.value).draw();
        });

        listarOnTable(tablelistado2, data, 0, [], true, true, true, urlVentas, false, []);
    }
 
</script>
 
@endsection
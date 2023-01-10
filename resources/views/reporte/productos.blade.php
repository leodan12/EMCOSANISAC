@extends('layout.base')

@section('page-info')

<!-- mostramos el mensaje despues de hacer un cambio en los resgistros-->
<script src="{{ asset('mensaje.js') }}"> </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Productos', 'Cantidad Ventas', { role: "style" } ], 
            @foreach($masvendidos as $reg)
            ['{{$reg->producto}}', {{ $reg->cantidad  }}, "#2fb301"],
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
        title: "Top 10 de los Productos mas Vendidos",
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
        ['Productos', 'Cantidad Ventas', { role: "style" } ], 
            @foreach($menosvendidos as $reg)
            ['{{$reg->producto}}', {{ $reg->cantidad  }}, "#ffe225"],
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
        title: "Top 10 de los Productos Menos Vendidos",
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
        <h3>Reportes de Productos mas Vendidos</h3>
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
                        <h5 class="card-title">Ventas del Dia </h5>
                        <h2><span id="ventasdeldia"> </span> </h2>
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
                        <h6>Esta Semana</h6>
                        <h4><span id="ventasdelasemana"> </span></h4>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <h6>Este Mes</h6>
                        <h4><span id="ventasdelmes"> </span></h4>
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
            <div class="col-5 mb-5">
                <label for="fechainicial" class="required form-label">Fecha Inicial</label>
                <input type="date" placeholder=" ingrese Fecha Inicial" name="fechainicial" id="fechainicial" class="form-control" required>
            </div>
            <div class="col-5 mb-5">
                <label for="fechafinal" class="required form-label">Fecha Final</label>
                <input type="date" placeholder=" ingrese Fecha Final" name="fechafinal" id="fechafinal" class="form-control" required>
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


@endsection


@section('script')
@include('helpers.data-managment')
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        var hoy = new Date();
        var fechaActual = hoy.getFullYear() + '-' + (String(hoy.getMonth() + 1).padStart(2, '0')) + '-' + String(hoy.getDate()).padStart(2, '0');


        document.getElementById("fechainicial").value = fechaActual;
        document.getElementById("fechafinal").value = fechaActual;


        $.get('/productos', function(data) {
            var productosdiac = data['productosdiac'][0].productosdiac;
            var productossemanac = data['productossemanac'][0].productossemanac;
            var productosmesc = data['productosmesc'][0].productosmesc;

            var productosdia = data['productosdia'][0].productosdia;
            var productossemana = data['productossemana'][0].productossemana;
            var productosmes = data['productosmes'][0].productosmes;

            var ventasdia = data['ventasdia'][0].ventasdia;
             var ventassemana = data['ventassemana'][0].ventassemana;
            var ventasmes = data['ventasmes'][0].ventasmes;
            // Selecciona el elemento h5
            document.getElementById('productosdeldiac').innerHTML = productosdiac;
            document.getElementById('productosdelasemanac').innerHTML = productossemanac;
            document.getElementById('productosdelmesc').innerHTML = productosmesc;

            document.getElementById('productosdeldia').innerHTML = productosdia;
            document.getElementById('productosdelasemana').innerHTML = productossemana;
            document.getElementById('productosdelmes').innerHTML = productosmes;

            document.getElementById('ventasdeldia').innerHTML = ventasdia;
             document.getElementById('ventasdelasemana').innerHTML = ventassemana;
            document.getElementById('ventasdelmes').innerHTML = ventasmes;


        });

    });

    var contd = 0;

    document.getElementById("btnreporte").addEventListener("click", function() {
        
        google.charts.load('current', {
        'packages': ['corechart']
    });
    globalThis.midata = [];
    midata.push(["Productos", "Cantidad Ventas", { role: "style" }]);

    globalThis.midata2 = [];
    midata2.push(["Productos", "Cantidad Ventas", { role: "style" }]);

    traerDatos();

    });

    

    function traerDatos(){
        
        var fechaI = document.getElementById('fechainicial').value;
        var fechaF = document.getElementById('fechafinal').value;
        
         $.get('/nuestrosproductosmas/' + fechaI + '/' + fechaF, function(data) {
             
              for (var i = 0; i < data.masvendidos.length; i++) {
                midata.push([ data.masvendidos[i].producto ,parseInt( data.masvendidos[i].cantidad ), "#2fb301"], );   
             }
             google.charts.setOnLoadCallback(drawChart);  
           
       }); 
    }
       function traerDatos2(){
        
        var fechaI = document.getElementById('fechainicial').value;
        var fechaF = document.getElementById('fechafinal').value;
        
         $.get('/nuestrosproductosmenos/' + fechaI + '/' + fechaF, function(data) {
             
              for (var i = 0; i < data.menosvendidos.length; i++) {
                midata2.push([ data.menosvendidos[i].producto ,parseInt( data.menosvendidos[i].cantidad ), "#ffe225"], );   
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
        title: "Top de los Productos Mas Vendidos",
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
        title: "Top de los Productos Menos Vendidos",
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
@extends('layout.base')

@section('page-info')

<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />


<!-- mostramos el mensaje despues de hacer un cambio en los resgistros-->
<script src="{{ asset('mensaje.js') }}"> </script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Fecha', 'Compras'], 
            @foreach($compras as $reg)
            ['{{$reg->fecha}}', {{ $reg->egreso  }}],
            @endforeach
 
        ]);

        var options = {
            title: 'Nuestras Compras ',
            hAxis: {
                title: 'Fechas',
                titleTextStyle: {
                    color: '#333'
                }
            },
            vAxis: {
                minValue: 0
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>


@endsection


@section('container')
<div class="row" style="text-align: center;">
    <div class="col col-12">
        <h3>Reportes de Compras</h3>
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
                        <h5 class="card-title">Egresos del Dia </h5>
                        <h2>S/<span id="egresosdeldia"> </span></h2>
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
                        <h4>S/<span id="egresosdelasemana"></span></h4>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <h6>Este Mes</h6>
                        <h4>S/<span id="egresosdelmes"> </span></h4>
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
                        <h5 class="card-title">Productos Comprados Hoy </h5>
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
                        <h5 class="card-title">Compras del Dia </h5>
                        <h2><span id="comprasdeldia"> </span> </h2>
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
                        <h4><span id="comprasdelasemana"> </span></h4>
                    </div>
                    <div class="col-6" style="text-align: right;">
                        <h6>Este Mes</h6>
                        <h4><span id="comprasdelmes"> </span></h4>
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
    <div class="col-12">
        <div id="chart_div" style="width: 100%; height: 500px;"></div>
    </div>
</div>

<div class="row">
    <div class="col-12"> <h4>Listado del Detalle del Reporte </h4></div>
<div class="table-responsive">
            <div class="d-flex flex-stack">
                <div class="d-flex btn-excel-datatable"></div>
                <div class="d-flex justify-content-start"> 
                <select class="form-select" aria-label="Default select example" name="selectmarca" id="selectmarca">
                    <option selected disabled>Filtrar por Marca</option>
                    @foreach($marcas as $item)
                    <option  value="{{$item->marca}}">{{$item->marca}}</option>
                    @endforeach
        </select>
      </div>
      <div class="d-flex justify-content-start"> 
                <select class="form-select" aria-label="Default select example" name="selectproducto" id="selectproducto">
                    <option selected disabled>Filtrar por Producto</option>
                    @foreach($productos as $item)
                    <option  value="{{$item->producto}}">{{$item->producto}}</option>
                    @endforeach
        </select>
      </div>
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
                        <th class="w-80px">Cantidad</th> 
                        <th class="w-80px">Precio Unidad</th>
                        <th class="w-80px">Unidad Medida</th>
                        <th class="w-80px">Precio Total</th> 
                        <th class="w-80px">Fecha</th>   
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
</div>



@endsection


@section('script')
@include('helpers.data-managment')
 
<script>
    $(document).ready(function() {

        var hoy = new Date();
        var fechaActual = hoy.getFullYear() + '-' + (String(hoy.getMonth() + 1).padStart(2, '0')) + '-' + String(hoy.getDate()).padStart(2, '0');


        document.getElementById("fechainicial").value = fechaActual;
        document.getElementById("fechafinal").value = fechaActual;


        $.get('/egresos', function(data) {
            var egresodia = data['egresodia'][0].egresodia;
            var egresosemana = data['egresosemana'][0].egresosemana;
            var egresomes = data['egresomes'][0].egresomes;
            var productosdia = data['productosdia'][0].productosdia;
            var productossemana = data['productossemana'][0].productossemana;
            var productosmes = data['productosmes'][0].productosmes;
            var comprasdia = data['comprasdia'][0].comprasdia;
            var comprassemana = data['comprassemana'][0].comprassemana;
            var comprasmes = data['comprasmes'][0].comprasmes;
            // Selecciona el elemento h5
            document.getElementById('egresosdeldia').innerHTML = egresodia;
            document.getElementById('egresosdelasemana').innerHTML = egresosemana;
            document.getElementById('egresosdelmes').innerHTML = egresomes;
            document.getElementById('productosdeldia').innerHTML = productosdia;
            document.getElementById('productosdelasemana').innerHTML = productossemana;
            document.getElementById('productosdelmes').innerHTML = productosmes;
            document.getElementById('comprasdeldia').innerHTML = comprasdia;
            document.getElementById('comprasdelasemana').innerHTML = comprassemana;
            document.getElementById('comprasdelmes').innerHTML = comprasmes;


        });

          //inicializamos la tabla listado
          globalThis.tablelistado = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5,6,7], 'Compras', function() {}, true, true, false);


    });

    var contd = 0;

    document.getElementById("btnreporte").addEventListener("click", function() {
        
        google.charts.load('current', {
        'packages': ['corechart']
    });
    globalThis.midata = [];
    midata.push(["Fecha", "Compras"]);

    traerDatos();
    llenarTabla();
    llenarCombo();
    });

    function llenarCombo(){
        var fechaI = document.getElementById('fechainicial').value;
        var fechaF = document.getElementById('fechafinal').value;

        $.get('/llenarcombocompras/' + fechaI+'/'+fechaF, function(data) {
              
              var marca_select = '<option value="" disabled selected>Seleccione un turno</option>'
              for (var i = 0; i < data.length; i++)
                marca_select += '<option value="' + data[i].marca + '">' + data[i].marca + '</option>';
              $("#selectmarca").html(marca_select);
              $('#selectmarca').prop('disabled', false);
          });

          $.get('/llenarcomboproductoscompras/' + fechaI+'/'+fechaF, function(data) {
              
              var marca_select = '<option value="" disabled selected>Seleccione un Producto</option>'
              for (var i = 0; i < data.length; i++)
                marca_select += '<option value="' + data[i].producto + '">' + data[i].producto + '</option>';
              $("#selectproducto").html(marca_select);
              $('#selectproducto').prop('disabled', false);
          });
    }
  
    function llenarTabla(){
        var fechaI = document.getElementById('fechainicial').value;
        var fechaF = document.getElementById('fechafinal').value;
        
         $.get('/comprasenfecha/' + fechaI + '/' + fechaF, function(data) {
             
            
        var ventasTabla = data;
         //console.log(ventasTabla); 
        generarTabla(ventasTabla);
          
           
       }); 
    }

    function traerDatos(){
        
        var fechaI = document.getElementById('fechainicial').value;
        var fechaF = document.getElementById('fechafinal').value;
         
         $.get('/nuestrascompras/' + fechaI + '/' + fechaF, function(data) {
             
              for (var i = 0; i < data.compras.length; i++) {
                 
                 midata.push([ data.compras[i].fecha ,parseInt( data.compras[i].egresos )], );
                  
             }
             
             google.charts.setOnLoadCallback(drawChart);  
           
       }); 
     

    }
    
    function drawChart() {
        
       var data = google.visualization.arrayToDataTable(midata);    
       var options = {
            title: 'Nuestras Compras',
            hAxis: {
                title: 'Fechas',
                titleTextStyle: {
                    color: '#333'
                }
            },
            vAxis: {
                minValue: 0
            }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data , options);
    } 
</script>

<script>
    $(document).ready(function() {
    var comprastabla = @json($comprastabla);
    
        generarTabla(comprastabla);
    }); 

    function generarTabla(data){

       
        var urlVentas = "{{ url('ventas') }}";

        let table1 = document.getElementById("listado");
        let rowCount = table1.getElementsByTagName("tr");

        for (let i = 0; i < rowCount; i++) {
            table1.deleteRow(i);
        }
 
         //tablelistado = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5,6,7], 'Ventas', function() {}, true, true, false);
 
        $('#buscador').keyup(function(e) {
            tablelistado.search(e.target.value).draw();
        });

        $("select[name=selectmarca]").change(function(e){
            tablelistado.search(e.target.value).draw();
        });
        $("select[name=selectproducto]").change(function(e){
            tablelistado.search(e.target.value).draw();
        });


        listarOnTable(tablelistado, data, 0, [], true, true, true, urlVentas, false, []);
    }
</script>

@endsection
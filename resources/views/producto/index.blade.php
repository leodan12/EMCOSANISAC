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
        <h5>Listado de Productos</h5>
        @if (session()->has('respuesta')) {{-- comprueba si existe el valor en sesión --}}
    <script>
       
       mensaje("{{session('respuesta')}}");
   </script>

    {!! session()->forget('respuesta') !!} {{-- borrar el error de sesión --}}
    @endif
    </div>
</div>
<div class="">
    <div class="row">
        <div class="d-flex justify-content-end mb-5" data-kt-docs-table-toolbar="base">
            <a href="{{url('producto/create')}}" class="btn btn-primary">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square-fill" viewBox="0 0 16 16">
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 4.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3a.5.5 0 0 1 1 0z"></path>
                    </svg>
                </span>
                Crear
            </a>

        </div>
        <!-- 
        <button type="button" class="btn btn-primary"   data-bs-toggle="modal" data-bs-target="#mimodal" data-bs-whatever="@fat">Open modal for @fat</button>
-->

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
                        <th class="w-80px">Codigo</th>
                        <th class="w-80px">Producto</th>
                        <th class="w-80px">Descripcion</th>
                        <th class="w-80px">Categoria</th>
                        <th class="w-80px">Marca</th>
                        <th class="w-80px">Precio</th>
                        <th class="w-80px">Peso</th>

                        <th class="w-80px">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>

        <div class="modal fade" id="mimodal" tabindex="-1" aria-labelledby="mimodal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="mimodalLabel">Ver Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="producto" class="col-form-label">Producto:</label>
                                    <input type="text" class="form-control " id="verproducto" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="codigo" class="col-form-label">Codigo:</label>
                                    <input type="text" class="form-control" id="vercodigo" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="categoria" class="col-form-label">Categoria:</label>
                                    <input type="text" class="form-control" id="vercategoria" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="marca" class="col-form-label">Marca:</label>
                                    <input type="text" class="form-control" id="vermarca" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="precio" class="col-form-label">Precio:</label>
                                    <input type="number" class="form-control" id="verprecio" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="precio" class="col-form-label">Peso:</label>
                                    <input type="number" class="form-control" id="verpeso" readonly>
                                </div>
                                <div class="col-sm-12 col-lg-12 mb-5">
                                    <label for="descripcion" class="col-form-label">Descripcion:</label>
                                    <input type="text" class="form-control" id="verdescripcion" readonly>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
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
    const mimodal = document.getElementById('mimodal')
    mimodal.addEventListener('show.bs.modal', event => {

        const button = event.relatedTarget
        const id = button.getAttribute('data-id')
        var urlproducto = "{{ url('producto/show') }}";
        $.get(urlproducto + '/' + id, function(data) {
            console.log(data);

           
            const modalTitle = mimodal.querySelector('.modal-title')
            modalTitle.textContent = `Ver Registro ${id}` 
            document.getElementById("verproducto").value=data.producto;  
            document.getElementById("vercodigo").value=data.codigo;  
            document.getElementById("verdescripcion").value=data.descripcion;  
            document.getElementById("vercategoria").value=data.categoria;  
            document.getElementById("vermarca").value=data.marca;  
            document.getElementById("verprecio").value=data.precio;  
            document.getElementById("verpeso").value=data.peso; 
        });
    })

    var productos = @json($productos);
    var urlProductos = "{{ url('producto') }}";


    var table = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5, 6, 7], 'Productos', function() {}, true, true, false);

    $('#buscador').keyup(function(e) {
        table.search(e.target.value).draw();
    });
    var viewbtn = true ;
    var editbtn = true ;
    var deletetn = true ;

    @php
	$rol = Auth::user()->rol_id;
    if($rol != 1 )
	@endphp

    @if($rol != 1  )
        editbtn = false ;
        deletetn = false ;
    @endif
    
    

    listarOnTable(table, productos, 0, [], viewbtn, editbtn, deletetn, urlProductos, false, []);
</script>


@endsection
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
        <h5>Listado de Clientes</h5>
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
            <a href="{{url('cliente/create')}}" class="btn btn-primary">
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
                        <th class="w-80px">Nombres</th>
                        <th class="w-80px">Apellidos</th>
                        <th class="w-80px">Direccion</th>
                        <th class="w-80px">Tipo Documento</th>                        
                        <th class="w-80px">Nro Documento</th> 
                        <th class="w-80px">Email</th>
                        <th class="w-80px">Telefono</th> 
                        <th class="w-80px">Id Usuario</th> 
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
                        <h1 class="modal-title fs-5" id="mimodalLabel">Ver Cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="nombres" class="col-form-label">Nombres:</label>
                                    <input type="text" class="form-control " id="vernombres" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="apellidos" class="col-form-label">Apellidos:</label>
                                    <input type="text" class="form-control " id="verapellidos" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="dni" class="col-form-label">Direccion:</label>
                                    <input type="text" class="form-control" id="verdireccion" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-6 mb-5">
                                    <label for="email" class="col-form-label">Email:</label>
                                    <input type="text" class="form-control" id="veremail" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-5">
                                    <label for="telefono" class="col-form-label">Telefono:</label>
                                    <input type="text" class="form-control" id="vertelefono" readonly>
                                </div>
                                 
                                <div class="col-sm-6 col-lg-4 mb-5">
                                    <label for="tipodocumento" class="col-form-label">Tipo Documento:</label>
                                    <input type="text" class="form-control" id="vertipodocumento" readonly>
                                </div>

                                <div class="col-sm-6 col-lg-4 mb-5">
                                    <label for="nrodocumento" class="col-form-label">Nro Documento:</label>
                                    <input type="text" class="form-control" id="vernumerodocumento" readonly>
                                </div>
                                <div class="col-sm-6 col-lg-4 mb-5">
                                    <label for="user" class="col-form-label">Id Usuario:</label>
                                    <input type="text" class="form-control" id="veriduser" readonly>
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
        var urlregistro = "{{ url('cliente/show') }}";
        $.get(urlregistro + '/' + id, function(data) {
            
            const modalTitle = mimodal.querySelector('.modal-title')
            modalTitle.textContent = `Ver Registro ${id}` 
            document.getElementById("vernombres").value=data.nombres;  
            document.getElementById("verapellidos").value=data.apellidos;  
            document.getElementById("verdireccion").value=data.direccion;  
            document.getElementById("veremail").value=data.email;  
            document.getElementById("vertelefono").value=data.telefono;    
            document.getElementById("vertipodocumento").value=data.tipodocumento;  
            document.getElementById("vernumerodocumento").value=data.numerodocumento;    
            document.getElementById("veriduser").value=data.iduser;    
        });




    })


    var clientes = @json($clientes);
    var urlclientes = "{{ url('cliente') }}";


    var table = defineTable($('#listado'), [], [0, 1, 2, 3, 4, 5,6], 'clientes', function() {}, true, true, false);

    $('#buscador').keyup(function(e) {
        table.search(e.target.value).draw();
    });
    var viewbtn = true ;
    var editbtn = true ;
    var deletetn = true ;

    @php
	$rol = Auth::user()->rol_id;
	@endphp

    @if($rol != 1  )
        deletetn = false ;
    @endif
    listarOnTable(table, clientes, 0, [],  viewbtn, editbtn, deletetn, urlclientes, false, []);
</script>


@endsection
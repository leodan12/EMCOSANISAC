@extends('layout.base')
@section('page-info')

<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

<!-- mostramos el mensaje despues de hacer un cambio en los resgistros-->
<script src="{{ asset('mensaje.js') }}"> </script>

@endsection
@section('container')

<div class="card">
    <div class="card-body">
        <div class="p-3">
            <h1 class="anchor fw-bolder">
                Nuevo Personal
            </h1>
            @if (session()->has('respuesta')) {{-- comprueba si existe el valor en sesión --}}
            <script>
                mensaje("{{session('respuesta')}}");
            </script>

            {!! session()->forget('respuesta') !!} {{-- borrar el error de sesión --}}
            @endif
        </div>
        <div class="p-4">
            <div class="rounded border p-10">
                <Form method="POST" action="{{ url('personal/store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="nombres" class="required form-label">Nombres</label>
                            <input type="text" placeholder=" ingrese nombres" name="nombres" id="nombres" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="apellidos" class="required form-label">Apellidos</label>
                            <input type="text" step=0.1 placeholder=" Ingrese apellidos" name="apellidos" id="apellidos" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="dni" class="required form-label">DNI </label>
                            <input type="text" placeholder=" Ingrese dni" name="dni" id="dni" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="email" class="required form-label">Email</label>
                            <input type="email" step=0.01 placeholder=" Ingrese email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="telefono" class="required form-label">Telefono</label>
                            <input type="text" placeholder=" ingrese telefono" name="telefono" id="telefono" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="puesto" class="required form-label">Puesto </label>
                            <input type="text" placeholder=" Ingrese puesto" name="puesto" id="puesto" class="form-control" required>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">
                        <i class="far fa-check-circle"></i>
                        Aceptar
                    </button>
                    <a href="{{url('personal/index')}}" type="button" class="btn btn-light">
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

@endsection
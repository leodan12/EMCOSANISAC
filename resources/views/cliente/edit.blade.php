@extends('layout.base')

@section('container')

<div class="card">
    <div class="card-body">
        <div class="p-3">
            <h1 class="anchor fw-bolder">
                Editar Cliente
            </h1>
        </div>
        <div class="p-4">
            <div class="rounded border p-10">
                <Form method="POST" action="{{ url('cliente/update',$cliente->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="nombres" class="required form-label">Nombres</label>
                            <input type="text" placeholder=" ingrese nombres" name="nombres" id="nombres" class="form-control" required value="{{$cliente->nombres}}">
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="apellidos" class="required form-label">Apellidos</label>
                            <input type="text" step=0.1 placeholder=" Ingrese apellidos" name="apellidos" id="apellidos" class="form-control" required value="{{$cliente->apellidos}}">
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="direccion" class="required form-label">Direccion </label>
                            <input type="text" placeholder=" Ingrese direccion" name="direccion" id="direccion" class="form-control" required value="{{$cliente->direccion}}">
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="email" class="required form-label">Email</label>
                            <input type="email" step=0.01 placeholder=" Ingrese email" name="email" id="email" class="form-control" required value="{{$cliente->email}}" >
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="telefono" class="required form-label">Telefono</label>
                            <input type="text" placeholder=" ingrese telefono" name="telefono" id="telefono" class="form-control" required value="{{$cliente->telefono}}">
                        </div> 
                        
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="rol_id" class="required form-label">Tipo Documento </label>
                            <select class="required form-select" name="tipodocumento" id="tipodocumento">
                                <option selected disabled>Seleccione un Tipo de Documento</option>
                                @if($cliente->tipodocumento == 'DNI'   ) 
                                <option selected value="DNI">DNI</option>
                                <option  value="RUC">RUC</option>
                                @else
                                <option selected value="RUC">RUC</option>
                                <option  value="DNI">DNI</option>
                                @endif
                            </select>
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="numerodocumento" class="required form-label">Nro Documento </label>
                            <input type="text" placeholder=" Ingrese numero documento" name="numerodocumento" id="numerodocumento" class="form-control" required value="{{$cliente->numerodocumento}}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="far fa-check-circle"></i>
                        Aceptar
                    </button>
                    <a href="{{url('cliente/index')}}" type="button" class="btn btn-light">
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
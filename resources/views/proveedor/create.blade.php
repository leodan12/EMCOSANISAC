@extends('layout.base')

@section('container')

<div class="card">
    <div class="card-body">
        <div class="p-3">
            <h1 class="anchor fw-bolder">
                Nuevo Proveedor
            </h1>
        </div>
        <div class="p-4">
            <div class="rounded border p-10">
                <Form method="POST" action="{{ url('proveedor/store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="proveedor" class="required form-label">proveedor</label>
                            <input type="text" placeholder=" ingrese proveedor" name="proveedor" id="proveedor" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="direccion" class="required form-label">direccion</label>
                            <input type="text" step=0.1 placeholder=" Ingrese direccion" name="direccion" id="direccion" class="form-control" required>
                        </div>
                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="email" class="required form-label">email</label>
                            <input type="email" step=0.01 placeholder=" Ingrese email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="col-sm-6 col-lg-6 mb-5">
                            <label for="telefono" class="required form-label">telefono</label>
                            <input type="number" placeholder=" ingrese telefono" name="telefono" id="telefono" class="form-control" required>
                        </div> 
                        <div class="col-sm-12 col-lg-12 mb-5">
                            <label for="descripcion" class="required form-label">Descripcion </label>
                            <input type="text" placeholder=" Ingrese descripcion" name="descripcion" id="descripcion" class="form-control" required>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">
                        <i class="far fa-check-circle"></i>
                        Aceptar
                    </button>
                    <a href="{{url('proveedor/index')}}" type="button" class="btn btn-light">
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
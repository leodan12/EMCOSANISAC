@extends('layout.base')

@section('container')

<div class="card">
    <div class="card-body">
        <div class="p-3">
            <h1 class="anchor fw-bolder">
                Editar Producto
            </h1>
        </div>
        <div class="p-4">
            <div class="rounded border p-10">
                <Form method="POST" action="{{ url('producto/update',$producto->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="producto" class="required form-label">Producto</label>
                            <input type="text" placeholder=" ingrese producto" name="producto" id="producto" class="form-control" required value="{{$producto->producto}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="descripcion" class="required form-label">Categoria </label>
                            <select class="required form-select" name="categoria_id" id="categoria_id" >
                            <option selected disabled>Seleccione una categoria</option>
                            @foreach($categorias as $item)
                            <option value="{{$item->id}}"  {{$item->id==$producto->categoria_id ? 'selected':''}}>{{$item->categoria}}</option>
                             @endforeach
                        </select>
                        </div>
                        
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="precio" class="required form-label">Precio</label>
                            <input type="number" step=0.1 placeholder=" Ingrese precio" name="precio" id="precio" class="form-control" required value="{{$producto->precio}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="peso" class="required form-label">Peso</label>
                            <input type="number" step=0.01 placeholder=" Ingrese Peso" name="peso" id="peso" class="form-control" required value="{{$producto->peso}}">
                        </div>

                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="marca" class="required form-label">Marca</label>
                            <input type="text" placeholder=" ingrese marca" name="marca" id="marca" class="form-control" required value="{{$producto->marca}}">
                        </div>
                        <div class="col-sm-6 col-lg-4 mb-5">
                            <label for="codigo" class="required form-label">Codigo</label>
                            <input type="text" placeholder=" ingrese codigo" name="codigo" id="codigo" class="form-control" required value="{{$producto->codigo}}">
                        </div>
                        <div class="col-sm-12 col-lg-12 mb-5">
                            <label for="descripcion" class="required form-label">Descripcion </label>
                            <input type="text" placeholder=" Ingrese descripcion" name="descripcion" id="descripcion" class="form-control" required value="{{$producto->descripcion}}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="far fa-check-circle"></i>
                        Aceptar
                    </button>
                    <a href="{{url('producto/index')}}" type="button" class="btn btn-light">
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
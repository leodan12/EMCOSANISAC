@extends('layout.base')

@section('container')

<div class="card">
    <div class="card-body">
        <div class="p-3">
            <h1 class="anchor fw-bolder">
                Editar Inventario
            </h1>
        </div>
        <div class="p-4">
            <div class="rounded border p-10">
                <Form method="POST" action="{{ url('inventario/update',$inventario->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-lg-6 mb-5">
                            <label for="producto" class="required form-label">Producto </label>
                            <select class="required form-select" name="producto_id" id="producto_id" disabled>
                                <option selected disabled>Seleccione un producto</option>
                                @foreach($productos as $item)
                                <option value="{{$item->id}}" {{$item->id==$inventario->producto_id ? 'selected':''}}>{{$item->producto}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-6 mb-5">
                            <label for="stock" class="required form-label">Stock </label>
                            <input type="number" placeholder=" ingrese stock" name="stock" id="stock" class="form-control" required value="{{$inventario->stock}}">
                        </div> 
                        <div class="col-sm-12 col-lg-12 mb-5">
                            <label for="ubicacion" class="required form-label">Ubicacion </label>
                            <input type="text" placeholder=" Ingrese ubicacion" name="ubicacion" id="ubicacion" class="form-control" required value="{{$inventario->ubicacion}}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" value="Guardar" id="Guardar">
                        <i class="far fa-check-circle"></i>
                        Aceptar
                    </button>
                    <a href="{{url('inventario/index')}}" type="button" class="btn btn-light">
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

<script type="text/javascript">
    $(document).ready(function() {

    @php
	$rol = Auth::user()->rol_id;
	@endphp
    @if($rol != 1  )
    $("#stock").attr("disabled","true");

    @endif

    $('#Guardar').click(function() {
            
            $("#stock").removeAttr("disabled"); 

        });

    });

</script>
@endsection
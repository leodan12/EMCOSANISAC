@extends('layout.base')
 


@section('container')
<br>
                <div >
					 
					<a href="{{url('/')}}">
						<img alt="Logo" src="{{ asset('media/img/logoemcosani.jpg') }}" class="h-300px  " /> 
					</a>
					 
				</div>

           
 
@endsection


@section('script')
@include('helpers.data-managment')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />


 
@endsection
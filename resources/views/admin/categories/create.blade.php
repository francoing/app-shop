@extends('layouts.app')

@section('title','Bienvenidos a App Shop')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');"></div>

<div class="main main-raised">
	<div class="container">
		

		<div class="section ">
			<h2 class="title text-center">Registrar nueva categoria</h2>

			<!-- este if me hace que me aparezca un mensaje cuando un no se completa un campo o campos por 
			defecto los muestra en ingles pero se los puede personalizar en el controlador en la parte donde se 
			almacena el producto en la funcion store agregando un objeto $message -->
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach($errors->all() as $error)
					<li>
						{{$error}}
					</li>
					@endforeach
				</ul>
			</div>

			@endif

			<form action="{{url('/admin/categories')}}" method="post" enctype="multipart/form-data">

				{{csrf_field() }}
		<div class="row">
				<div class="col-sm-6">
					<div class="form-group label-floating">
						<label class="control-label">Nombre de la categoria</label>
						<input type="text" class="form-control" name="name" value="{{old('name') }}">
					</div>
				</div>

				<div class="col-sm-6">
						
							<label class="control-label">Imagen  de la categoria</label>
							<input type="file"  name="image">
						
					</div>

				
		</div>

				
					<div class="form-group label-floating">
						<label class="control-label">Descripcion corta</label>
						<input type="text" class="form-control" name="description"value="{{old('descripction')}}">
					</div>
			

				<textarea class="form-control" placeholder="Descripcion de la categoria" rows="5" name="description">
					{{old('descripction')}}
		
				</textarea>

				<button class="btn btn-primary">Registrar categoria</button>

				<a href="{{url('/admin/categories')}}"class="btn btn-default">Cancelar</a>

			</form>

		</div>


		
	</div>

</div>
@include('includes.footer')
@endsection

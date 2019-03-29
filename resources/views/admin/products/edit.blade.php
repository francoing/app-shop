@extends('layouts.app')

@section('title','Bienvenidos a App Shop')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');"></div>

	<div class="main main-raised">
		<div class="container">
			

			<div class="section ">
				<h2 class="title text-center">Editar producto seleccionado</h2>

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


			<form action="{{url('/admin/products/'.$product->id.'/edit')}}" method="post">

				{{csrf_field() }}
					<div class="row">
							<div class="col-sm-6">
								<div class="form-group label-floating">
									<label class="control-label">Nombre del producto</label>
									<!--aqui con old hacemos que el nombre que se puso mal aparezca de nuevo y se lo corrija y entonces guardamos el nuevo valor para 
									name con el otro campo-->
									<input type="text" class="form-control" name="name" value="{{old('name',$product->name)}}">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group label-floating">
									<label class="control-label">Precio del producto</label>
									<input type="number" step="0.01" class="form-control" name="price" value="{{old('price',$product->price)}}">
								</div>
							</div>
					</div>

					<div class="row">
							<div class="col-sm-6">
									<div class="form-group label-floating">
											<label class="control-label">Descripcion corta</label>
											<input type="text" class="form-control" name="description"value="{{old('descripction')}}">
									</div>
							</div>
		
							<div class="col-sm-6">
								<div class="form-group label-floating">
									<label for=""class="control-label">Categoria del producto</label>
									<select name="category_id" class="form-control"  >
										<option value="0">General</option>
		
											@foreach ($categories as $category)
											
												<option value="{{$category->id}}" 	@if ($category->id== old('category_id',$product->category_id))
																						selected
																					@endif>{{$category->name}}</option>
		
											@endforeach
		
									</select>
								</div>
							</div>
					</div>
							
					<textarea class="form-control" placeholder="Descripcion extensa del producto" rows="5" name="long_description" >"{{$product-> long_description}} "</textarea>

					<button class="btn btn-primary">Guardar cambios</button>
					<a href="{{url('/admin/products')}}"class="btn btn-default">Cancelar</a>
				
			</form>

		</div>
		
	</div>

</div>

@include('includes.footer')
@endsection

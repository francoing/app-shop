@extends('layouts.app')

@section('title','Bienvenidos a '. config('app.name'))

@section('body-class','landing-page')

@section('styles')
		<style>
			.team .row .col-md-4{
				margin-bottom: 5em; /*significa que son 16px*/
			}
			.team .row{
				display:-webkit-box;
				display:-webkit-flex;
				display:-ms-flexbox;
				display:flex;
				flex-wrap: wrap;
			}
			.team .row > [class*='col-']{
				display: flex;
				flex-direction:column;
			}
			.tt-query {
					-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
					-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
					box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
					}

					.tt-hint {
					color: #999
					}

					.tt-menu {    /* used to be tt-dropdown-menu in older versions */
					width: 222px;
					margin-top: 4px;
					padding: 4px 0;
					background-color: #fff;
					border: 1px solid #ccc;
					border: 1px solid rgba(0, 0, 0, 0.2);
					-webkit-border-radius: 4px;
					-moz-border-radius: 4px;
					border-radius: 4px;
					-webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
					-moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
					box-shadow: 0 5px 10px rgba(0,0,0,.2);
					}

					.tt-suggestion {
					padding: 3px 20px;
					line-height: 24px;
					}

					.tt-suggestion.tt-cursor,.tt-suggestion:hover {
					color: #fff;
					background-color: #0097cf;

					}

					.tt-suggestion p {
					margin: 0;
					}

		</style>

@endsection

@section('content')
<div class="header header-filter" style="background-image: url('https://images.unsplash.com/photo-1423655156442-ccc11daa4e99?crop=entropy&dpr=2&fit=crop&fm=jpg&h=750&ixjsv=2.1.0&ixlib=rb-0.3.5&q=50&w=1450');">
            <div class="container">
                <div class="row">
					<div class="col-md-6">
						<h1 class="title">Bienvenidos a {{config('app.name')}}.</h1>
	                    <h4>
							Realiza pedidos en linea y te contactaremos para coordinar la entrega.
						</h4>

	                    <br />
	                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-danger btn-raised btn-lg">
							<i class="fa fa-play"></i>¿Como funciona?
						</a>
					</div>
                </div>
            </div>
        </div>

		<div class="main main-raised">
			<div class="container">
		    	<div class="section text-center section-landing">
	                <div class="row">
	                    <div class="col-md-8 col-md-offset-2">
						<h2 class="title">¿Por que {{config('app.name')}}?</h2>
	                        <h5 class="description">Puedes revisar nuestra relacion completa de productos, comparar precios y realizar tus pedidos cuando estes seguro.</h5>
	                    </div>
	                </div>

					<div class="features">
						<div class="row">
		                    <div class="col-md-4">
								<div class="info">
									<div class="icon icon-primary">
										<i class="material-icons">chat</i>
									</div>
									<h4 class="info-title">Atendemos tus dudas</h4>
									<p>This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn't scroll to get here..</p>
								</div>
		                    </div>
		                    <div class="col-md-4">
								<div class="info">
									<div class="icon icon-success">
										<i class="material-icons">verified_user</i>
									</div>
									<h4 class="info-title">Pago seguro</h4>
									<p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
								</div>
		                    </div>
		                    <div class="col-md-4">
								<div class="info">
									<div class="icon icon-danger">
										<i class="material-icons">fingerprint</i>
									</div>
									<h4 class="info-title">Informacion privada</h4>
									<p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
								</div>
		                    </div>
		                </div>
					</div>
	            </div>

	        	<div class="section text-center">
					<h2 class="title">Categorias disponibles</h2>
					
						<form method="GET" action="{{url('/search')}}"  class="form-inline">
							<input type="text" value="" placeholder="¿Que estas buscando?" class="form-control" name="query" id="search">
								<button type="submit" class="btn btn-primary btn-just-icon">
									<i class="material-icons">search</i>

								</button>
						</form>


					<div class="team">
						<div class="row">

							@foreach($categories as $category )
							<div class="col-md-4">
			                    <div class="team-player">

			                        <img src="{{ $category->featured_image_url }}" alt="Imagen representativa de la categoria:{{$category->name}}" class="img-raised img-circle">
			                        <h4 class="title">
									<a href="{{url('/categories/'.$category->id)}}">{{$category->name}}</a>
										<br />
									</h4>
			                        <p class="description">{{$category->description}}</p>
									
			                    </div>
							</div>
							@endforeach
			                
						</div>
											
					</div>

	            </div>


	        	<div class="section landing-section">
	                <div class="row">
	                    <div class="col-md-8 col-md-offset-2">
	                        <h2 class="text-center title">¿Aun no te has registrado?</h2>
							<h4 class="text-center description">Divide details about your product or agency work into parts. Write a few lines about each one and contact us about any further collaboration. We will responde get back to you in a couple of hours.</h4>
						<form class="contact-form" method="GET" action="{{url('/register')}}">
	                            <div class="row">
	                                <div class="col-md-6">
										<div class="form-group label-floating">
											<label class="control-label">Tu nombre</label>
											<input type="name" class="form-control">
										</div>
	                                </div>
	                                <div class="col-md-6">
										<div class="form-group label-floating">
											<label class="control-label">Tu correo</label>
											<input type="email" class="form-control">
										</div>
	                                </div>
	                            </div>

	                            <div class="row">
	                                <div class="col-md-4 col-md-offset-4 text-center">
	                                    <button class="btn btn-primary btn-raised">
											Iniciar registro
										</button>
	                                </div>
	                            </div>
	                        </form>
	                    </div>
	                </div>

	            </div>
	        </div>

		</div>

		@include('includes.footer')

		@section('scripts')

			<script src="{{asset('/js/typeahead.bundle.min.js')}}">	</script>
			<script>
					$(function () {
						//inicializamos typeahead sobre nuestro input de busqueda
						var products = new Bloodhound({
						datumTokenizer: Bloodhound.tokenizers.whitespace,
						queryTokenizer: Bloodhound.tokenizers.whitespace,
						prefetch:'{{url('/products/json')}}'
						});

						$('#search').typeahead({


							hint: true,
							highlight: true,
							minLength: 1

						},{
							name: 'products',
  							source: products
						});
					});
			
			</script>
		@endsection

@endsection

@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Editar Etiqueta</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.tags.index') }}">Etiquetas</a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        	<form action="{{ route('admin.tags.update',$tag->id) }}" method="POST">
        		@csrf
				@method('PUT')
	            <div class="row">
	            	
	                <div class="col-md-8">
	                    <div class="card card-primary card-outline table-responsive">
	                    	<div class="card-body">
								
								<div class="form-group">
                    				<label>Nombre de la etiqueta</label>
									<input type="text" class="form-control basic-usage {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name" value="{{ old('name', $tag->name) }}" placeholder="Ingrese aquí el titulo de la etiqueta">
									{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
									 
                    			</div>

                    			<div class="form-group">
                    				<label>Url Amigable</label>
									<input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : ''}}" name="slug" id="permalink" value="{{ old('slug', $tag->slug) }}">
									{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
                    			</div>

                                <div class="form-group">
	                				<button type="submit" class="btn btn-primary btn-block">Actualizar Etiqueta</button>
	                			</div>

								
							</div>
	                    </div>
	                </div>
	            </div>
	            <!-- /.row -->
        	</form>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection


@push('scripts')

	<script src="{{ asset('/adminlte/plugins/string-url-slug/speakingurl.min.js') }}"></script>
	<script src="{{ asset('/adminlte/plugins/string-url-slug/jquery.stringtoslug.min.js') }}"></script>

    <script>
    	$(document).ready( function() {
		    $(".basic-usage").stringToSlug();
		});
    </script>
	
@endpush



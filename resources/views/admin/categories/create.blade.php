@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nueva Categoria</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
                        <li class="breadcrumb-item active">Crear</li>
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
        	<form action="{{ route('admin.categories.store') }}" method="POST">
        		@csrf
	            <div class="row">
	            	
	                <div class="col-md-8">
	                    <div class="card card-primary card-outline table-responsive">
	                    	<div class="card-body">
								
								<div class="form-group">
                    				<label>Nombre de la etiqueta</label>
									<input type="text" class="form-control basic-usage {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name" value="{{ old('name') }}" placeholder="Ingrese aquí el titulo de la etiqueta">
									{!! $errors->first('name', '<small class="text-danger">:message</small>') !!} 
                    			</div>

                    			<div class="form-group">
                    				<label>Url Amigable</label>
									<input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : ''}}" name="slug" id="permalink" value="{{ old('slug') }}">
									{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
                    			</div>

                                <div class="form-group">
									<label>Descripción de la categoria</label>
									<textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" id="editor" placeholder="Descripción de la categoria">{{ old('body') }}</textarea>
									{!! $errors->first('body', '<small class="text-danger">:message</small>') !!}
								</div>

                                <div class="form-group">
	                				<button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
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

@push('styles')
    <style>
		.ck-editor__editable_inline {
		    min-height: 150px;
		}
	</style>
@endpush

@push('scripts')
	
	<script src="{{ asset('/adminlte/plugins/string-url-slug/speakingurl.min.js') }}"></script>
	<script src="{{ asset('/adminlte/plugins/string-url-slug/jquery.stringtoslug.min.js') }}"></script>

    <script src="{{ asset('/adminlte/plugins/ckeditor/ckeditor.js') }}"></script> 
    <script>
        ClassicEditor
	        .create( document.querySelector( '#editor' ) )
	        .then( editor => {
	                //console.log( editor );
	        } )
	        .catch( error => {
	                console.error( error );
	        } );
    </script>

    <script>
    	$(document).ready( function() {
		    $(".basic-usage").stringToSlug();
		});
    </script>
	
	@if (Session::has('success'))
		<script>
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Correcto!',
				text: '{{ Session::get('success') }}',
				showConfirmButton: false,
				timer: 3000
			})
		</script>
	@endif
@endpush



@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nuevo Post</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
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
        	<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        		@csrf
	            <div class="row">
	            	
	                <div class="col-md-7">
	                    <div class="card card-primary card-outline table-responsive">
	                    	<div class="card-body">
								
								<div class="form-group">
                    				<label>Titulo de la publicación</label>
                    				<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
									<input type="text" class="form-control basic-usage {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" id="name" value="{{ old('name') }}" placeholder="Ingrese aquí el titulo de la publicación">
									{!! $errors->first('name', '<small class="text-danger">:message</small>') !!}
									 
                    			</div>

                    			<div class="form-group">
                    				<label>Url Amigable</label>
									<input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : ''}}" name="slug" id="permalink" value="{{ old('slug') }}">
									{!! $errors->first('slug', '<small class="text-danger">:message</small>') !!}
                    			</div>

								<div class="form-group">
									<label>Etiquetas</label>
									<select name="tags[]" 
										id="tags" 
										class="selectT form-control {{ $errors->has('tags') ? 'is-invalid' : ''}}" multiple="multiple" 
										data-placeholder="Seleciona una o mas etiquetas" 
										style="width: 100%;">
									   @foreach($tags as $tag)
										<option {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }} value="{{ $tag->id }}">{{ $tag->name }}</option>
									   @endforeach
									</select>
									{!! $errors->first('tags', '<small class="text-danger">:message</small>') !!}
							   	</div>

							   	<div class="form-group">
									<label>Contenido completo de la publicación</label>
									<textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}" id="editor" placeholder="Contenido completo de la publicación">{{ old('body') }}</textarea>
									{!! $errors->first('body', '<small class="text-danger">:message</small>') !!}
								</div>

							</div>
	                    </div>
	                </div>

	                <div class="col-md-5">
	                    <div class="card card-primary card-outline table-responsive">
	                    	<div class="card-body">
	                    		<div class="form-group">
	                    			<label>Fecha de publicación</label>
					                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
					                    <input type="text" name="published_at" value="{{ old('published_at') }}" class="form-control datetimepicker-input {{ $errors->has('published_at') ? 'is-invalid' : ''}}" data-target="#datetimepicker4"/>
					                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
					                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
					                    </div>
					                </div>
									{!! $errors->first('published_at', '<small class="text-danger">:message</small>') !!}
					            </div>
				                <div class="form-group">
				                	<label for="category_id">Categorías</label>
					                <select name="category_id" id="category_id" class="form-control select2 {{ $errors->has('category_id') ? 'is-invalid' : ''}}" style="width: 100%;">
					                	<option></option>
					                    @foreach($categories as $category)
				                			<option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
				                		@endforeach
					                </select>
									{!! $errors->first('category_id', '<small class="text-danger">:message</small>') !!}
				                </div>

								<div class="form-group">
                    				<label>Imagen</label>
									<input type="file" class="form-control" name="foto" id="foto" onchange="previewImage()">
									<img id="preview" style="max-width: 100px; margin-top: 20px;">
                    			</div>
				               
	                			<div class="form-group">
	                				<label>Extracto de la publicación</label>
									<textarea name="excerpt" class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : ''}}" rows="2" placeholder="Extracto de la publicación">{{ old('excerpt') }}</textarea>
									{!! $errors->first('excerpt', '<small class="text-danger">:message</small>') !!}
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
	<link rel="stylesheet" href=" {{ asset('/adminlte/plugins/datepicker/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href=" {{ asset('/adminlte/plugins/select2/select2.min.css') }}">

    <style>
		.ck-editor__editable_inline {
		    min-height: 150px;
		}
	</style>
@endpush

@push('scripts')
	<script src="{{ asset('/adminlte/plugins/datepicker/moment.js') }}"></script>
	<script src="{{ asset('/adminlte/plugins/datepicker/tempusdominus-bootstrap-4.min.js') }}"></script>
	<script src="{{ asset('/adminlte/plugins/datepicker/es.js') }}"></script>
	
	<script src="{{ asset('/adminlte/plugins/string-url-slug/speakingurl.min.js') }}"></script>
	<script src="{{ asset('/adminlte/plugins/string-url-slug/jquery.stringtoslug.min.js') }}"></script>

    <script src="{{ asset('/adminlte/plugins/select2/select2.full.min.js') }}"></script>

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
	  $(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2({
		    placeholder: "-- Seleccine una categoria --",
		    allowClear: true,
		    language: "es",
			theme: "classic"
		});

		$('.selectT').select2();
    
	  })
	</script>
	<script>
        $(function () {
            $('#datetimepicker4').datetimepicker({
                format: 'L',
                locale: 'es'
            });
        });
    </script>
    <script>
    	$(document).ready( function() {
		    $(".basic-usage").stringToSlug();
		});
    </script>
	<script>
		function previewImage()
    	{
    		var file = document.getElementById('foto').files;
    		if(file.length > 0)
    		{
    			var fileReader = new FileReader();
    			fileReader.onload = function(event){
    				//$('#previewImg').attr('src',reader.result);
    				document.getElementById('preview').setAttribute("src", event.target.result);
    			}
    			fileReader.readAsDataURL(file[0]);
    		}
    	}
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



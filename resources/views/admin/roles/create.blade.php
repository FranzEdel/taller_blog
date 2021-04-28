@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Nuevo Rol</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Roles y Permisos</a></li>
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
            {!! Form::open(['route' => 'admin.roles.store']) !!}
                @include('admin.roles.partials.form')
            {!! Form::close() !!}
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



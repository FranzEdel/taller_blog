@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Destaller de la Categoria: {{ $category->name }}</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Posts</a></li>
                        <li class="breadcrumb-item active">Detalle</li>
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
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-body">
                            
                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Nombre de la categoria: </label>
                                <p>{{ $category->name }}</p>
                                    
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Descrioción de la categoria: </label>
                                {!! $category->body !!}
                            </div>

                            <div class="form-group">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">Todas las Categorias</a>
                                <a href="{{ route('admin.categories.edit',$category->id) }}" class="btn btn-success btn-sm">Editar</a>
                                <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection




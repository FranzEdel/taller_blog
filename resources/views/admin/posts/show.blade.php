@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Destaller del Post: {{ $post->name }}</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
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
                                <label class="col-sm-5 col-form-label">Titulo de la publicación: </label>
                                <p>{{ $post->name }}</p>
                                    
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Fecha de publicación: </label>
                                <p>{{ $post->published_at }}</p>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label" for="category_id">Categorías: </label>
                                {{ $post->category->name }}
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Contenido completo de la publicación: </label>
                                {!! $post->body !!}
                            </div>

                           

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-primary card-outline table-responsive">
                        <div class="card-body">
                            <div class="form-group">
                                <img src="{{ asset('img') }}/{{ $post->foto }}" style="max-width: 270px; margin-top: 5px;">
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-5 col-form-label">Etiquetas: </label>
                                <ul>
                                    @foreach($post->tags as $tag)
                                    <li>{{ $tag->name }}</li>
                                    @endforeach
                                </ul>
                                
                            </div>

                            <div class="form-group">
                                @can('admin.posts.index')
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary btn-sm">Todos los Post</a>
                                @endcan
                                @can('admin.posts.edit')
                                <a href="{{ route('admin.posts.edit',$post->id) }}" class="btn btn-success btn-sm">Editar</a>
                                @endcan
                                @can('admin.posts.destroy')
                                <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                                @endcan
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




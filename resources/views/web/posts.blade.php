@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
    <h1>Lista de Articulos</h1>

    @foreach ($posts as $post)
        <div class="card">
          <div class="card-header">
            {{ $post->name }}
          </div>
          <div class="card-body">
            @if($post->foto)
            <img src="{{ $post->foto }}" class="img-responsive">
            @endif
            {{ $post->excerpt }}
            <a href="#" class="pull-right">Leer más</a>
          </div>
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
    {!! $posts->links() !!}
    </div>
  </div>
@endsection
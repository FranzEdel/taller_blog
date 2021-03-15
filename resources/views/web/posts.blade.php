@extends('layouts.plantilla')

@section('content')
@foreach($posts as $post)
  <section class="posts container">
      <article class="post w-image">
          <div class="content-post">
              <header class="container-flex space-between">
                  <div class="date">
                      <span class="c-gray-1">sep 18</span>
                  </div>
                  <div class="post-category">
                      <span class="category text-capitalize">{{ $post->category->name }}</span>
                  </div>
              </header>
              
              <h1>{{ $post->name }}</h1>
              @if ($post->foto)
              <figure><img src="{{ $post->foto }}" alt="" class="img-responsive"></figure>
              @endif
              <div class="divider"></div>
              <p>{{ $post->excerpt }}</p>
              <footer class="container-flex space-between">
                  <div class="read-more">
                      <a href="#" class="text-uppercase c-green">Leer mas</a>
                  </div>
                  <div class="tags container-flex">
                  @foreach($post->tags as $tag)
                      <span class="tag c-gray-1 text-capitalize">#{{ $tag->name }}</span>
                      <!-- <span class="tag c-gray-1 text-capitalize">#peak</span>
                      <span class="tag c-gray-1 text-capitalize">#photo</span> -->
                  @endforeach
                  </div>
              </footer>
          </div>
      </article>
  </section><!-- fin del div.posts.container -->
  @endforeach
@endsection
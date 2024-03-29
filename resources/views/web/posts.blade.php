@extends('layouts.plantilla')

@section('content')
@foreach($posts as $post)
  <section class="posts container">
      <article class="post w-image">
          <div class="content-post">
              <header class="container-flex space-between">
                  <div class="date">
                      <span class="c-gray-1">{{ $post->published_at->format('M d') }}</span>
                  </div>
                  <div class="post-category">
                    <a href="{{ route('category', $post->category->slug) }}">
                      <span class="category text-capitalize">{{ $post->category->name }}</span>
                    </a>
                  </div>
              </header>
              
              <h1>{{ $post->name }}</h1>
              @if ($post->foto)
                <figure>
                  <img src="{{ asset('img')}}/{{ $post->foto }}" alt="" class="img-responsive">
                </figure>
              @endif
              <div class="divider"></div>
              <p>{{ $post->excerpt }}</p>
              <footer class="container-flex space-between">
                  <div class="read-more">
                      <a href="{{ route('show', $post) }}" class="text-uppercase c-green">Leer mas</a>
                  </div>
                  <div class="tags container-flex">
                  @foreach($post->tags as $tag)
                    <a href="{{ route('tag', $tag->slug) }}">
                      <span class="tag c-gray-1 text-capitalize">#{{ $tag->name }}</span>
                    </a>
                  @endforeach
                  </div>
              </footer>
          </div>
      </article>
  </section><!-- fin del div.posts.container -->
  @endforeach
@endsection
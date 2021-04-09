@extends('layouts.plantilla')

@section('content')

<article class="post image-w-text container">
    <div class="content-post">
      <header class="container-flex space-between">
        <div class="date">
          <span class="c-gris">{{ $post->published_at->format('M d') }}</span>
        </div>
        <div class="post-category">
          <a href="{{ route('category', $post->category->slug) }}">
            <span class="category">{{ $post->category->name }}</span>
          </a>
        </div>
      </header>
      <h1>{{ $post->name }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
            <figure class="block-left">
                <img src="{{ asset('img')}}/{{ $post->foto }}" style="max-width: 250px; margin-right:20px">
            </figure>
          <div>
            {!! $post->body !!}
          </div>
        </div>

        <footer class="container-flex space-between">
          <div class="buttons-social-media-share">
            <ul class="share-buttons">
              <li><a href="https://www.facebook.com/sharer/sharer.php?u=&t=" title="Share on Facebook" target="_blank"><img alt="Share on Facebook" src="{{ asset('img/flat_web_icon_set/Facebook.png') }}"></a></li>
              <li><a href="https://twitter.com/intent/tweet?source=&text=:%20" target="_blank" title="Tweet"><img alt="Tweet" src="{{ asset('img/flat_web_icon_set/Twitter.png') }}"></a></li>
              <li><a href="https://plus.google.com/share?url=" target="_blank" title="Share on Google+"><img alt="Share on Google+" src="{{ asset('img/flat_web_icon_set/Google.png') }}"></a></li>
              <li><a href="http://pinterest.com/pin/create/button/?url=&description=" target="_blank" title="Pin it"><img alt="Pin it" src="{{ asset('img/flat_web_icon_set/Pinterest.png') }}"></a></li>
            </ul>
          </div>
          <div class="tags container-flex">
            @foreach($post->tags as $tag)
            <a href="{{ route('tag', $tag->slug) }}">
              <span class="tag c-gris">#{{ $tag->name }}</span>
            </a>
            @endforeach
          </div>
      </footer>
      <div class="comments">
      <div class="divider"></div>
        <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://zendero.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                
      </div><!-- .comments -->
    </div>
  </article>

@endsection
{{-- extends --}}
@extends('theme-front.layouts.index')



{{-- section --}}
@section('content')




<section class="masthead js-masthead-height text-center pb-0">
    <div class="container">
        <div class="masthead__offset-bottom">
            <div class="row">
                
            
                <div class="col-lg-8 offset-lg-2">
                    <div class="masthead__content"></div>
                 
                        <h1 class="masthead__content-title">BLOG</h1>
                        <p class="masthead__content-subtitle">Hemos ayudado a más de 1 millon de personas a crecer 
                            profesionalmente. Estos artículos comparten concejos
                            para la búsqueda de empleo, la productividad y el éxito 
                            laboral en diferentes áreas del conocimiento.</p>
                    </div>
                </div>
            </div>
        </div>
        <img src= "{{asset ('theme-front/smooth/images/masthead-img-work.png') }}" class="masthead__content-image" alt="Masthead Image">
    </div>
</section>
 

<section class="section pt-40">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($articles as $article)
                <div class="col-lg-4 mb-4"> <!-- Cada artículo ocupa 4 columnas en una fila de 3 -->
                    <div class="article__card">
                        <div class="article__card-heading">
                            <a href="{{ route('articles.show', $article->slug) }}">
                                <h2 class="title">{{ Str::limit($article->title, 60, '...') }}</h2>
                            </a>
                            <p class="introduction">{{ Str::limit($article->introduction, 100, '...') }}</p>
                        </div>
                        <div class="article__card-image">
                            <img src="{{ asset('storage/'. $article->image) }}" class="img-fluid" alt="Image article">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
   
</section>
<div class="links-paginate d-flex justify-content-center mt-4">
    {{ $articles->links() }}
</div>

    <!-- End Section -->
    
 {{-- Back to top --}}
 <div class="back-to-top js-back-to-top" style="display: block;">
    <span class="fa fa-angle-double-up back-to-top__icon"></span>
    <span class="back-to-top__text">TOP</span>
</div>
    

@endsection


{{-- extends --}}
@extends('theme-front.layouts.index')

{{-- section --}}
@section('content')

   


<section class="row align-items-center"> 
    <div class="col-lg-4 text-center">
        <a class="btn-new-article" href="{{ route('theme-front.home')}}" >⬅Go Back</a>
        {{-- <img src="{{ $profile->photo ? asset('storage/'.$profile->photo) : asset('img/user-default.png') }}"  alt="" class="img-fluid rounded-square" style="width: 450px; height: 450px;">
         --}}
    </div>
    
    <div class="col-lg-6 order-lg-1 ">
        <div class="contact__main">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="section__heading">Mi perfil</h2>
                @if ($profile->user_id == Auth::user()->id ) 
                    <a href="{{ route('profiles.edit', $profile)}}" class="btn btn-primary">Editar Perfil</a>
                @endif
            </div>
            <div class="row content-center">
            <div class="card mb-3" style="max-width: 840px;">
                <div class="row g-0">
                  <div class="col-md-4">
                <img src="{{ $profile->photo ? asset('storage/'.$profile->photo) : asset('img/user-default.png') }}" class="img-fluid rounded-start" alt="...">
                  </div>
                  <div class="col-lg-8 order-lg-3">
                    <div class="card-body">
                      <h5 class="card-title">{{ $profile->user->full_name }}</h5>
                      <p class="card-text">{{ $profile->profession }}</p>
                      <p class="card-text">{{ $profile->about }}</p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        </div>
    </div>
</section>

 <hr>
<section class="section pt-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <h1 class="masthead__content-title">Mis artículos</h1>
            </div>
        </div>
    </div>   
</section> 
        {{-- Listar articulos --}}
 <section>      
            
    @if(count($articles) > 0)
            <div class="row justify-content-center">
                @foreach($articles as $article)
                <div class="col-lg-3 mb-2"> 
                    <div class="article__card text-center">
                        <a href="{{ route('articles.show', $article) }}">

                           
                            <h2 class="title">{{ Str::limit($article->title, 70, '...') }}</h2>
                            <p class="introduction">{{ Str::limit($article->introduction, 100, '...') }}</p>
                        </a> 
                        <div class="article__card-image">
                                <img src="{{ asset('storage/'.$article->image) }}"  class="img-fluid square">
                            </div>
                    </div>
                </div>
            @endforeach
            </div>
        @endif
    
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

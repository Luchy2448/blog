{{-- extends --}}
@extends('theme-front.layouts.index')



{{-- section --}}
@section('content')


    <!-- Start Section -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 text-center">
                    <!-- Start blog listing 01 -->
                    <div class="blog__listing blog__single-post">
                        <div class="blog__listing-thumbnail">
                            
                                <img src="{{ asset('storage/'. $article->image) }}" class="img-fluid" alt="" />
                        
                        </div>
                        <h3 class="blog__listing-title">{{ $article->title }}</h3>
                       
                        <div class="blog__listing-content">
                            <div class="blog__listing-content--text">
                                <p>{{ $article->introduction }}</p>
                                
                                 <p>{{ $article->body }}</p>

                                 <ul class="blog__listing-meta">
                                   <li>
                                        <label><i class="fa fa-user"></i> Autor: </label>
                                        {{ $article->user->full_name }}
                                                                            </li>
                                    <li>
                                        <label><i class="fa fa-calendar"></i> Publicado: </label>
                                        {{ $article->created_at }}
                                    </li>
                                    <li>
                                        <label><i class="fa fa-comments"></i> Comentarios: </label>
                                      {{ $article->comments_count }}
                                    </li>
                                </ul>
                               
                                <div class="row blog__asside-image--left">
                                    
                                  
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- End blog listing 01 -->
                </div>
            </div>          
        </div>
  </section>
<section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="col-lg-8 offset-lg-2 text-center">
                        <h1 class="masthead__content-title">Comentarios</h1>
                    </div>
                    @if(Auth::check())
                        @include('subscriber.comments.create')
                    @else
                        <p class="alert-post text-center">Para comentar debe iniciar sesión</p>
                    @endif

                    @if(session('success-error'))
                        <div class="text-danger text-center">
                            <p class="fs-5">{{ session('success-error') }}</p>
                        </div>
                    @endif

     
                </div>


                <div class="col-lg-12">
                    @include('subscriber.comments.show')
                </div>
            </div>
        </div>
    </section>
    <!-- End Section -->

   

    <!-- Start Back to top -->
    <div class="back-to-top js-back-to-top">
        <span class="fa fa-angle-double-up back-to-top__icon"></span>
        <span class="back-to-top__text">TOP</span>
    </div>
    <!-- End Back to top -->


@endsection
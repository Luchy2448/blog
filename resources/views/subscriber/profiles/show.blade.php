@extends('layouts.base')

@section('styles')
<link href="{{ asset('css/user/css/style_user.css') }}" 
rel="stylesheet" type="text/css"/> 
<link href="{{ asset('css/user/profiles/css/article_profile.css') }}" 
rel="stylesheet" type="text/css" />
@endsection

@section('title', 'Perfil')

@section('content')

<div class="btn-article">
    <a href="{{ route('home.index') }}" class="btn-new-article">⬅</a>
</div>

<div class="description-profile">

    <div class="image-profile">
        <img src="{{ $profile->photo ? asset('storage/'.$profile->photo) : asset('img/user-default.png') }}" alt="">
    </div>

    <div class="body-description-profile">
        <p>Nombre: {{ $profile->user->full_name }}</p>
        <p>Profesion: {{ $profile->profession }} </p>
        <p>Sobre mi: {{ $profile->about }}</p>
        {{-- <div class="extra">
            <!-- Enlaces de las redes sociales -->
            <a href="" target="_blank" class="social">Facebook</a>
            {{-- <a href="#" target="_blank" class="social">Twitter</a>
            <a href="#" target="_blank" class="social">Linkedin</a> 
        </div> --}}
    </div>

    <div class="edit-profile-view">
        @if ($profile->user_id == Auth::user()->id ) 
<a href="{{ route('profiles.edit', $profile)}}">Editar Perfil</a>
        @endif

    </div>
</div>


<div class="text-article">
    <h2 class="mb-5">Artículos publicados</h2>
</div>

 <!-- Listar artículos -->
 @if( count($articles) > 0)
 <div class="article-container"> 
    @foreach($articles as $article) 
    <article class="article"> 
            <img src="{{ asset('storage/'.$article->image) }}" 
    class="img"> 
    <div class="card-body"> 
            <a href="{{ route('articles.show', $article) }}"> 
                   <h2 class="title">{{ 
             Str::limit($article->title, 70, '...') }}</h2> 
            </a> 
    </div> 
    </article> 
    @endforeach 
    </div> 
    @endif

<div class="links-paginate-profile">
    {{ $articles->links() }}
    
</div>


@endsection
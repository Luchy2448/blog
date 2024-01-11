<div class="comments-content">
    {{-- {{ dd($comments) }} --}}
    @foreach ($comments as $comment)
   

 <div class="blog__comments--content">
    <div class="blog__comments--media">
        
        <div class="blog__comments--avatar">
            <img src="{{ $comment->user->profile->photo ? asset('storage/' . $comment->user->profile->photo) : asset('img/user-default.png') }}" class="img-fluid" alt="" />
        </div>
       
            <h4 class="blog__comments--content-title">{{ $comment->user->full_name }} &nbsp; &nbsp; {{ $comment->value }} ⭐</h4>
            <p>{{ $comment->description }}</p>
            <div class="text-right">{{ $comment->created_at }}</div>
        </div>

    
    @endforeach
    <hr>    
    <div class="links-paginate">
       {{ $comments->links() }}     
    </div>
</div>
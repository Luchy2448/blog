

<div class="form-content">
    <form method="POST" action="{{ route('comments.store') }}" class="form-general comments">
        @csrf

        <div class="form-group fs-5">
            

            <h4 class="blog__comments--content-title">Dejanos tu calificación</h4>
        </div>

        <p>Rating: <span class="star-rating">
            <label for="rate-1" style="--i:1"><i class="fa fa-star"></i></label>
            <input type="radio" name="value" id="rate-1" value="1">
            <label for="rate-2" style="--i:2"><i class="fa fa-star"></i></label>
            <input type="radio" name="value" id="rate-2" value="2" checked>
            <label for="rate-3" style="--i:3"><i class="fa fa-star"></i></label>
            <input type="radio" name="value" id="rate-3" value="3">
            <label for="rate-4" style="--i:4"><i class="fa fa-star"></i></label>
            <input type="radio" name="value" id="rate-4" value="4">
            <label for="rate-5" style="--i:5"><i class="fa fa-star"></i></label>
            <input type="radio" name="value" id="rate-5" value="5">
        </span></p>
        {{-- <div class="form-group rating">
            <input id="star5" name="value" type="radio" value="5" class="radio-btn hide" checked />
            <label for="star5">⭐</label>
            <input id="star4" name="value" type="radio" value="4" class="radio-btn hide" />
            <label for="star4">⭐</label>
            <input id="star3" name="value" type="radio" value="3" class="radio-btn hide" />
            <label for="star3">⭐</label>
            <input id="star2" name="value" type="radio" value="2" class="radio-btn hide" />
            <label for="star2">⭐</label>
            <input id="star1" name="value" type="radio" value="1" class="radio-btn hide" />
            <label for="star1">⭐</label>
            <div class="clear"></div> --}}

            @error('value')   

            <span class="alert-red">
                <span>{{ $message }}</span>
            </span>

            @enderror

        </div>
        
        <div class="form-group">
            <textarea class="form-control" name='description' id="description" rows="8">{{ old('description') }}</textarea>
            {{-- <textarea name='description' id="description">{{ old('description') }}</textarea> --}}
        @error('description')
            <span class="alert-red">
                <span>*{{ $message }}</span>
            </span>
        @enderror
        </div>

        <div class="form-action"><input type="hidden" name="article_id" value="{{ $article->id }}"></div>

        <input type="submit" value="Enviar comentario" class="btn btn-primary btn-rounded"> <hr>

    </form>
</div>


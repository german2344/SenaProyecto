<div class="box">
        <img src="images/quote-img.png" alt="" class="quote">
        <p>{{ $comment->description }}</p>
        @if(isset($comment->user->profile_photo_path))
        <img src="{{ $comment->user->profile_photo_path }}" alt="" class="h-17 w-17 rounded-full object-cover">
        @elseif(isset($comment->user->profile_photo_url) )
        <img src="{{ $comment->user->profile_photo_url}}" alt="" class="h-17 w-17 rounded-full object-cover">
        @endif
        <h3>{{ $comment->user->name }}</h3>
        <div class="stars">
        @for($i=1; $i<=$comment->rating; $i++)
        <label for="star{{$i}}" class="star-label"><i class="fas fa-star"></i></label>
        @endfor 

    {{--   @if($comment->user_id === auth()->user()->id)
        
        @endif --}} 
        
        </div>
</div>

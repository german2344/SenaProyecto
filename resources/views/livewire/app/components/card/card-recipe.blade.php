<div>
    <div class="box">
        <div class="image">
               <img src="{{$imgRecipeCard}}" alt="">
          </div>
          <div class="content">
            <a href="#" class="title">{{substr($recipe->name, 0, 20)}}</a>
            <span>{{ $recipe->user->name}}/ {{ $recipe->created_at->format('d/m/Y') }}</span>
            <p >{{substr($recipe->description, 0, 100)}}...</p> 
            <a href="{{route ('verRecetas',$recipe) }}" class="btn">leer mas</a>
          </div>
    </div>
</div>

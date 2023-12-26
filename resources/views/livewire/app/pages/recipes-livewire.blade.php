<div>
   <link rel="stylesheet" href="{{ asset('css/home/recetas/recetas.css')}}">
   <section class="blogs" id="blogs">
     <h1 class="heading">
       nuestras <span>recetas </span> 
      </h1>
      @can('admin.recipes.store')
      <div class="flex justify-center m-6 mx-auto w-full">
        @livewire('shared.form-recipe') 
      </div>
      @endcan
    <div class="box-container">
        @foreach($recetas as $recipe)
            <livewire:app.components.card.card-recipe :recipe="$recipe" :key="$recipe->id" lazy  />
        @endforeach
    </div> 
  </section>
</div>

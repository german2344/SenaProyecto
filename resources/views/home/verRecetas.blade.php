<x-app-layout >
    <link rel="stylesheet" href="{{asset('css/app/livewire/formRecipe.css')}}">
    <section class="text-gray-700 body-font overflow-hidden bg-white">
        <div class="cont_form_recipe container px-5 py-10 mx-auto">
            <div class="grid grid-cols-2 gap-2 imgs">
                @foreach($recetas->multimedia as $imagenes)
                <img alt="img" class="max-h-full max-w-full rounded-lg" src="{{ asset('storage/' . $imagenes->ruta) }}">
              @endforeach
            </div>
            <!--form recetas-->
            <form class="form_recipe">
                <div class=" border-gray-900/10">
                    
                        <h2 class="text-sm title-font text-gray-500 tracking-widest">NOMBRE DE LA RECETA</h2>
                        <h1 class="text-gray-700 text-3xl title-font font-medium mb-1">{{$recetas->name}}</h1>
                        <div class="flex mt-4">
                          <p>Tiempo de preparación:</p>
                            <div class="flex ml-auto">
                              <i class="fas fa-clock fa-sw m-1"></i>
                              <b >{{$recetas->preparation_time}}</b>
                            </div>
                        </div>
                        <!--description-->
                        <div class="mb-4">
                            <h2 class=" title-font  tracking-widest"><b>Descripción</b></h2>
                            <p class="leading-relaxed">{{$recetas->description}}</p>
                        </div>
                        <!-- ingredientes -->
                        <div class="mb-4">
                            <h2 class=" title-font  tracking-widest"><b>Ingredientes</b></h2>
                            <div class="ml-3">
                              @foreach($recetas->ingredients as $ingredient)
                                  <p>
                                      <b> {{$ingredient->quantity}} </b>
                                       {{$ingredient->unit}} 
                                       de {{$ingredient->name}} 
                                       ({{$ingredient->measurement}} )
                                  </p>
                              @endforeach
                            </div>
                        </div>
                        <!--preparacion-->
                        <div class="mb-4">
                            <h2 class="title-font  tracking-widest"><b>Preparación</b> </h2>
                            <div class="ml-3">
                              <p></p>
                              @foreach($recetas->preparationSteps as $step)
                                <span class=" text-gray-600">
                                  <i class="fas fa-utensils fa-sw"></i>
                                
                                  Paso: {{$step->step_Number}}</span>
                                <p class="leading-relaxed">{{$step->description_step}}</p> 
                              @endforeach
                            </div>
                        </div>
                        <!--boton generar pdf-->
                        <div class="flex">
                          <button class="flex ml-auto text-white bg-red-500 border-0 py-2 px-6 focus:outline-none hover:bg-red-600 rounded"> <a target="_blank" href="{{ route('recetas.pdf', ['id' => $recetas->id]) }}" >Generar PDF</a></button> 
                        </div>
                    
                </div>
            </form>
        </div>
    </section>
</x-app-layout >
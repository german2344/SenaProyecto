<div>
    <div class="card">
        <div class="card-header">
            <button wire:click="exportar()" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-download  mr-2"></i>
                <span>Exportar</span>
              </button>
        </div>
        <div class="px-6 py-4 flex items-center justify-center flex-wrap">
            <div class="flex items-center mr-2">
                <span>mostrar</span>
                <select wire:model.live="cantidadRegistros"   class="mx-2  border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ">
                    <option value="10">5</option>
                    <option value="10">10</option>
                </select>
                <span>entradas</span>
            </div>
            <x-input type="text" class="flex-1 m-2" wire:model.live="search" placeholder="Buscar"/>
           @livewire('shared.form-recipe')
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($recipes->isEmpty())
                    <div class="px-6 py-4">
                        @if ($this->search)
                            No Existe la Receta
                        @else
                            Usted no tiene Recetas creadas actualmente <b> pero puedes crear una ahora.</b>
                        @endif
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 text-center">
                            <tr>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dificultad</th>
                                <th scope="col"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tiempo de Preparacion</th>
                                <th colspan="2"  class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($recipes as $recipe)
                          
                                <tr >
                                    <td class="px-6 py-6">{{$recipe->name}}</td>
                                    <td class="px-6 py-6 "  >
                                        @foreach($recipe->multimedia as $index => $imagen)
                                            @if($index === 0)
                                                <img src="{{ asset('storage/' . $imagen->ruta) }}"  width="100px" alt="...">
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-6">{{$recipe->description}}</td>
                                    <td class="px-6 py-6">{{$recipe->difficulty}}</td>
                                    <td class="px-6 py-6">{{$recipe->preparation_time}}</td>
                                    <td class="px-6 py-6 flex items-center">
                                        
                                        <button class="ml-2 font-bold text-white p-2 rounded cursor-pointer  bg-blue-500" wire:click="emitirReceta({{$recipe}})" >  
                                            <i class="fas fa-pencil-alt"></i>
                                        </button> 
                                        <button  wire:click="destroyRecipe({{$recipe}})" class="ml-2 font-bold text-white p-2 rounded cursor-pointer bg-red-500">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{-- si tiene al menos dos paginas se mostrata si no se oculta --}}
                        @if ($recipes->hasPages())
                        <div class="px-6 py-3">
                            {{$recipes->links()}}
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>  
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('show-toast', (event) => {
                if(event.type==='error'){
                    toastr[event.type](event.message);
                }
           });
       });
   </script>  
</div>

<div>
    <link rel="stylesheet" href="{{asset('css/app/livewire/formRecipe.css')}}">
    <x-danger-button wire:click="abrirModal()">Crear Receta</x-danger-button>
    <x-modificados-jet.modal wire:model="openModal" maxWidth="full" >
        <div class="cont_form_recipe">
            <div class="grid grid-cols-2 gap-2 imgs">
                @if($listaImages)
                     @foreach($listaImages as $index => $image)
                         <div class="relative inline-block">
                             @if (is_string($image))
                             <img class="max-h-full max-w-full rounded-lg" src="{{asset('storage/' . $image)}}" alt="">   
                             @else
                             <img class="max-h-full max-w-full rounded-lg" src="{{ $image->temporaryUrl() }}" alt="">   
                             @endif
                             <button class="absolute top-0 right-0 m-2 p-2 bg-green-500 text-white rounded-full" wire:click="removeImage({{ $index }})">
                                 <i class="fas fa-trash"></i> 
                             </button>  
                         </div>
                     @endforeach
                         @if(count($listaImages) <= 3)
                             <div class="relative flex items-center justify-center max-h-full max-w-full rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                 @if ($NewImage)
                                     <button class="bg-blue-600 text-white p-3 rounded-lg" wire:click="agregarImagen()" >
                                         <b >Agregar la Imagen</b> 
                                     </button>  
                                 @else
                                     <div class="text-center">
                                         <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                         <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                         </svg>
                                         <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                         <label for="newImage" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                             <span>subir mas imagenes</span>
                                             <input wire:model="NewImage" id="newImage" name="newImage" type="file" class="sr-only" multiple>
                                         </label>
                                         
                                         </div>
                                         <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 5MB</p>
                                         <p class="text-xs leading-5 text-gray-600">maximo 4 imagenes </p>
                                     </div>
                                 @endif
                             </div> 
                         @endif
                 @else
                     <div class="col-span-2 flex items-center justify-center max-h-full max-w-full rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                         <div class="text-center">
                             <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                             <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                             </svg>
                             <div class="mt-4 flex text-sm leading-6 text-gray-600">
                             <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                 <span>subir imagenes</span>
                                 <input wire:model="listaImages" id="file-upload" name="file-upload" type="file" class="sr-only" multiple>
                             </label>
                          
                             </div>
                             <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 5MB</p>
                             <p class="text-xs leading-5 text-gray-600">maximo 4 imagenes </p>
                         </div>
                     </div>
                 @endif
             </div>
            <!--form recetas-->
            <form class="form_recipe">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Información de la Receta</h2>
                    <p class="mt-1 text-sm leading-6 text-gray-600">Digite toda la informacion que se pide por favor.</p>
                    <!-- <p class="mt-1 text-sm leading-6 text-gray-700">los campos con (<span class="text-color-red-500">*</span>) son obligatorios.</p> -->
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <!--titulo receta-->
                        <div class="sm:col-span-full">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Titulo de la Receta</label>
                            <div class="mt-2">
                              <input  wire:model="name" type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <x-input-error for="name"></x-input-error>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Tiempo</label>
                            <input wire:model="preparation_time" id="time" name="time" type="text" class="mt-1 p-2 border rounded-md w-full" placeholder="HH:MM" pattern="[0-9]{2}:[0-9]{2}" />
                            <x-input-error for='preparation_time'></x-input-error>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Dificultad</label>
                            <div class="mt-2">
                              <select wire:model="difficulty" name="difficulty" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Selecciona Dificultad</option>
                                <option value="fácil" {{ old('difficulty') == 'fácil' ? 'selected' : '' }}>Fácil</option>
                                <option value="medio" {{ old('difficulty') == 'medio' ? 'selected' : '' }}>Medio</option>
                                <option value="difícil" {{ old('difficulty') == 'difícil' ? 'selected' : '' }}>Difícil</option>
                              </select>
                              <x-input-error for="difficulty"></x-input-error>
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Categoria</label>
                            <div class="mt-2">
                              <select  wire:model="category_id" id="country" name="country" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option>Selecciona Categoria</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                              </select>
                              <x-input-error for="category_id"></x-input-error>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
                            <div class="mt-2">
                                <x-input-error for="description"></x-input-error>
                              <textarea wire:model="description" id="about" name="about" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                              <p class="mt-3 text-sm leading-6 text-gray-600">Describe un poco tu receta.</p>
                            </div>
                        </div>
                  
                          <!-- Ingredients -->
                        <div class="col-span-full">
                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900"><b>Ingredientes</b> </label>
                                <div>
                                    @foreach($ingredientes as $index => $ingrediente)
                                    <h3 class="w-full text-center m-3 text-gray-700">Ingrediente {{$index + 1}}</h3>
                                        <div class="flex flex-col md:flex-row md:items-center mb-2 ml-3">
                                            <div class="mb-2 mx-2">
                                                <label for="">cantidad</label>
                                                <input value="" type="text" wire:model="ingredientes.{{ $index }}.quantity" placeholder="Ej: 2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                            <div class="mb-2 mx-2">
                                                <label for="nombre">ingrediente</label>
                                                <input value="" type="text" wire:model="ingredientes.{{ $index }}.name" placeholder="Ej: Queso rayado" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row md:items-center mb-2 ml-3">
                                            <div class="mb-2 mx-2">
                                                <label for="">unidad</label>
                                                <input value="" type="text" wire:model="ingredientes.{{ $index }}.unit" placeholder="Ej: cucharadas" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                            <div class="mb-2 mx-2">
                                                <label for="">medida</label>
                                                <input value="" type="text" wire:model="ingredientes.{{ $index }}.measurement" placeholder="250g o al gusto" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" >
                                            </div>
                                            <button type="button" wire:click="eliminarIngrediente({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded mb-2 md:mb-0"> <i class="fas fa-trash"></i></button>
                                        </div>
                                    @endforeach
                                    <button type="button"  wire:click="agregarIngrediente()"  class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">Agregar Ingrediente</button>
                                </div>
                        </div>
        
                        <div class="col-span-full">
                                <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Preparación</label>
                                <div >
                                    @foreach($pasos as $index => $paso)
                                            <div class="mt-2">
                                                <h3>Paso {{$index + 1}}    <button type="button" wire:click="eliminarPaso({{ $index }})" class="bg-red-500 text-white px-2 py-1 rounded mb-2 md:mb-0"> <i class="fas fa-trash"></i></button></h3>
                                              <textarea  wire:model="pasos.{{ $index }}" placeholder="escribe la descripcion del paso" id="about" name="about" rows="2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                          
                                            </textarea>
                                            </div>
                                    @endforeach
                                    <button type="button"  wire:click="agregarPaso()"  class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2 text-center me-2 mb-2">Agregar Paso</button>
                                </div>
                        </div> 
        
                        <!--boton guardar-->
                        <div class="flex">
                            <x-danger-button class="flex ml-auto " wire:click="createOrUpdate()">{{$btnModal}}</x-danger-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
   </x-modificados-jet.modal>
   <script>
    document.addEventListener('livewire:initialized', () => {
       @this.on('show-toast', (event) => {
           toastr[event.type](event.message);
       });
   });
</script>
</div>
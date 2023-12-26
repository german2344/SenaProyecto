<div>
    <link rel="stylesheet" href="{{asset('css/app/livewire/formRecipe.css')}}">
    <div wire:click=" openModal()" class="px-5  text-center cursor-pointer bg-green-100 text-green-600"><i class="fas fa-edit"></i></div>
    <x-modificados-jet.modal wire:model="openModalUserEdit" maxWidth="full" >
        <div class="cont_form_recipe">
            <div class="imgs">
                         <div class="h-1/2 inline-block p-2">
                            @if (is_string($avatar))                         
                                <img src="{{$avatar}}" alt="" class="rounded-full h-24 w-full object-cover mx-auto">
                            @else
                                <img src="{{$avatar->temporaryUrl()}}" alt="" class="rounded-full h-24 w-24 object-cover mx-auto">
                            @endif
                            <div class=" m-4 flex justify-center">
                                <label for="file-upload" class=" relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                <span>subir imagen</span>
                                <input wire:model="avatar" id="file-upload" name="file-upload" type="file" class="sr-only" >
                                </label>
                            </div>
                         </div>
                       
                          
             </div>
            <!--form recetas-->
            <form class="form_recipe">
                <div class="border-b border-gray-900/10 pb-12">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Información de Usuario </h2>
                    
                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <!--titulo receta-->
                        <div class="sm:col-span-full">
                            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Nombre de usuario</label>
                            <div class="mt-2">
                              <input  wire:model="name" type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                              <x-input-error for="name"></x-input-error>
                            </div>
                        </div>
        
                        <div class="sm:col-span-3">
                            <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Telefono</label>
                            <input  wire:model="phone" type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
        
                        <div class="sm:col-span-3">
                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Genero</label>
                            <div class="mt-2">
                                <select wire:model="gender" name="difficulty" autocomplete="country-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                  <option>Selecciona genero</option>
                                  <option value="M" >Masculino</option>
                                  <option value="F" >Femenino</option>
                                  <option value="O" >Otro</option>
                                </select>
                                <x-input-error for="difficulty"></x-input-error>
                              </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="time" class="block text-sm font-medium leading-6 text-gray-900">Ubicación</label>
                            <input  wire:model="location" type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
        
                        <div class="sm:col-span-3">
                            <label for="country" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <input  wire:model="email" type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
        
                       
        
                        <div class="col-span-full">
                            <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Breve Descripción tuya</label>
                            <div class="mt-2">
                                <x-input-error for="description"></x-input-error>
                              <textarea wire:model="descripcion" id="about" name="about" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                            </div>
                        </div>
                  
                      
        
                        <!--boton guardar-->
                        <div class="flex">
                            <x-danger-button class="flex ml-auto " wire:click="updateUser()">Guardar</x-danger-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </x-modificados-jet.modal>
</div>




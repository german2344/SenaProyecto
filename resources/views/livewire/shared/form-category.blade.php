<div>
    <x-danger-button wire:click="abrirModal()">Crear Categoria</x-danger-button>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            {{$titleModal}} 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre de Categoria"></x-label>
                <x-input wire:model=name placeholder="Ej:Postres"></x-input>
                <x-input-error for='name'></x-input-error>
            </div>
            <div class="mb-4">
                <x-label value="la categoria es dirigida a?:"></x-label>
                <select class="form-control" name="rol" wire:model="type">
                    <option value="" >
                        elige una opcion
                    </option>
                        <option value="recipeAndmenu" >
                            recetas y platos
                        </option>
                        <option value="product">
                            productos
                        </option>
                </select>
                <x-input-error for='type'></x-input-error>
            </div>


        </x-slot>
        <x-slot name="footer">
            <x-secondary-button  wire:click="$set('openModal', false)">Cancelar</x-secondary-button>
            <x-danger-button  wire:loading.remove wire:click="createOrUpdate()">{{$btnModal}}</x-danger-button>
            <span wire:loading wire:target="createOrUpdate()">cargando ...</span>
        </x-slot>
    </x-dialog-modal>
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('show-toast', (event) => {
               toastr[event.type](event.message);
           });
       });
    </script>
</div>

<div>
    <x-danger-button wire:click="abrirModal()">Crear Rol</x-danger-button>
    <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            {{$titleModal}} 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Nombre del Rol"></x-label>
                <x-input wire:model=name placeholder="Ej:Postres" class="w-full"></x-input>
                <x-input-error for='name'></x-input-error>
            </div>
            <div class="mb-4">
                    <x-label value="permissos:"></x-label>
                    @foreach ($permissions as $permission)
                    <div class="flex w-sm px-2">
                        <input type="checkbox"  wire:model="role_id" value="{{$permission->id}}">
                        <label for="permissions.0">{{$permission->description}}</label>
                    </div>
                    @endforeach
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

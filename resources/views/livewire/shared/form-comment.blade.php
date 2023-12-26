<div>
     <link rel="stylesheet" href="{{ asset('css/shared/opinion.css')}}"> 
     <x-danger-button wire:click="abrirModal()">Crear Comentario</x-danger-button>
     <x-dialog-modal wire:model="openModal">
        <x-slot name="title">
            {{$titleModal}} 
        </x-slot>
        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Comentario"></x-label>
                <textarea name="" class="form-control w-full" id="" rows="6" wire:model.live="description"></textarea>
                <x-input-error for='description'></x-input-error>
                <x-label class="py-3" value="Calificación"></x-label>
                
                <div class=" star-rating">
                    <input type="radio" wire:model="rating" id="star5" name="rating" value="5">
                    <label for="star5"></label>
                    <input type="radio" wire:model="rating" id="star4" name="rating" value="4">
                    <label for="star4"></label>
                    <input type="radio" wire:model="rating" id="star3" name="rating" value="3">
                    <label for="star3"></label>
                    <input type="radio" wire:model="rating" id="star2" name="rating" value="2">
                    <label for="star2"></label>
                    <input type="radio" wire:model="rating" id="star1" name="rating" value="1">
                    <label for="star1"></label>
                </div>
            </div>
            <x-input-error for='rating'></x-input-error>
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

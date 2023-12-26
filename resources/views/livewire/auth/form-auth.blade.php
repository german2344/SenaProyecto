<div>
    <link rel="stylesheet" href="{{ asset('css/app/livewire/auth.css') }}"> 
    <button  wire:click="$set('openModalAuth', true)">login</button>
    <x-modificados-jet.modal wire:model="openModalAuth"   maxWidth="fit" >
      
    </x-modificados-jet.modal>
</div>

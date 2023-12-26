<div>
    <link rel="stylesheet" href="{{ asset ('css/contacto.css') }}">
    <div class="cont-contact ">
        <div class="content">

            <h1 class="heading"> <span>Contactanos</span></h1>

            <div class="contact-wrapper animated bounceInUp">
                <div class="contact-form">
                    <h3>Contacto</h3>
                    <div class="formulario">
                        <div >
                            <label>Tu Nombre</label>
                            <input wire:model="name" type="text" name="name">
                            <x-input-error for="name"></x-input-error>
                        </div>
                        
                        <div>
                            <label>Tu Correo Electronico</label>
                            <input wire:model="email" type="email" name="email">
                            <x-input-error for="email"></x-input-error>
                        </div>
                    


                        <div>
                            <label>Tu numero de Telefono</label>
                            <input wire:model="phone" type="tel" name="phone">
                            <x-input-error for="phone"></x-input-error>
                        </div>
                    
                       
                            <div class="">
                                <label>Asunto</label>
                                <input wire:model="affair" type="text" name="affair">
                                <x-input-error for="affair"></x-input-error>
                            </div>
                        
                    
                        <div class="block">
                            <label>Escribe tu Mensaje</label>
                            <textarea wire:model="message" name="message" rows="3"></textarea>
                            <x-input-error for="message"></x-input-error>
                        </div>
                    
                        <div class="block">
                            <button type="button" wire:click="enviarCorreo()">
                                Enviar
                            </button>
                        </div>
                    </div>
                </div>
                <div class="contact-info">
                    <h4>Mas informacion</h4>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Popayán - Cauca</li>
                        <li><i class="fas fa-phone"></i> (+57) 111 111 111</li>
                        <li><i class="fas fa-envelope-open-text"></i> sena@website.com</li>
                    </ul>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero provident ipsam necessitatibus repellendus?</p>
                    <p>Senakitch.com</p>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('livewire:initialized', () => {
               @this.on('show-toast', (event) => {
                   toastr[event.type](event.message);
               });
           });
        </script>
        
</div>
</div>

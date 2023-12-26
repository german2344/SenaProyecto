<div>
    <link rel="stylesheet" href="{{ asset('css/shared/productos.css')}}">
    <section class="products" id="products">
            <h1 class="heading"> nuestros <span>productos</span> </h1>
            @can('admin.products.store')
                <div class="flex justify-center m-6 mx-auto w-full">
                    @livewire('shared.form-product') 
                </div>
            @endcan
            
            <div class="box-container">
                @foreach($productos as $product)
                        <livewire:app.components.card.card-product :product="$product" :key="$product->id" lazy/>
                @endforeach 
            </div>
    </section>
    <script>
        document.addEventListener('livewire:initialized', () => {
           @this.on('show-toast', (event) => {
               toastr[event.type](event.message);
           });
       });
    </script>
</div>

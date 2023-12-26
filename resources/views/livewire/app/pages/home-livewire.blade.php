<div>
    <link rel="stylesheet" href="{{ asset ('css/home/index/home.css') }}">
    <!-- seccion portada de home -->
    <section class="home" id="home">
        <div class="content">
            <h3>conoce acerca  </h3>
            <h3>de nosotros</h3>
            <p>averigua todos los productos y recetas</p>
            <p>que el sena tiene para ofrecerte.</p>
            <a href="{{route('login')}}" class="btn">adquierelo ya!</a>
        </div>
    </section>
    <!-- seccion acerca de home -->
    <section class="about" id="about">
        <h1 class="heading"> <span>acerca</span> de </h1>
        <div class="row">
            <div class="image">
                <img src="images/academia.jpg" alt="">
            </div>
            <div class="content">
                <h3>que hace que senakitch sea especial?</h3>
                <p>debes saber que ademas de mostrar gran variedades de productos el sena cuenta con grandiosos  aprendices de desarrollo y cocina que hace posible que disfrutes de nuestra web</p>
                <p>lo que nos hace especial es que trabajando en equipo podemos llegar a lograr grandes cosas y romper barreras</p>
                <a href="<?php echo e(route('nosotros')); ?>" class="btn">Aprende más</a>
            </div>
    
        </div>
    </section>
{{-- seccion de platos home --}}
    @if($menus)
        <section class="menu" id="menu">
            <h1 class="heading"> nuestros <span>platos</span> </h1>          
            <div class="container" >
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="box-container">
                            @foreach($menus as $plato)
                                <livewire:app.components.card.card-plato  :plato="$plato"  />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- seccion de productos home --}}
    @if ($products)
        <section class="products" id="products">
            <h1 class="heading"> nuestros  <span>productos</span> </h1>
            <div class="box-container">
                @foreach($products as $product)
                    <livewire:app.components.card.card-product :product="$product" />
                @endforeach
            </div>
        </section>
    @endif
    {{-- seccion de comentarios home --}}
    @if($comments)
        <section class="review" id="review">
            <h1 class="heading"> su <span>opinion</span> </h1>
            <div class="box-container">
                @foreach ($comments as $comment )
                        @livewire('app.components.card.card-comment', ['comment' => $comment])
                @endforeach
                </div>
        </section>
    @endif
    
    <section class="contact" id="contact">
        <h1 class="heading"> <span>tu</span> contacto </h1>
        <div class="row">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63778.38370428024!2d-76.6349534824848!3d2.4574702446796857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e300311c028d47d%3A0x880bd67f0987a54e!2zUG9wYXnDoW4sIENhdWNh!5e0!3m2!1ses-419!2sco!4v1668640132821!5m2!1ses-419!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <form action="">
                <h3>contactanos</h3>
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" placeholder="nombre">
                </div>
                <div class="inputBox">
                    <span class="fas fa-envelope"></span>
                    <input type="email" placeholder="email">
                </div>
                <div class="inputBox">
                    <span class="fas fa-phone"></span>
                    <input type="number" placeholder="numero">
                </div>
                <input type="submit" value="contacta ahora" class="btn">
            </form>
        </div>
    </section>

    {{-- seccion de recetas home--}}
    @if ($recipes)
        <section class="blogs" id="blogs">
            <h1 class="heading"> nuestras <span>recetas </span> </h1>
            <div class="box-container">
                @foreach ($recipes as $recipe)
                    <livewire:app.components.card.card-recipe :recipe="$recipe"  />
                @endforeach
            </div>
        </section>
    @endif
</div>

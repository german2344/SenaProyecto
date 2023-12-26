<div>
    <div class="box">
        <div class="card">
            <img src="{{$imgPlatoCard}}" alt="...">
            <div class="card-body">
                <a href=""><h6 class="card-title">{{ $plato->name }}</h6></a>
                <p>{{substr($plato->description, 0, 100)}}...</p>
                    <div class="card-footer">
                          <div class="row">
                            <button  wire:click="addItem(1,{{$plato}})">
                                agregar al carrito
                            </button>
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>
   
</div>

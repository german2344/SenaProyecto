<?php

namespace App\Livewire\Shared;

use App\Livewire\Admin\ShowProducts;
use App\Livewire\App\Components\Shared\Card\CardProduct;
use App\Livewire\App\Pages\ProductsLivewire;
use App\Livewire\App\Productos;
use App\Models\Category;
use App\Models\Multimedia;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class FormProduct extends Component
{
    use WithFileUploads; 
    //vars modal
    public  $titleModal = "Crear Producto", $btnModal = "Crear" , $openModal =false;
    protected $listeners = ['editarProductForm'];
        //variables inputs
    public $name,$price,$quantity,$description,$category_id,$identificador,$productId,
        $listaImages = [] , $NewImage=[];
    private $resetVariables = ['openModal','category_id','name','price','quantity','description','btnModal','titleModal','listaImages','category_id','productId','NewImage'];    
    public $rules = [
        'name'=> 'required',
        'price'=>'required',
        'quantity' => 'required',
        'description'=> 'required',
        'category_id' => 'required',
        //'lista.*' => 'image|max:1024', // Ajusta según tus necesidades
    ];
    public function mount(){ 
        $this->identificador = rand(); //le asigna un numero al azar o random
        $this->listaImages = []; //array vacio
    }
    public function render()
    {
        $categories = Category::where('type', 'product')->get();
        return view('livewire.shared.form-product',compact('categories'));
    }

    public function editarProductForm(Product $product){
        $this->reset($this->resetVariables);
        $this->productId = $product->id;
        $this->name =$product->name;
        $this->description =$product->description;
        $this->price =$product->price;
        $this->quantity =$product->quantity;
        $this->category_id = $product->category_id;
        foreach ($product->multimedia as $multimedia) {
            $this->listaImages[] = $multimedia->ruta;}
        $this->titleModal = "Editar Producto"; $this->btnModal = "Actualizar";
         $this->openModal= true;
    }

    public function createOrUpdate(){
        $productData = [
            'name' => $this->name,            
            'price'=>$this->price,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
        ];
        ///CREAR:CREATE
        if ($this->btnModal == "Crear") {
            $this->validate();
            $product = Product::create($productData);
                foreach ($this->listaImages as $image) {
                    $path = $image->store('products');
                    $multimedia = new Multimedia();
                    $multimedia->ruta = $path;
                    $multimedia->type = 'imagen';
                    $product->multimedia()->save($multimedia);
                }
            $message = '¡Producto creado exitosamente!';

        } 
        //ACTUALIZAR:UPDATE
        elseif ($this->btnModal == "Actualizar") {
            $productEdit =Product::find($this->productId);
            $existingImages = $productEdit->multimedia()->pluck('ruta')->toArray();
            if ($productEdit) {
                $productData['user_id'] = $productEdit->user_id;
                $productEdit->update($productData);
                foreach ($existingImages as $existingImage) {
                    if (!in_array($existingImage, $this->listaImages)) {
                        Storage::disk('public')->delete($existingImage);
                        $productEdit->multimedia()->where('ruta', $existingImage)->delete();
                    }
                }
                foreach ($this->listaImages as $Image) {
                    if (is_string($Image)) {
                        // La imagen ya existe, no es necesario hacer nada
                    } else {
                        $path = $Image->store('recipes');
                        $multimedia = new Multimedia();
                        $multimedia->ruta = $path;
                        $multimedia->type = 'imagen';
                        $productEdit->multimedia()->save($multimedia);
                    }
                }
            }
            $message = '¡Producto actualizado exitosamente!';
        }
        $this->reset($this->resetVariables);
        $this->identificador = rand();
        //emitir al mismo componente
        $this->dispatch('show-toast', type:"success", message: $message)->self();
        $this->dispatch('render')->to(ShowProducts::class);
        $this->dispatch('render')->to(ProductsLivewire::class);
    }

    public function abrirModal(){
        $this->reset($this->resetVariables); 
        $this->openModal= true;
    }

    public function agregarImagen(){
        foreach ($this->NewImage as $image){
            $this->listaImages[] = $image;
        }
        $this->NewImage = [];
        $this->render();
    }

    public function removeImage($index){
        unset($this->listaImages[$index]);
        $this->listaImages = array_values($this->listaImages); // Reindexar el array después de eliminar una imagen
    }
}

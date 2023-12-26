<?php

namespace App\Livewire\Shared;

use App\Livewire\Admin\ShowMenus;
use App\Livewire\App\Pages\PlatosLivewire;;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Multimedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class FormPlate extends Component
{
    use WithFileUploads; 
    //vars modal
    public  $titleModal = "Crear Plato", $btnModal = "Crear" , $openModal =false;
    protected $listeners = ['editarPlateForm'];
         //variables inputs
    public $name,$price,$quantity,$description,$category_id,$identificador,$platoId,
    $listaImages = [], $NewImage=[];
     
     private $resetVariables = ['openModal','category_id','name','price','quantity','description','btnModal','titleModal','listaImages','category_id','platoId','NewImage'];
     public $rules = [
         'name'=> 'required',
         'price'=>'required',
         'quantity' => 'required',
         'description'=> 'required',
         'category_id' => 'required',
         //'listaImages.*' => 'required|image|mimes:jpeg,png,gif|max:1024',
     ];
     public function mount(){ 
         $this->identificador = rand(); //le asigna un numero al azar o random
     }
    public function render()
    {
        $categories = Category::where('type', 'recipeAndMenu')->get();
        return view('livewire.shared.form-plate',compact('categories'));
    }
    //LLENAR FORMULARIO DE LA DATA DE PLATOS
    public function editarPlateForm(Menu $menu){
        $this->reset($this->resetVariables);
        $this->platoId = $menu->id;
        $this->name =$menu->name;
        $this->description =$menu->description;
        $this->price =$menu->price;
        $this->quantity =$menu->quantity;
        $this->category_id = $menu->category_id;
        foreach ($menu->multimedia as $multimedia) {
            $this->listaImages[] = $multimedia->ruta;}
        $this->titleModal = "Editar Plato"; $this->btnModal = "Actualizar";
         $this->openModal= true;
    }

    public function createOrUpdate(){
        $platoData = [
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
            $plato = Menu::create($platoData);
                foreach ($this->listaImages as $image) {
                    $path = $image->store('products');
                    $multimedia = new Multimedia();
                    $multimedia->ruta = $path;
                    $multimedia->type = 'imagen';
                    $plato->multimedia()->save($multimedia);
                }
                $message = '¡El Plato ha sido creado exitosamente!';
        } 
        //ACTUALIZAR:UPDATE
        elseif ($this->btnModal == "Actualizar") {
            $platoEdit =Menu::find($this->platoId);
            $existingImages = $platoEdit->multimedia()->pluck('ruta')->toArray();
            if ($platoEdit) {
                $platoData['user_id'] = $platoEdit->user_id;
                $platoEdit->update($platoData);
                foreach ($existingImages as $existingImage) {
                    if (!in_array($existingImage, $this->listaImages)) {
                        Storage::disk('public')->delete($existingImage);
                        $platoEdit->multimedia()->where('ruta', $existingImage)->delete();
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
                        $platoEdit->multimedia()->save($multimedia);
                    }
                }
            }
            $message = '¡Plato actualizado exitosamente!';
        }
        $this->reset($this->resetVariables);
        $this->identificador = rand();
       //emitir al mismo componente
        $this->dispatch('show-toast', type:"success", message: $message)->self(); 
        $this->dispatch('render')->to(ShowMenus::class);
        $this->dispatch('render')->to(PlatosLivewire::class);
    }

    //METODOS PARA EL FRONTEND DEL COMPONENTE
    public function abrirModal(){$this->reset($this->resetVariables); $this->openModal= true;}

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

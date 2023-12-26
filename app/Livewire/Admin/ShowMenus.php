<?php

namespace App\Livewire\Admin;

use App\Livewire\Shared\FormPlate;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
class ShowMenus extends Component
{
    use WithPagination;
    use WithFileUploads; 
    public $search;
    public $openModal = false;
    public $name, $image_path,$price, $identificador,$menuId;
    public $titleModal = "Crear Menu", $btnModal = "Crear";
    public $rules = [
        'name'=> 'required',
        'image_path'=> 'required|image|mimes:png,jpg|max:2048',
        'price' =>'numeric|required',
        // 'category' => 'required',
    ];
    protected $listeners = ['render'];

    private $resetVariables = ['openModal','name','image_path','price','btnModal','titleModal'];

    public function mount(){
        $this->identificador = rand(); //le asigna un numero al azar o random
    }

    public function render()
    {
        if (auth()->user()->hasRole('Admin')) {
            $menus = Menu::where('name', 'LIKE', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(5);
        } elseif (auth()->user()->hasRole('Aprendiz')) {
            $menus = Menu::where('user_id', auth()->user()->id)->orderBy('id', 'desc')
                          ->where(function ($query) {
                              $query->where('name', 'LIKE', '%' . $this->search . '%');
                          })
                          ->paginate(5);
        }
        return view('livewire.admin.show-menus',compact('menus'));
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }
    public function destroyMenu(Menu $menu) {
        // Eliminar imagen
       foreach ($menu->multimedia as $multimedia) {
            Storage::disk('public')->delete($multimedia->ruta);
            $multimedia->delete();
       }
       $menu->delete();
       $this->dispatch('show-toast', type:"error", message: "¡Plato eliminado exitosamente!"); 
       $this->resetPage();
   }

      //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }

    public function exportar(){
    //     $menusExport = new MenuExport;
    //     return $menusExport->download('menus.xlsx');
     }

     public function emitPlato(Menu $plato)
     {
         $this->dispatch('editarPlateForm',$plato)->to(FormPlate::class);
     }
}

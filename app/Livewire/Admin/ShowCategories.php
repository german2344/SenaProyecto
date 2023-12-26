<?php

namespace App\Livewire\Admin;

use App\Livewire\Shared\FormCategory;
use App\Models\Category;
use Livewire\Component;

class ShowCategories extends Component
{
    public $search;
    protected $listeners = ['render'];
    public function render(){
        $categories = Category::where('name', 'LIKE', '%' . $this->search . '%')->paginate(5);
        return view('livewire.admin.show-categories',compact('categories'));
    }
    public function emitCategory(Category $category){
        $this->dispatch('editarCategoryForm',$category)->to(FormCategory::class);
    }
    public function destroyCategory(Category $category) {
        // Eliminar imagen
       $category->delete();
       $this->dispatch('show-toast', type:"error", message: "¡Plato eliminado exitosamente!")->self(); 
       $this->resetPage();
   }
}

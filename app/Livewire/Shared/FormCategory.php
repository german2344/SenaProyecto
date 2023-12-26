<?php

namespace App\Livewire\Shared;

use App\Livewire\Admin\ShowCategories;
use App\Models\Category;
use Livewire\Component;

class FormCategory extends Component
{
    public  $openModal= false,$titleModal="Crear Categoria",$btnModal="Crear";
    private $resetVariables =  ['openModal','btnModal','name','type','categoryId'];
    public $name,$type,$categoryId;
    public $rules=[
        'name'=> 'required',
        'type'=>'required',
    ];
    protected $listeners = ['editarCategoryForm'];
    public function render()
    {
        return view('livewire.shared.form-category');
    }
    public function abrirModal(){
        $this->reset($this->resetVariables); 
        $this->openModal= true;
    }
    public function createOrUpdate(){
        $categoryData = [
            'name' => $this->name,            
            'type'=>$this->type,
        ];
        $this->validate();
         ///CREAR:CREATE
         if ($this->btnModal == "Crear") {
            Category::create($categoryData);
            $message = '¡La categorya ha sido creado exitosamente!';
        } 
        //ACTUALIZAR:UPDATE
        elseif ($this->btnModal == "Actualizar") {
            $categoryEdit =Category::find($this->categoryId);
            if ($categoryEdit) {
                $categoryEdit->update($categoryData);
            }
            $message = '¡Categoria actualizado exitosamente!';
        }
        $this->reset($this->resetVariables);
        // $this->identificador = rand();
       //emitir al mismo componente
        $this->dispatch('show-toast', type:"success", message: $message)->self(); 
        $this->dispatch('render')->to(ShowCategories::class);
    }

       //LLENAR FORMULARIO DE LA DATA DE PLATOS
       public function editarCategoryForm(Category $category){
        $this->reset($this->resetVariables);
        $this->categoryId = $category->id;
        $this->name =$category->name;
        $this->type =$category->type;
        $this->titleModal = "Editar Categorya"; $this->btnModal = "Actualizar";
         $this->openModal= true;
    }

}

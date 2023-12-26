<?php

namespace App\Livewire\Shared;

use App\Livewire\Admin\ShowRoles;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FormRole extends Component
{
    public  $openModal= false,$titleModal="Crear Rol",$btnModal="Crear";
    private $resetVariables =  ['openModal','btnModal','name','roleId'];
    public $name,$roleId,$permissionsLista = [];
    public $rules=[
        'name'=> 'required',
    ];
    protected $listeners = ['editarRolForm'];
    public function abrirModal(){
        $this->reset($this->resetVariables); 
        $this->openModal= true;
    }
    public function createOrUpdate(){
        $this->validate();
         ///CREAR:CREATE
         if ($this->btnModal == "Crear") {
            dd();
            // $newRol = Role::create(['name' => $this->name]);
            // $newRol->permissions()->sync(); //permissions
            // $message = '¡EL Rol ha sido creado exitosamente!';
        } 
        //ACTUALIZAR:UPDATE
        elseif ($this->btnModal == "Actualizar") {
            $roleEdit =Role::find($this->roleId);
            if ($roleEdit) {
                $roleEdit->update(['name' => $this->name]);
            }
            $message = '¡ROl actualizado exitosamente!';
        }
        $this->reset($this->resetVariables);
        // $this->identificador = rand();
       //emitir al mismo componente
        $this->dispatch('show-toast', type:"success", message: $message)->self(); 
        $this->dispatch('render')->to(ShowRoles::class);
    }

       //LLENAR FORMULARIO DE LA DATA DE PLATOS
       public function editarRoleForm(Role $role){
        $this->reset($this->resetVariables);
        $this->roleId = $role->id;
        $this->name =$role->name;
        $this->titleModal = "Editar ROl"; $this->btnModal = "Actualizar";
         $this->openModal= true;
    }
    public function render()
    {
        $permissions =Permission::all();
        return view('livewire.shared.form-role',compact('permissions'));
    }
}

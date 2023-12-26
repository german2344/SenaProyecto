<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class ShowRoles extends Component
{
    public $search;
    protected $listeners = ['render'];
    public function emitRole(Role $role){
       // $this->dispatch('editarRoleForm',$role)->to(FormCategory::class);
    }
    public function destroyRole(Role $role) {
        // Eliminar imagen
       $role->delete();
       $this->dispatch('show-toast', type:"error", message: "¡El ROl fue eliminado exitosamente!")->self(); 
       $this->resetPage();
   }
    public function render()
    {
        $roles = Role::where('name', 'LIKE', '%' . $this->search . '%')->paginate(5);
        return view('livewire.admin.show-roles',compact('roles'));
    }
}

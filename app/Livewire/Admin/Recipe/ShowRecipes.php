<?php
    namespace App\Livewire\Admin\Recipe;
    use App\Exports\RecipeExport;
    use App\Livewire\Shared\FormRecipe;
    use App\Models\Recipe;
    use Illuminate\Support\Facades\Storage;
    use Livewire\WithPagination;
    use Livewire\Component;
    use Livewire\WithFileUploads;

class ShowRecipes extends Component
{
    use WithPagination;
    use WithFileUploads; 
    public $search;
    protected $listeners = ['render'];

    public function render()
    {   
        if (auth()->user()->hasRole('Admin')) {
            $recipes = Recipe::where('name', 'LIKE', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(5);
        }
        elseif (auth()->user()->hasRole('Aprendiz')) {
            $recipes = Recipe::where('user_id', auth()->user()->id)
                          ->where(function ($query) {
                              $query->where('name', 'LIKE', '%' . $this->search . '%');
                          })
                          ->paginate(5);
        }
        return view('livewire.admin.recipe.show-recipes',compact('recipes'));
    }

    public function emitirReceta(Recipe $recipe)
    {
        $this->dispatch('editarRecetaForm',$recipe)->to(FormRecipe::class);
    }

    public function destroyRecipe(Recipe $recipe) {
         // Eliminar imagen
        foreach ($recipe->multimedia as $multimedia) {
            Storage::disk('public')->delete($multimedia->ruta);
            $multimedia->delete();
        }
        $recipe->delete();
        $this->dispatch('show-toast', type:"error", message: "¡Receta eliminada exitosamente!"); 
        $this->resetPage();
    }

    //reiniciar paginacion si se cambia la variable search
    public function updatingSearch(){
        $this->resetPage();
    }

    public function exportar(){
        $recipesExport = new RecipeExport;
        return $recipesExport->download('recipes.xlsx');
    }
}

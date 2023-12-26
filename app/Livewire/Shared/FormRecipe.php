<?php
namespace App\Livewire\Shared;
use App\Livewire\Admin\Recipe\ShowRecipes;
use App\Livewire\App\Pages\RecipesLivewire;
use App\Models\Category;
use App\Models\Ingredient;
use Livewire\Component;
use App\Models\Recipe;
use App\Models\Multimedia;
use App\Models\PreparationStep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class FormRecipe extends Component
{
    use WithFileUploads; 
    public  $titleModal = "Crear Receta", $btnModal = "Crear" , $openModal =false;
    //variables inputs
    public $name,$difficulty,$preparation_time,$description,$category_id,$identificador,$recipeId,
    $ingredientes = [],$pasos=[],$listaImages = [], $NewImage=[];

    private $resetVariables = ['openModal','category_id','name','preparation_time','difficulty','description','ingredientes','pasos','btnModal','titleModal','listaImages','NewImage'];
    //emit    
    protected $listeners = ['editarRecetaForm'];
    public $rules = [
        'name'=> 'required',
        'difficulty'=>'required',
        'preparation_time' => 'required',
        'description'=> 'required',
        'category_id' => 'required',
        //'lista.*' => 'image|max:1024', // Ajusta según tus necesidades
    ];

    public function mount(){ 
        $this->identificador = rand(); //le asigna un numero al azar o random
    }
    public function render(){
        $categories = Category::where('type', 'recipeAndMenu')->get();
        return view('livewire.shared.form-recipe',compact('categories'));
    }

    public function editarRecetaForm(Recipe $recipe){
        $this->reset($this->resetVariables);
        $this->recipeId = $recipe->id;
        $this->name =$recipe->name;
        $this->description =$recipe->description;
        $this->difficulty =$recipe->difficulty;
        $this->preparation_time =$recipe->preparation_time;
        $this->ingredientes = $recipe->ingredients;
        $this->category_id = $recipe->category_id;
        $this->ingredientes = [];
        foreach ($recipe->ingredients as $dataIngredients) {
            $this->ingredientes[] = [
                'quantity' => $dataIngredients->quantity,
                'unit' => $dataIngredients->unit,
                'name' => $dataIngredients->name,
                'measurement' => $dataIngredients->measurement,
            ];
        }
        foreach ($recipe->preparationSteps as $pasos) {
            $this->pasos[] = $pasos->description_step;}
        foreach ($recipe->multimedia as $multimedia) {
            $this->listaImages[] = $multimedia->ruta;}
        $this->titleModal = "Editar Receta"; $this->btnModal = "Actualizar";
         $this->openModal= true;
    }

    public function createOrUpdate(){
        $recipeData = [
            'name' => $this->name,
            'difficulty' => $this->difficulty,
            'description' => $this->description,
            'preparation_time' => $this->preparation_time,
            'category_id' => $this->category_id,
            'user_id' => Auth::user()->id,
        ];
        ///CREAR:CREATE
        if ($this->btnModal == "Crear") {
            $this->validate();
            $recipe = Recipe::create($recipeData);
                //crear imagenes
                foreach ($this->listaImages as $image) {
                    $path = $image->store('recipes');
                    $multimedia = new Multimedia();
                    $multimedia->ruta = $path;
                    $multimedia->type = 'imagen';
                    $recipe->multimedia()->save($multimedia);
                }
                //crear ingredientes
                foreach ($this->ingredientes as $ingrediente) {
                    Ingredient::create([
                        'recipe_id' => $recipe->id,
                        'quantity' => $ingrediente['quantity'],
                        'unit' => $ingrediente['unit'],
                        'name' => $ingrediente['name'],
                        'measurement' => $ingrediente['measurement'],
                    ]);
                }
                //crear pasos
                foreach ($this->pasos as $index => $paso) {
                    PreparationStep::create([
                        'recipe_id' => $recipe->id,
                        'step_number' => $index + 1,
                        'description_step' => $paso,
                    ]);
                }
                //mensaje
                $message = '¡La Receta fue creada exitosamente!';
        } 
        //ACTUALIZAR:UPDATE
        elseif ($this->btnModal == "Actualizar") {
            $recipeEdit = Recipe::find($this->recipeId);
            $existingImages = $recipeEdit->multimedia()->pluck('ruta')->toArray();
            $existingIngredients = $recipeEdit->ingredients()->pluck('name')->toArray();
            $existingSteps = $recipeEdit->preparationSteps()->pluck('description_step')->toArray();
             if ($recipeEdit) {
                 $recipeData['user_id'] = $recipeEdit->user_id;
                 $recipeEdit->update($recipeData);
                 //eliminar imagenes que ya no exixten en nuevo array de imagenes 
                 foreach ($existingImages as $existingImage) {
                     if (!in_array($existingImage, $this->listaImages)) {
                         Storage::disk('public')->delete($existingImage);
                         $recipeEdit->multimedia()->where('ruta', $existingImage)->delete();
                     }
                 }
                 //crear las nuevas imagenes
                 foreach ($this->listaImages as $Image) {
                     if (is_string($Image)) {
                         // La imagen ya existe, no es necesario hacer nada
                     } else {
                         $path = $Image->store('recipes');
                         $multimedia = new Multimedia();
                         $multimedia->ruta = $path;
                         $multimedia->type = 'imagen';
                         $recipeEdit->multimedia()->save($multimedia);
                     }
                 }
                 //actualizar ingredientes
                 foreach ($this->ingredientes as $ingredient) {
                    if (!in_array($ingredient, $existingIngredients)) {
                        Ingredient::create([
                            'recipe_id' => $recipeEdit->id,
                            'quantity' => $ingredient['quantity'],
                            'unit' => $ingredient['unit'],
                            'name' => $ingredient['name'],
                            'measurement' => $ingredient['measurement'],
                        ]);
                    }
                }
                 foreach ($existingIngredients as $existingIngredient) {
                    if (!in_array($existingIngredient, $this->ingredientes)) {
                        $recipeEdit->ingredients()->where('name', $existingIngredient)->delete();
                    }
                }
                //actualizar pasos
                foreach ($existingSteps as $existingStep) {
                    if (!in_array($existingStep, $this->pasos)) {
                        $recipeEdit->preparationSteps()->where('description_step', $existingStep)->delete();
                    }
                }

                foreach ($this->pasos as $index => $paso) {
                    if (!in_array($paso, $existingSteps)) {
                        PreparationStep::create([
                            'recipe_id' => $recipeEdit->id,
                            'step_number' => $index + 1,
                            'description_step' => $paso,
                        ]);
                    }
                }
             }
             
             $message = '¡la Receta ha sido actualizada exitosamente!';
            
        }
        $this->reset($this->resetVariables);
        $this->identificador = rand();
        //emitir al mismo componente
        $this->dispatch('show-toast', type:"success", message: $message)->self();
        $this->dispatch('render')->to(ShowRecipes::class);
        $this->dispatch('render')->to(RecipesLivewire::class);
    }

    
    // Métodos auxiliares para crear y 
    //actualizar ingredientes y pasos de preparación


    private function updateIngredients($recipe){
        foreach ($this->ingredientes as $index => $ingrediente) {
            // Si ya existe un ingrediente en esa posición, actualizarlo
            if (isset($recipe->ingredients[$index])) {
                $recipe->ingredients[$index]->update([
                    'quantity' => $ingrediente['quantity'],
                    'unit' => $ingrediente['unit'],
                    'name' => $ingrediente['name'],
                    'measurement' => $ingrediente['measurement'],
                ]);
            }
        }
    }

    private function updatePreparationSteps($recipe){
        foreach ($this->pasos as $index => $paso) {
            // Si ya existe un paso en esa posición, actualizarlo
            if (isset($recipe->preparationSteps[$index])) {
                $recipe->preparationSteps[$index]->update([
                    'description_step' => $paso,
                ]);
            }
        }
    }
    //Frontend agregar o eliminar, paso,ingrediente,imagen
    public function abrirModal(){$this->reset($this->resetVariables); $this->openModal= true;}
    public function agregarIngrediente()
    { $this->ingredientes[] = ['quantity' => '', 'unit' =>'','name' => '', 'measurement' => '',];}

    public function eliminarIngrediente($index){ 
        unset($this->ingredientes[$index]);
        $this->ingredientes = array_values($this->ingredientes);
    }

    public function agregarPaso(){ $this->pasos[] = '';}

    public function eliminarPaso($index){
        unset($this->pasos[$index]);
        $this->pasos = array_values($this->pasos);
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

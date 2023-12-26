<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\PreparationStep;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::where('type','recipeAndMenu')->first();
        
        // Crear una receta
        $recipe = Recipe::create([
            'name' => 'Arroz con Leche',
            'description' => 'Deliciosa receta de arroz con leche.',
            'difficulty' => 'Fácil',
            'preparation_time' => '00:30:00', // 30 minutos
            'user_id' => 1,
            'category_id' => $category->id,
        ]);
        $recipe->multimedia()->create([
            'ruta' => 'rutadelaimagen.jpg o png',
            'type' => 'imagen',
        ]);

      // Crear pasos de INGREDIENTE
        Ingredient::create([
            'recipe_id' => $recipe->id,
            'quantity' => 1,
            'unit' =>'cucharada',
            'name' => 'azucar',
            'measurement' => '10g'

        ]);

        Ingredient::create([
            'recipe_id' => $recipe->id,
            'quantity' => 2,
            'unit' =>'cucharadas',
            'name' => 'canela',
            'measurement' => '20g'

        ]);


        // Crear pasos de preparación
        PreparationStep::create([
            'recipe_id' => $recipe->id,
            'step_Number' => 1,
            'description_step' => 'En una olla a fuego bajo, pon a cocinar por 15 minutos el agua, la astilla de canela y el arroz hasta que absorba la mayor parte del líquido.',
        ]);

        PreparationStep::create([
            'recipe_id' => $recipe->id,
            'step_Number' => 2,
            'description_step' => 'Agrega la leche y con una cuchara revuelve constantemente.',
        ]);

        PreparationStep::create([
            'recipe_id' => $recipe->id,
            'step_Number' => 3,
            'description_step' => 'Añade la LECHE CONDENSADA LA LECHERA® y sigue revolviendo hasta que el arroz se ablande y tome una consistencia cremosa. ',
        ]);
        PreparationStep::create([
            'recipe_id' => $recipe->id,
            'step_Number' => 4,
            'description_step' => ' Adiciona la CREMA DE LECHE NESTLÉ® y cocina sin dejar de revolver por 4 minutos más. ',
        ]);
        PreparationStep::create([
            'recipe_id' => $recipe->id,
            'step_Number' => 5,
            'description_step' => 'Por último, agrega las uvas pasas y revuelve para integrar todo. Apaga el fuego y retira la olla. ',
        ]);





        // Supongamos que ya tienes los modelos de Recipe e Ingredient y has creado una nueva receta
        $recipe = Recipe::create([
            'name' => 'Café con Leche',
            'description' => 'Deliciosa receta con leche.',
            'difficulty' => 'Fácil',
            'preparation_time' => '00:50:00', // 30 minutos
            'user_id' => 1,
            'category_id' => $category->id,
        ]);
        $recipe->multimedia()->create([
            'ruta' => 'rutadelaimagen.jpg o png',
            'type' => 'imagen',
        ]);

        // Supongamos que ya tienes el modelo de Ingredient y has obtenido la instancia correspondiente a la leche
        $ingredientLeche = Ingredient::where('name', 'Leche')->first();
        $ingredienteRepetido = Ingredient::firstOrCreate([
            'name' => 'Leche',
            'categoria' => 'Lácteo',
        ]);
        // Asociar ingredientes a la receta mediante la tabla pivot
        $recipe->ingredients()->attach($ingredienteRepetido->id, [
            'quantity' => '1 taza',
            'unit' => 'taza',
            'measurement' => '250 ml',
        ]);
        // Agregar la relación sin preocuparse por duplicados
        $recipe->ingredients()->attach($ingredientLeche->id, [
            'quantity' => 'Al gusto',
            'unit' => 'taza',
            'measurement' => 'Varía según preferencia',
        ]);

           // Crear pasos de preparación
           PreparationStep::create([
            'recipe_id' => $recipe->id,
            'step_Number' => 1,
            'description_step' => 'En una olla a fuego bajo,calentamos leche',
        ]);

        PreparationStep::create([
            'recipe_id' => $recipe->id,
            'step_Number' => 2,
            'description_step' => 'Agrega el cafe y revuelve',
        ]);

    }
}

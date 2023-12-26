<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\PreparationStep;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuzzleHttp\Client; //necesario para consumo api
use Svg\Tag\UseTag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    private function generarImagen()
    {
        $client = new Client();
        $response = $client->get('https://pixabay.com/api/', [
           'query' => [
               'q' => 'recipe',
               'key' => '32197405-8812e983959c5a943e2916bd1',
           ],
        ]);
        $imageData = json_decode($response->getBody(), true);
        $randomImageIndex = array_rand($imageData['hits']);
        $imageUrl = $imageData['hits'][$randomImageIndex]['largeImageURL'];

        // Generar un nombre único para la imagen
       $imageName = 'receta_' . uniqid() . '.jpg';

        // Descargar y guardar la imagen en tu directorio de imágenes de recetas
        $imagePath = 'public/storage/recipes/' . $imageName;
        file_put_contents($imagePath, file_get_contents($imageUrl));

        return 'recipes/' . $imageName;
       }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = Category::where('type', 'product')->first();
        $randomUserId = User::inRandomOrder()->first()->id;
        return  [
            'name' => implode(' ', $this->faker->words(1)),
            'description' => $this->faker->paragraph(3),
            'difficulty' => $this->faker->randomElement(['Fácil', 'Medio', 'Difícil']), // Aleatorio
            'preparation_time' => $this->faker->time(), // Aleatorio
            'user_id' => $randomUserId,
            'category_id' => $category->id
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Recipe $recipe) {
            // Agregar 4 imágenes a la receta
            for ($i = 0; $i < 4; $i++) {
                $image = $this->generarImagen(); 
                $recipe->multimedia()->create([
                    'ruta' => $image,
                    'type' => 'imagen',
                ]);
            }

        // Agregar  4 ingredientes y pasos de preparacion y al registro
        for ($i = 0; $i < 4; $i++) {
            Ingredient::create([
                'recipe_id' => $recipe->id,
                'quantity' =>  $this->faker->randomElement([1,2,3,4,5,6]),
                'unit' => $this->faker->randomElement(['Cucharada', 'Taza', 'libra','litro','kilogramo']),
                'name' => implode(' ', $this->faker->words(2)),
                'measurement' => '20g'
    
            ]);
         
            //pasos de la receta
            PreparationStep::create([
                'recipe_id' => $recipe->id,
                'step_Number' => $i+1,
                'description_step' =>$this->faker->paragraph(2),
            ]);
        }
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    private function generarImagen()
    {
        $client = new Client();
        $response = $client->get('https://pixabay.com/api/', [
            'query' => [
                'q' => 'menu',
                'key' => '32197405-8812e983959c5a943e2916bd1',
            ],
        ]);
        $imageData = json_decode($response->getBody(), true);
        $randomImageIndex = array_rand($imageData['hits']);
        $imageUrl = $imageData['hits'][$randomImageIndex]['largeImageURL'];

        // Generar un nombre único para la imagen
        $imageName = 'menu_' . uniqid() . '.jpg';

        // Descargar y guardar la imagen en tu directorio de imágenes de recetas
        $imagePath = 'public/storage/Menus/' . $imageName;
        file_put_contents($imagePath, file_get_contents($imageUrl));

        return 'Menus/' . $imageName;
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
        return [
            'name' => implode(' ', $this->faker->words(3)),
            'price' => $this->faker->randomNumber(4),
            'quantity' => $this->faker->randomNumber(4),
            'description' =>$this->faker->paragraph(3),
            'user_id' => $randomUserId,
            'category_id' => $category->id,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Menu $menu) {
            // Agregar 4 imágenes al plato o menu
            for ($i = 0; $i < 4; $i++) {
                $image = $this->generarImagen(); 
                $menu->multimedia()->create([
                    'ruta' => $image,
                    'type' => 'imagen',
                ]);
            }
        });
    }
}

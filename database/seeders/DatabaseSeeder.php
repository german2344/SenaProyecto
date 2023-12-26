<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $directories = ['recipes', 'products','Menus','profile-photos'];
        foreach ($directories as $directory) {
            Storage::deleteDirectory($directory);  //eliminar carpeta cuado se hace mifrate fresh o refresh si existiese
            Storage::makeDirectory($directory); //crea carpeta  en public/storage
        }
        // \App\Models\User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);
            $this->call([
                RoleSeeder::class,
                UsersTableSeeder::class,
                CategoriesSeeder::class,
                MenusTableSeeder::class,
                ProductsTableSeeder::class,
                // RecipesTableSeeder::class,
                CommentsTableSeeder::class,
            ]);
            \App\Models\User::factory(2)->create();
            \App\Models\Recipe::factory(3)->create();
            \App\Models\Product::factory(3)->create();
            \App\Models\Menu::factory(3)->create();
            \App\Models\Comment::factory(2)->create();
    }
}

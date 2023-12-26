<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $AdminRol = Role::create(['name'=>'Admin']);
    $AprendizRol = Role::create(['name'=>'Aprendiz']);
    $UsuarioRol = Role::create(['name'=>'Usuario']);

       Permission::create(['name'=>'admin.home','description'=>'entrar al dasboard'])->syncRoles([$AdminRol,$AprendizRol]);
        //recipes
       Permission::create(['name'=>'admin.recipes.index','description'=>'ver lista de recetas'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.recipes.store','description'=>'crear recetas'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.recipes.update','description'=>'actualizar recetas'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.recipes.destroy','description'=>'eliminar recetas'])->syncRoles([$AdminRol,$AprendizRol]);
        //products
       Permission::create(['name'=>'admin.products.index','description'=>'ver listado de productos'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.products.store','description'=>'crear productos'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.products.update','description'=>'actualizar productos'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.products.destroy','description'=>'eliminar productos'])->syncRoles([$AdminRol,$AprendizRol]);
        //comments
       Permission::create(['name'=>'admin.comments.index','description'=>'ver listado de comentarios'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.comments.store','description'=>'crear comentarios'])->syncRoles($AdminRol,$AprendizRol,$UsuarioRol);
       Permission::create(['name'=>'admin.comments.update','description'=>'actualizar comentarios'])->syncRoles($AdminRol,$AprendizRol,$UsuarioRol);
       Permission::create(['name'=>'admin.comments.destroy','description'=>'eliminar comentarios'])->syncRoles($AdminRol,$AprendizRol,$UsuarioRol);
        //users
       Permission::create(['name'=>'admin.users.index','description'=>'ver listado de usarios'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.users.store','description'=>'crear usaurios'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.users.update','description'=>'asignar rol a usuarios'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.users.destroy','description'=>'eliminar usuarios'])->syncRoles($AdminRol);
        //menus
       Permission::create(['name'=>'admin.menus.index','description'=>'ver listado de platos'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.menus.store','description'=>'crear platos'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.menus.update','description'=>'actualizar platos'])->syncRoles([$AdminRol,$AprendizRol]);
       Permission::create(['name'=>'admin.menus.destroy','description'=>'eliminar platos'])->syncRoles([$AdminRol,$AprendizRol]);
        //categories
       Permission::create(['name'=>'admin.categories.index','description'=>'ver listado de categorias'])->syncRoles($AdminRol);
       Permission::create(['name'=>'admin.categories.store','description'=>'crear categorias'])->syncRoles([$AdminRol]);
       Permission::create(['name'=>'admin.categories.update','description'=>'actualizar categorias'])->syncRoles([$AdminRol]);
       Permission::create(['name'=>'admin.categories.destroy','description'=>'eliminar categorias'])->syncRoles([$AdminRol]);

       Permission::create(['name'=>'admin.roles.index','description'=>'ver listado de rores'])->syncRoles([$AdminRol]);
       Permission::create(['name'=>'admin.dashboard.index','description'=>'ver estadisticas de la plicacion'])->syncRoles([$AdminRol]);
    } 
}


<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Puedes desactivar la protección de asignación masiva en el modelo o especificar valores aquí.
        $user = User::factory()->create([
            'name' => 'Luciano Balbiano',
            'email' => 'balbiano06@gmail.com',
            'password' => '$2y$10$hBgRjHVGu/FrggzMiDRAiu.TO9CCDpoooZKLoiiZlCyojpHorfrcu',
        ]);
        $userTwo = User::factory()->create([
            'name' => 'Alejandro Balbiano',
            'email' => 'alejandrobalbiano@gmail.com',
            'password' => '$2y$10$QytHNVBnJ64MHzJ.pxwvqu99E3c60Vczdh1dpdaah64Xh3nPuABiq', // @balbianoAlejandro123
        ]);
        $userThree = User::factory()->create([
            'name' => 'Carlos Romero',
            'email' => 'carlosromero@gmail.com',
            'password' => '$2y$10$jFSgW8U9A/7O.gN6F0IOseIMXVBdgPgY//82EyYowAzxCduVwoioG', // @carlosRomero123
        ]);

        // Crear rol
        $role = Role::create(['name' => 'admin']);

        // Crear permisos
        $permissionCreateUsers = Permission::create(['name' => 'create-users']);
        $permissionEditUsers = Permission::create(['name' => 'edit-users']); // Este permiso debe ser creado antes de ser usado

        // Asignar permisos al rol
        $role->givePermissionTo($permissionCreateUsers);
        $role->givePermissionTo($permissionEditUsers);

        // Asignar rol al usuario
        $user->assignRole('admin');
        $userTwo->assignRole('admin');
        $userThree->assignRole('admin');
    }
}
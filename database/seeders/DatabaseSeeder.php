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
        $role = Role::create(['name' => 'editor']);
        $role = Role::create(['name' => 'guest']);
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

        // Crear 10 empresas
        \App\Models\Company\Company::factory()->count(10)->create()->each(function ($company) {
            // Aquí también puedes relacionar cada empresa con proyectos o autores.
            // Por ejemplo, asignarle proyectos aleatorios a una empresa:
            $projectsIds = \App\Models\Projects\Project::inRandomOrder()->take(rand(1, 3))->get()->pluck('id');
            $company->projects()->attach($projectsIds, ['company_role' => 'Patrocinador']);

            if ($company->getMedia('image')->isEmpty()) {
                $company->copyMedia(public_path('images\default-company.png'))
                    ->withResponsiveImages()
                    ->toMediaCollection('image');
            }
        });

        \App\Models\Authors\Author::factory()->count(10)->create()->each(function ($author) {
            // Para cada autor, puedes crear una relación con proyectos y empresas.
            $author->projects()->attach(
                \App\Models\Projects\Project::factory()->create()->id,
                ['project_role' => 'Contributor'] // o cualquier rol que necesites asignar
            );
        
            $author->companies()->attach(
                \App\Models\Company\Company::factory()->create()->id,
                ['position' => 'Employee'] // o la posición que necesites asignar
            );
        
            // Asigna la imagen por defecto al autor si no tiene una.
            if ($author->getMedia('image')->isEmpty()) {
                $author->copyMedia(public_path('images\default-profile.jpg'))
                    ->withResponsiveImages()
                    ->toMediaCollection('image');
            }
        });        

         // Crear 10 proyectos
         \App\Models\Projects\Project::factory()->count(10)->create()->each(function ($project) {
            // Asignar autores aleatorios a un proyecto:
            $authorsIds = \App\Models\Authors\Author::inRandomOrder()->take(rand(1, 5))->get()->pluck('author_id');
            $project->authors()->attach($authorsIds, ['project_role' => 'Colaborador']);
        
            // Asigna la imagen por defecto al proyecto si no tiene una.
            if ($project->getMedia('image')->isEmpty()) {
                $project->copyMedia(public_path('images\default-project.jpg'))
                    ->withResponsiveImages()
                    ->toMediaCollection('image');
            }
        });        
    }
}
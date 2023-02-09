<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
       /* Role::factory(1)->create(
            [
                'nom' => 'admin',
                'description' => 'Administrateur',
            ]
        );
        
        Role::factory(1)->create(
            [
                'nom' => 'eleve',
                'description' => 'eleve',
            ]
        );

        Role::factory(1)->create(
            [
                'nom' => 'enseignant',
                'description' => 'enseignant',
            ]
        );

        \App\Models\User::factory(10)->create();
        */
        \App\Models\Personne::factory(10)->create();
    }
}

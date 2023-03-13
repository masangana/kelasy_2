<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(
            [
                'nom' => 'admin',
                'description' => 'Administrateur',
            ]
        );

        Role::create(
            [
                'nom' => 'prof',
                'description' => 'Enseignant',
            ]
        );

        Role::create(
            [
                'nom' => 'eleve',
                'description' => 'Etudiant',
            ]
        );

        Role::create(
            [
                'nom' => 'parent',
                'description' => 'Parent',
            ]
        );

        Role::create(
            [
                'nom' => 'finance',
                'description' => 'Utilisateur',
            ]
        );
    }
}

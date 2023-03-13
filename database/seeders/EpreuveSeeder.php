<?php

namespace Database\Seeders;

use App\Models\Epreuve;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EpreuveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Epreuve::create(
            [
                'nom' => 'Examen',
                'description' => 'Epreuve de fin de semestre ou trimestre',
            ]
        );

        Epreuve::create(
            [
                'nom' => 'Devoir',
                'description' => 'Epreuve de cours',
            ]
        );

        Epreuve::create(
            [
                'nom' => 'Interrogation',
                'description' => 'Epreuve de cours',
            ]
        );

        Epreuve::create(
            [
                'nom' => 'Interrogation Générale',
                'description' => 'Epreuve de cours',
            ]
        );

        Epreuve::create(
            [
                'nom' => 'Travail Pratique',
                'description' => 'Epreuve de cours',
            ]
        );
    }
}

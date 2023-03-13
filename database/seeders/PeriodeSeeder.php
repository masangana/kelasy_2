<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periode::create(
            [
                'nom' => 'Première Période',
                'slug' => 'Premiere-Periode',
            ]
        );

        Periode::create(
            [
                'nom' => 'Deuxième Période',
                'slug' => 'Deuxieme-Periode',
            ]
        );

        Periode::create(
            [
                'nom' => 'Troisième Période',
                'slug' => 'Troisieme-Periode',
            ]
        );

        Periode::create(
            [
                'nom' => 'Quatrième Période',
                'slug' => 'Quatrieme-Periode',
            ]
        );

        Periode::create(
            [
                'nom' => 'Cinquième Période',
                'slug' => 'Cinquieme-Periode',
            ]
        );

        Periode::create(
            [
                'nom' => 'Sixième Période',
                'slug' => 'Sixieme-Periode',
            ]
        );

        Periode::create(
            [
                'nom' => 'Premier Semestre',
                'slug' => 'Premier-Semestre',
            ]
        );

        Periode::create(
            [
                'nom' => 'Deuxième Semestre',
                'slug' => 'Deuxieme-Semestre',
            ]
        );

        Periode::create(
            [
                'nom' => 'Premier Trimestre',
                'slug' => 'Premier-Trimestre',
            ]
        );

        Periode::create(
            [
                'nom' => 'Deuxième Trimestre',
                'slug' => 'Deuxieme-Trimestre',
            ]
        );

        Periode::create(
            [
                'nom' => 'Troisième Trimestre',
                'slug' => 'Troisieme-Trimestre',
            ]
        );
    }
}

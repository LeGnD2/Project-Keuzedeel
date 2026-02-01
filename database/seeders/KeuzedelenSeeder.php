<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeuzedeelSeeder extends Seeder
{
    public function run(): void
    {
        $keuzedelen = [
            [
                'titel' => 'Webdevelopment',
                'beschrijving' => 'Leer moderne websites bouwen met HTML, CSS, JavaScript en frameworks zoals React en Laravel',
                'eisen' => 'Geen voorkennis vereist',
                'max_studenten' => 30,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ],
            [
                'titel' => 'Game Development',
                'beschrijving' => 'Maak je eigen games met Unity, C# en leer over game design principles',
                'eisen' => 'Basiskennis programmeren aanbevolen',
                'max_studenten' => 25,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ],
            [
                'titel' => 'Cybersecurity',
                'beschrijving' => 'Leer over ethical hacking, penetration testing en systeem beveiliging',
                'eisen' => 'Interesse in ICT security en netwerken',
                'max_studenten' => 20,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ],
            [
                'titel' => 'Mobile App Development',
                'beschrijving' => 'Bouw cross-platform apps voor Android en iOS met React Native',
                'eisen' => 'Ervaring met programmeren (JavaScript)',
                'max_studenten' => 30,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ],
            [
                'titel' => 'Data Science & AI',
                'beschrijving' => 'Leer data analyseren, machine learning en kunstmatige intelligentie met Python',
                'eisen' => 'Goede kennis van wiskunde en Python',
                'max_studenten' => 20,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ],
            [
                'titel' => 'Cloud Computing',
                'beschrijving' => 'Werk met AWS, Azure en Google Cloud. Leer over DevOps en container technologie',
                'eisen' => 'Kennis van Linux en netwerken',
                'max_studenten' => 25,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ],
            [
                'titel' => 'UI/UX Design',
                'beschrijving' => 'Ontwerp gebruiksvriendelijke interfaces met Figma en leer design thinking',
                'eisen' => 'Creatief inzicht, geen programmeer ervaring nodig',
                'max_studenten' => 30,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ],
            [
                'titel' => 'Database Management',
                'beschrijving' => 'Leer SQL, MySQL, PostgreSQL en database optimalisatie technieken',
                'eisen' => 'Basiskennis van databases',
                'max_studenten' => 25,
                'inschrijvingen' => 0,
                'status' => 'open',
                'aangemaakt_op' => now()
            ]
        ];

        // Verwijder oude keuzedelen eerst (optioneel)
        DB::table('keuzedelen')->truncate();

        // Voeg nieuwe keuzedelen toe
        DB::table('keuzedelen')->insert($keuzedelen);
    }
}
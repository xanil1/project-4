<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Oefening;

class OefeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Oefening::truncate();

        Oefening::Create([
            'name' => 'Squat',
            'description' => 'Een oefening waarbij je door je knieën buigt om je bilspieren, quadriceps en hamstrings te trainen.',
            'image' => 'images/Squat.png'
        ]);
        Oefening::Create([
            'name' => 'Push-up',
            'description' => 'Een oefening waarbij je je borst, triceps en schouders versterkt door je lichaam van de grond te duwen.',
            'image' => 'images/Push-up.png'
        ]);
        Oefening::Create([
            'name' => 'Dip',
            'description' => 'Een oefening gericht op je triceps, waarbij je je lichaam laat zakken en weer omhoog duwt met behulp van je armen.',
            'image' => 'images/Dip.png'
        ]);
        Oefening::Create([
            'name' => 'Plank',
            'description' => 'Een statische oefening die je core versterkt door je lichaam recht te houden als een plank.',
            'image' => 'images/Plank.png'
        ]);
        Oefening::Create([
            'name' => 'Paardentrap',
            'description' => 'Een dynamische oefening waarbij je je benen om de beurt omhoog trapt om je bilspieren en core te activeren.',
            'image' => 'images/Paardentrap.png'
        ]);
        Oefening::Create([
            'name' => 'Mountain Climber',
            'description' => 'Een cardio- en core-oefening waarbij je knieën snel richting je borst beweegt in een push-up positie.',
            'image' => 'images/Mountain-climber.png'
        ]);
        Oefening::Create([
            'name' => 'Burpee',
            'description' => 'Een volledige lichaamsworkout waarbij je squats, push-ups en sprongen combineert.',
            'image' => 'images/Burpee.png'
        ]);
        Oefening::Create([
            'name' => 'Lunge',
            'description' => 'Een oefening die je bilspieren en quadriceps versterkt door een diepe stap naar voren te maken.',
            'image' => 'images/Lunge.png'
        ]);
        Oefening::Create([
            'name' => 'Wall Sit',
            'description' => 'Een statische oefening waarbij je doet alsof je op een onzichtbare stoel tegen een muur zit.',
            'image' => 'images/Wall-sit.png'
        ]);
        Oefening::Create([
            'name' => 'Crunch',
            'description' => 'Een klassieke buikspieroefening waarbij je je schouders van de grond tilt en je core aanspant.',
            'image' => 'images/Crunch.png'
        ]);
    }
}

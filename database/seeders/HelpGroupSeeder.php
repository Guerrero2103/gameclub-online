<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HelpGroup;
use App\Models\HelpEntry;

class HelpGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorieAlgemeen = HelpGroup::create(['name' => 'Algemene Vragen']);

        $categorieAlgemeen->helpEntries()->create([
            'question' => 'Wat is Gameclub Online?',
            'answer' => 'Gameclub Online is een platform waar gamers samenkomen om nieuws te delen en contact te maken.',
        ]);

        $categorieAlgemeen->helpEntries()->create([
            'question' => 'Hoe kan ik lid worden?',
            'answer' => 'Je kunt lid worden door je te registreren op de website.',
        ]);

        $categorieTechnisch = HelpGroup::create(['name' => 'Technische Vragen']);

        $categorieTechnisch->helpEntries()->create([
            'question' => 'Ik kan niet inloggen, wat nu?',
            'answer' => 'Controleer je gebruikersnaam en wachtwoord. Als het probleem aanhoudt, neem dan contact op met de beheerder.',
        ]);

        $categorieTechnisch->helpEntries()->create([
            'question' => 'De website laadt traag.',
            'answer' => 'Probeer je browsercache te legen en je internetverbinding te controleren. Als het probleem blijft, laat het ons weten.',
        ]);
    }
}

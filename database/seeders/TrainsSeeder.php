<?php

namespace Database\Seeders;

use Faker\Generator as Faker;

use Illuminate\Database\Seeder;
use App\Models\Train;

class TrainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 100; $i++) {
            $train = new Train();
            $train->azienda = $faker->company();
            $train->stazione_partenza = $faker->city();
            $train->stazione_arrivo = $faker->city();
            $train->orario_partenza = $faker->time();
            $train->orario_arrivo = $faker->time();
            $train->giorno_partenza = $faker->date('Y-m-d', '+ 30 year');
            $train->giorno_arrivo = $faker->date('Y-m-d', '+ 30 year');
            $train->codice_treno = $faker->bothify('???-####');
            $train->numero_carrozze = $faker->numberBetween(8, 24);
            $train->in_orario = $faker->boolean();
            $train->cancellato = $faker->boolean();
            $train->save();
        }
    }

    /*
    // Example for manual seed
    public function run(): void
    {
        $trains = [
            [
                'azienda' => 'Trenitalia',
                'stazione_partenza' => 'Milano',
                'stazione_arrivo' => 'Roma',
                'orario_partenza' => '10:00',
                'orario_arrivo' => '12:00',
                'giorno_partenza' => '2022-01-01',
                'giorno_arrivo' => '2022-01-01',
                'codice_treno' => '1234',
                'numero_carrozze' => 20,
                'in_orario' => true,
                'cancellato' => false
            ],
            .... more arrays
            ]
        ]

        foreach ($trains as $train) {
            $train = new Train();
            $train->azienda = $train['azienda'];
            $train->stazione_partenza = $train['stazione_partenza'];
            $train->stazione_arrivo = $train['stazione_arrivo'];
            $train->orario_partenza = $train['orario_partenza'];
            $train->orario_arrivo = $train['orario_arrivo'];
            $train->giorno_partenza = $train['giorno_partenza'];
            $train->giorno_arrivo = $train['giorno_arrivo'];
            $train->codice_treno = $train['codice_treno'];
            $train->numero_carrozze = $train['numero_carrozze'];
            $train->in_orario = $train['in_orario'];
            $train->cancellato = $train['cancellato'];
            $train->save();
        }
        
    }

    */
}

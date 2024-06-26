# Task:

Fabio Pacifici
:boolean:  13:16
Ciao @qui,
Esercizio di oggi nome repo: laravel-migration-seeder
Creiamo una tabella trains e relativa Migration
Ogni treno dovrà avere almeno:
Azienda
Stazione di partenza
Stazione di arrivo
Orario di partenza
Orario di arrivo
Codice Treno
Numero Carrozze
In orario
Cancellato
È probabile che siano necessarie altre colonne per far funzionare la tabella nel modo corretto :occhiolino:
Inserite inizialmente i dati tramite PhpMyAdmin o artisan tinker per chi ne ha capito l'utilizzo.
Create il modello Model relativo alla migrazione che avete predisposto al fine di mappare la tabelle del db ed un Controller per mostrare nella home page tutti i treni che sono in partenza dalla data odierna.
Confermate lettura come al solito e buon divertimento :baby-yoda:

# Execution:

## Create a Database:

1. Open PhpMyAdmin and create a new database: `laravel_migration_seeder`
2. Go to .env file and change `DB_DATABASE=laravel` to `DB_DATABASE=laravel_migration_seeder`

## Table layout:

1. id (laravel automatic value)
2. azienda VARCHAR(30) 
3. stazione_partenza VARCHAR(50)
4. stazione_arrivo VARCHAR(50)
5. orario_partenza TIME
6. orario_arrivo TIME
7. codice_treno VARCHAR(10)
8. carrozze TINYINT
9. in_orario BOOLEAN
10. cancellato BOOLEAN
11. created_at (laravel automatic value)
12. updated_at (laravel automatic value)

### Create table:

1. Write in power shell: 
   
```powershell
php artisan make:migration create_trains_table 
```

2. Configure the migration with that code:

```php
<?php  

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('azienda', 50)->nullable();
            $table->string('stazione_partenza', 50);
            $table->string('stazione_arrivo', 50);
            $table->time('orario_partenza');
            $table->time('orario_arrivo');
            $table->string('codice_treno', 10);
            $table->tinyInteger('numero_carrozze')->nullable();
            $table->boolean('in_orario')->default(1);
            $table->boolean('cancellato')->default(0);
            $table->timestamps();
        });
    }
};
```

3. Run the migration:
```powershell
php artisan migrate
```
**Put yes**

4. Check the table in PhpMyAdmin

## Controller:

### Creating the controller

1. Write in power shell: php artisan make:controller Guests\TrainController
2. Configure the controller with that code (Ricorda la figa di use App\Models\Train):

```php
<?php               

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Train;

class TrainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trains = Train::all();
        return view('home', compact('trains'));
    }   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Train $train)
    {
        return view('guests.train.show', compact('train'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Train $train)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Train $train)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Train $train)
    {
        //
    }
}
```

## Model:

1. Write in power shell: php artisan make:model Train
2. Check if model have this code (sicuramente è cosi quindi non metterci mano):

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;
}
```

## Artisan Tinker:

1. open artisan tinker: 
2. 
   ```powershell
   php artisan tinker
   ```

3. Use the following template (Ricorda il new e le cazzo di \):
   
```powerShell
$train = new App\Models\Train();
$train->azienda = 'Italo';
$train->stazione_partenza = 'Roma';
$train->stazione_arrivo = 'Bergamo';
$train->orario_partenza = '20:00';
$train->orario_arrivo = '23:00';
$train->codice_treno = 'ITA37443';
$train->numero_carrozze = 10;
$train->in_orario = true;
$train->cancellato = false;
$train->save();
```

**invio per confermare il save e riutilizzare il template**

4. write exit and check the result in PhpMyAdmin

## Seeder:

1. Write in power shell: php artisan make:seeder TrainsSeeder
2. Configure the seeder with that code:

```php
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
            $train->giorno_partenza = $faker->date('Y-m-d', '+ 1 year');
            $train->giorno_arrivo = $faker->date('Y-m-d', '+ 1 year');
            $train->codice_treno = $faker->bothify('???-####');
            $train->numero_carrozze = $faker->numberBetween(8, 24);
            $train->in_orario = $faker->boolean();
            $train->cancellato = $faker->boolean();
            $train->save();
        }
    }
}
```

3. Use on power shell: php artisan db:seed TrainsSeeder

## Display datas on page:

1. set up the routes:
```php
<?php       

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guests\TrainController;  

Route::get('/', [TrainController::class, 'index'])->name('home');
```

2. set up the controller to display trains to departure from now:
```php
<?php
namespace App\Http\Controllers\Guests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Train;  

class TrainController extends Controller
{
    public function index()
    {
        $actualTime = now()->format('H:i');
        $trains = Train::whereTime('orario_partenza', '>' , $actualTime )->get();
        return view('guests.index', compact('trains'));
    } 
}
....
```

1. Create the view: `layouts/app.blade.php` and insert the code:

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/js/app.js')

</head>

<body>
    
    <header>Header</header>

    <main>
        @yield('content')
    </main>

    <footer>Footer</footer>

</body>

</html>
```

2. Create the view: `guests/index.blade.php` and insert the code:

```php
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Treni</h1>
        <div class="row">
            @forelse ($trains as $train)
                <div class="col-3">
                    <div class="card">
                        <h2>{{ $train->codice_treno }}</h2>
                        <h3>{{ $train->azienda }}</h3>
                        <h3>{{ $train->stazione_partenza }}</h3>
                        <h3>{{ $train->stazione_arrivo }}</h3>
                        <h3>{{ $train->orario_partenza }}</h3>
                        <h3>{{ $train->orario_arrivo }}</h3>
                        <h3>{{ $train->numero_carrozze }}</h3>
                        @if ($train->in_orario == 1)
                            <h3>In Orario</h3>
                        @elseif ($train->cancellato == 1)
                            <h3>Cancellato</h3>
                        @else
                            <h3>In ritardo</h3>
                        @endif

                    </div>
                </div>

            @empty

                <h2>No more trains available at the moment</h2>
            @endforelse
        </div>
    </div>
@endsection
```

## Conclusion:

### GOOD JOB!!! have fun with css :(

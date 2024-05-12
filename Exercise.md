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
            $table->string('azienda', 30)->nullable();
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

## Display datas on page:




@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Treni</h1>
        <div class="row">
            @forelse ($trains as $train)
                <div class="col-4">
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

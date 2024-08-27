@extends('frontend.layout')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Résultats de la Recherche</h2>

    @if($events->count() > 0)
        <div class="row">
            @foreach($events as $event)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text">{{ $event->description }}</p>
                            <a href="{{ route('event.show', $event->id) }}" class="btn btn-primary">Voir les Détails</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info" role="alert">
            Aucun événement trouvé pour votre recherche.
        </div>
    @endif
</div>
@endsection

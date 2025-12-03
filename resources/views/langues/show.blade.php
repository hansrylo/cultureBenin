@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Détails de la langue</h3>
        </div>
        <div class="card-body">
            <p><strong>Id_langue :</strong> {{ $langue->id_langue }}</p>
            <p><strong>Code :</strong> {{ $langue->code_langue }}</p>
            <p><strong>Nom :</strong> {{ $langue->nom_langue }}</p>
            <p><strong>Description :</strong> {{ $langue->description ?? 'Aucune description' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('langues.edit', $langue->id_langue) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
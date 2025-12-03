@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Détails du type de média</h3>
        </div>
        <div class="card-body">
            <p><strong>ID :</strong> {{ $type_media->id_type }}</p>
            <p><strong>Nom du type :</strong> {{ $type_media->nom_type }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('types_media.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('types_media.edit', $type_media->id_type) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
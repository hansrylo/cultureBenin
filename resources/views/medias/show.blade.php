@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Détails du média</h3>
        </div>
        <div class="card-body">
            <p><strong>ID :</strong> {{ $media->id_media }}</p>
            <p><strong>Chemin :</strong> {{ $media->chemin }}</p>
            <p><strong>Description :</strong> {{ $media->description }}</p>
            <p><strong>Type :</strong> {{ $media->id_type }}</p>
            <p><strong>Contenu :</strong> {{ $media->id_contenu }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('medias.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('medias.edit', $media->id_media) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Détails du type de contenu</h3>
        </div>
        <div class="card-body">
            <p><strong>ID :</strong> {{ $type_contenu->id_type }}</p>
            <p><strong>Nom du type :</strong> {{ $type_contenu->nom }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('types_contenu.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('types_contenu.edit', $type_contenu->id_type) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
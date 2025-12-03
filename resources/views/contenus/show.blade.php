@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Détails du contenu</h3>
        </div>
        <div class="card-body">
            <p><strong>ID :</strong> {{ $contenu->id_contenu }}</p>
            <p><strong>Titre :</strong> {{ $contenu->titre }}</p>
            <p><strong>Type :</strong> {{ $contenu->id_type }}</p>
            <p><strong>Texte :</strong> {{ $contenu->texte }}</p>
            <p><strong>Date Création :</strong> {{ $contenu->date_creation }}</p>
            <p><strong>Statut :</strong> {{ $contenu->statut }}</p>
            <p><strong>Auteur :</strong> {{ $contenu->id_auteur }}</p>
            <p><strong>Langue :</strong> {{ $contenu->id_langue }}</p>
            <p><strong>Région :</strong> {{ $contenu->id_region }}</p>
            <p><strong>Parent :</strong> {{ $contenu->parent ?? 'Aucun' }}</p>
            <p><strong>Modérateur :</strong> {{ $contenu->id_moderateur ?? 'Aucun' }}</p>
            <p><strong>Date Validation :</strong> {{ $contenu->date_validation ?? 'Non validé' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('contenus.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('contenus.edit', $contenu->id_contenu) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection

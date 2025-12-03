@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Détails du commentaire</h3>
        </div>
        <div class="card-body">
            <p><strong>ID :</strong> {{ $commentaire->id_commentaire }}</p>
            <p><strong>Texte :</strong> {{ $commentaire->texte }}</p>
            <p><strong>Date :</strong> {{ $commentaire->date }}</p>
            <p><strong>Note :</strong> {{ $commentaire->note }}</p>
            <p><strong>ID Utilisateur :</strong> {{ $commentaire->id_utilisateur }}</p>
            <p><strong>ID Contenu :</strong> {{ $commentaire->id_contenu }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('commentaires.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('commentaires.edit', $commentaire->id_commentaire) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
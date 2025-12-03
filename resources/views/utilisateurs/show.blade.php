@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Détails de l'utilisateur</h3>
        </div>
        <div class="card-body">
            <p><strong>ID :</strong> {{ $utilisateur->id_utilisateur }}</p>
            <p><strong>Nom :</strong> {{ $utilisateur->nom }}</p>
            <p><strong>Prénom :</strong> {{ $utilisateur->prenom }}</p>
            <p><strong>Email :</strong> {{ $utilisateur->email }}</p>
            <p><strong>Rôle :</strong> {{ $utilisateur->role }}</p>
            <p><strong>Langue préférée :</strong> {{ $utilisateur->langue ? $utilisateur->langue->nom_langue : 'Non définie' }}</p>
            <p><strong>Date de naissance :</strong> {{ $utilisateur->date_naissance }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('utilisateurs.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('utilisateurs.edit', $utilisateur->id_utilisateur) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</div>
@endsection
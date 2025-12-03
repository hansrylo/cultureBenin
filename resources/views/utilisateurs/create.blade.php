@extends('layout')

@section('content')

<style>
.create-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 1rem;
    width: 100%;
    min-height: calc(100vh - 60px);
    background: #f8f9fa;
}

.create-container {
    width: 100%;
    max-width: 800px;
    background: #fff;
    border: 1px solid #eaeaea;
    border-radius: 6px;
    overflow: hidden;
}

.card {
    border: none;
}

.card-header {
    background: #fff;
    color: #333;
    padding: 1.25rem 1.5rem;
    border-bottom: 2px solid #f0f0f0;
}

.card-title {
    font-weight: 500;
    font-size: 1.2rem;
    margin: 0;
}

.card-body {
    padding: 2rem 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: #495057;
}

.form-control {
    width: 100%;
    padding: 0.65rem 0.75rem;
    border: 1px solid #ced4da;
    border-radius: 4px;
    font-size: 0.95rem;
    transition: border-color 0.2s ease;
}

.form-control:focus {
    outline: none;
    border-color: #6c757d;
    box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
}

.alert {
    padding: 0.75rem 1rem;
    border-radius: 4px;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background-color: #f8d7da;
    border: 1px solid #f5c2c7;
    color: #842029;
}

.alert ul {
    margin: 0;
    padding-left: 1.5rem;
}

.card-footer {
    background: #f8f9fa;
    padding: 1rem 1.5rem;
    border-top: 1px solid #e9ecef;
    display: flex;
    gap: 0.75rem;
}

.btn {
    padding: 0.5rem 1.25rem;
    border-radius: 4px;
    font-size: 0.9rem;
    font-weight: 500;
    cursor: pointer;
    border: 1px solid;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-block;
}

.btn-primary {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
    color: #fff;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
}

.form-text {
    display: block;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #6c757d;
}

.required {
    color: #dc3545;
}
</style>

<div class="create-page">
    <div class="create-container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Créer un nouvel utilisateur</h3>
            </div>
            
            <form action="{{ route('utilisateurs.store') }}" method="POST">
                @csrf
                
                <div class="card-body">
                    <!-- Affichage des erreurs -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Erreur(s) de validation :</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Nom -->
                    <div class="form-group">
                        <label for="nom">
                            Nom <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('nom') is-invalid @enderror" 
                            id="nom" 
                            name="nom" 
                            value="{{ old('nom') }}" 
                            required
                        >
                        @error('nom')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Prénom -->
                    <div class="form-group">
                        <label for="prenom">
                            Prénom <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('prenom') is-invalid @enderror" 
                            id="prenom" 
                            name="prenom" 
                            value="{{ old('prenom') }}" 
                            required
                        >
                        @error('prenom')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">
                            Email <span class="required">*</span>
                        </label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                        >
                        @error('email')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div class="form-group">
                        <label for="mot_de_passe">
                            Mot de passe <span class="required">*</span>
                        </label>
                        <input 
                            type="password" 
                            class="form-control @error('mot_de_passe') is-invalid @enderror" 
                            id="mot_de_passe" 
                            name="mot_de_passe" 
                            required
                        >
                        @error('mot_de_passe')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="form-group">
                        <label for="role">
                            Rôle <span class="required">*</span>
                        </label>
                        <select 
                            class="form-control @error('role') is-invalid @enderror" 
                            id="role" 
                            name="role" 
                            required
                        >
                            <option value="">Sélectionner un rôle</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id_role }}" 
                                    {{ (old('role') == $role->id_role) || (old('role') == null && strtolower($role->nom_role) == 'lecteur') ? 'selected' : '' }}>
                                    {{ $role->nom_role }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Langue -->
                    <div class="form-group">
                        <label for="id_langue">
                            Langue préférée
                        </label>
                        <select 
                            class="form-control @error('id_langue') is-invalid @enderror" 
                            id="id_langue" 
                            name="id_langue"
                        >
                            <option value="">Sélectionner une langue</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_langue')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Date de naissance -->
                    <div class="form-group">
                        <label for="date_naissance">
                            Date de naissance
                        </label>
                        <input 
                            type="date" 
                            class="form-control @error('date_naissance') is-invalid @enderror" 
                            id="date_naissance" 
                            name="date_naissance" 
                            value="{{ old('date_naissance') }}"
                        >
                        @error('date_naissance')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <p style="font-size: 0.875rem; color: #6c757d; margin-top: 1.5rem;">
                        <span class="required">*</span> Champs obligatoires
                    </p>
                </div>

                <div class="card-footer">
                    <a href="{{ route('utilisateurs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Créer l'utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
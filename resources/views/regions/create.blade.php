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

textarea.form-control {
    min-height: 100px;
    resize: vertical;
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
                <h3 class="card-title">Créer une nouvelle région</h3>
            </div>
            
            <form action="{{ route('regions.store') }}" method="POST">
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

                    <!-- Nom Region -->
                    <div class="form-group">
                        <label for="nom_region">
                            Nom de la région <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('nom_region') is-invalid @enderror" 
                            id="nom_region" 
                            name="nom_region" 
                            value="{{ old('nom_region') }}" 
                            placeholder="Ex: Atlantique, Littoral"
                            required
                        >
                        <small class="form-text">Nom complet de la région</small>
                        @error('nom_region')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea 
                            class="form-control @error('description') is-invalid @enderror" 
                            id="description" 
                            name="description"
                            placeholder="Description ou informations supplémentaires sur cette région (optionnel)"
                        >{{ old('description') }}</textarea>
                        <small class="form-text">Informations complémentaires (optionnel)</small>
                        @error('description')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Population -->
                    <div class="form-group">
                        <label for="population">Population</label>
                        <input 
                            type="number" 
                            class="form-control @error('population') is-invalid @enderror" 
                            id="population" 
                            name="population" 
                            value="{{ old('population') }}" 
                            placeholder="Ex: 1000000"
                        >
                        <small class="form-text">Nombre d'habitants (optionnel)</small>
                        @error('population')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Superficie -->
                    <div class="form-group">
                        <label for="superficie">Superficie (km²)</label>
                        <input 
                            type="number" 
                            step="0.01"
                            class="form-control @error('superficie') is-invalid @enderror" 
                            id="superficie" 
                            name="superficie" 
                            value="{{ old('superficie') }}" 
                            placeholder="Ex: 1234.56"
                        >
                        <small class="form-text">Superficie en km² (optionnel)</small>
                        @error('superficie')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Localisation -->
                    <div class="form-group">
                        <label for="localisation">Localisation</label>
                        <input 
                            type="text" 
                            class="form-control @error('localisation') is-invalid @enderror" 
                            id="localisation" 
                            name="localisation" 
                            value="{{ old('localisation') }}" 
                            placeholder="Ex: Sud du Bénin"
                        >
                        <small class="form-text">Situation géographique (optionnel)</small>
                        @error('localisation')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <p style="font-size: 0.875rem; color: #6c757d; margin-top: 1.5rem;">
                        <span class="required">*</span> Champs obligatoires
                    </p>
                </div>

                <div class="card-footer">
                    <a href="{{ route('regions.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Créer la région
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
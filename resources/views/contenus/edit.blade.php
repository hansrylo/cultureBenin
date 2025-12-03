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
                <h3 class="card-title">Modifier le contenu</h3>
            </div>
            
            <form action="{{ route('contenus.update', $contenu->id_contenu) }}" method="POST">
                @csrf
                @method('PUT')
                
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

                    <!-- Titre -->
                    <div class="form-group">
                        <label for="titre">
                            Titre <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('titre') is-invalid @enderror" 
                            id="titre" 
                            name="titre" 
                            value="{{ old('titre', $contenu->titre) }}" 
                            required
                        >
                        @error('titre')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Type de contenu -->
                    <div class="form-group">
                        <label for="id_type">
                            Type de contenu <span class="required">*</span>
                        </label>
                        <select 
                            class="form-control @error('id_type') is-invalid @enderror" 
                            id="id_type" 
                            name="id_type" 
                            required>
                            <option value="">-- Sélectionnez un type --</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id_type }}" {{ old('id_type', $contenu->id_type) == $type->id_type ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_type')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Texte -->
                    <div class="form-group">
                        <label for="texte">
                            Texte <span class="required">*</span>
                        </label>
                        <textarea 
                            class="form-control @error('texte') is-invalid @enderror" 
                            id="texte" 
                            name="texte"
                            required
                        >{{ old('texte', $contenu->texte) }}</textarea>
                        @error('texte')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>


                    <!-- Statut -->
                    <div class="form-group">
                        <label for="statut">
                            Statut <span class="required">*</span>
                        </label>
                        <select 
                            class="form-control @error('statut') is-invalid @enderror" 
                            id="statut" 
                            name="statut" 
                            required>
                            <option value="en attente" {{ old('statut', $contenu->statut) == 'en attente' ? 'selected' : '' }}>En attente</option>
                            <option value="validé" {{ old('statut', $contenu->statut) == 'validé' ? 'selected' : '' }}>Validé</option>
                            <option value="rejeté" {{ old('statut', $contenu->statut) == 'rejeté' ? 'selected' : '' }}>Rejeté</option>
                        </select>
                        @error('statut')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Premium et Prix -->
                    <div class="form-group" style="background: #f8f9fa; padding: 1rem; border-radius: 4px; border: 1px solid #e9ecef;">
                        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                            <input 
                                type="checkbox" 
                                id="est_premium" 
                                name="est_premium" 
                                value="1" 
                                {{ old('est_premium', $contenu->est_premium) ? 'checked' : '' }}
                                style="width: auto; margin-right: 0.5rem;"
                            >
                            <label for="est_premium" style="margin-bottom: 0; cursor: pointer;">
                                Contenu Premium (Payant)
                            </label>
                        </div>
                        
                        <div id="prix_container" style="display: {{ old('est_premium', $contenu->est_premium) ? 'block' : 'none' }};">
                            <label for="prix">
                                Prix (XOF) <span class="required">*</span>
                            </label>
                            <input 
                                type="number" 
                                class="form-control @error('prix') is-invalid @enderror" 
                                id="prix" 
                                name="prix" 
                                value="{{ old('prix', $contenu->prix) }}" 
                                placeholder="Ex: 500"
                                min="0"
                                step="100"
                            >
                            @error('prix')
                                <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <script>
                        document.getElementById('est_premium').addEventListener('change', function() {
                            document.getElementById('prix_container').style.display = this.checked ? 'block' : 'none';
                        });
                    </script>


                    <!-- Langue -->
                    <div class="form-group">
                        <label for="id_langue">
                            Langue <span class="required">*</span>
                        </label>
                        <select 
                            class="form-control @error('id_langue') is-invalid @enderror" 
                            id="id_langue" 
                            name="id_langue" 
                            required>
                            <option value="">-- Sélectionnez une langue --</option>
                            @foreach($langues as $langue)
                                <option value="{{ $langue->id_langue }}" {{ old('id_langue', $contenu->id_langue) == $langue->id_langue ? 'selected' : '' }}>
                                    {{ $langue->nom_langue }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_langue')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Région -->
                    <div class="form-group">
                        <label for="id_region">
                            Région <span class="required">*</span>
                        </label>
                        <select 
                            class="form-control @error('id_region') is-invalid @enderror" 
                            id="id_region" 
                            name="id_region" 
                            required>
                            <option value="">-- Sélectionnez une région --</option>
                            @foreach($regions as $region)
                                <option value="{{ $region->id_region }}" {{ old('id_region', $contenu->id_region) == $region->id_region ? 'selected' : '' }}>
                                    {{ $region->nom_region }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_region')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Contenu parent -->
                    <div class="form-group">
                        <label for="parent">Contenu parent (optionnel)</label>
                        <select 
                            class="form-control @error('parent') is-invalid @enderror" 
                            id="parent" 
                            name="parent">
                            <option value="">-- Aucun parent --</option>
                            @foreach($contenus as $c)
                                <option value="{{ $c->id_contenu }}" {{ old('parent', $contenu->parent) == $c->id_contenu ? 'selected' : '' }}>
                                    {{ $c->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent')
                            <small style="color: #dc3545; display: block; margin-top: 0.25rem;">{{ $message }}</small>
                        @enderror
                    </div>

                    <p style="font-size: 0.875rem; color: #6c757d; margin-top: 1.5rem;">
                        <span class="required">*</span> Champs obligatoires
                    </p>
                </div>

                <div class="card-footer">
                    <a href="{{ route('contenus.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

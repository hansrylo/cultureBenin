@extends('layout')

@section('content')

<style>
.show-page {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 1rem;
    width: 100%;
    min-height: calc(100vh - 60px);
    background: #f8f9fa;
}

.show-container {
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

.detail-group {
    margin-bottom: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 1rem;
}

.detail-group:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.detail-label {
    font-weight: 600;
    color: #495057;
    display: block;
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.detail-value {
    font-size: 1.1rem;
    color: #212529;
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

.btn-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: #000;
}

.btn-warning:hover {
    background-color: #ffca2c;
    border-color: #ffc720;
}
</style>

<div class="show-page">
    <div class="show-container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Détails du rôle</h3>
            </div>
            
            <div class="card-body">
                <div class="detail-group">
                    <span class="detail-label">ID</span>
                    <span class="detail-value">{{ $role->id_role }}</span>
                </div>

                <div class="detail-group">
                    <span class="detail-label">Nom du rôle</span>
                    <span class="detail-value">{{ $role->nom_role }}</span>
                </div>
                
                <div class="detail-group">
                    <span class="detail-label">Date de création</span>
                    <span class="detail-value">{{ $role->created_at ? $role->created_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>

                <div class="detail-group">
                    <span class="detail-label">Dernière modification</span>
                    <span class="detail-value">{{ $role->updated_at ? $role->updated_at->format('d/m/Y H:i') : 'N/A' }}</span>
                </div>
            </div>

            <div class="card-footer">
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <a href="{{ route('roles.edit', $role->id_role) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Modifier
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

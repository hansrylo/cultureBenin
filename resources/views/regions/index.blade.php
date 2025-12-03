@extends('layout')

@section('content')

<!-- CSS spécifique à cette page -->
<style>
    /* Modal de confirmation */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .modal-overlay.active {
        display: flex;
    }

    .modal-content {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
        color: #dc3545;
    }

    .modal-header i {
        font-size: 2rem;
    }

    .modal-header h3 {
        margin: 0;
        font-size: 1.3rem;
    }

    .modal-body {
        margin-bottom: 1.5rem;
        color: #495057;
        line-height: 1.6;
    }

    .modal-body strong {
        color: #dc3545;
    }

    .modal-footer {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .btn-modal {
        padding: 0.5rem 1.25rem;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        border: 1px solid;
        transition: all 0.2s ease;
    }

    .btn-cancel {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #fff;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
    }

    .btn-confirm-delete {
        background-color: #dc3545;
        border-color: #dc3545;
        color: #fff;
    }

    .btn-confirm-delete:hover {
        background-color: #bb2d3b;
    }

    /* Messages de succès/erreur */
    .alert {
        padding: 1rem 1.25rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        animation: slideDown 0.3s ease-out;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert-success {
        background-color: #d1e7dd;
        border-left: 4px solid #0f5132;
        color: #0f5132;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-left: 4px solid #842029;
        color: #842029;
    }

    .alert-warning {
        background-color: #fff3cd;
        border-left: 4px solid #997404;
        color: #997404;
    }

    .alert-info {
        background-color: #cff4fc;
        border-left: 4px solid #055160;
        color: #055160;
    }

    .alert i {
        font-size: 1.25rem;
    }

    .alert-message {
        flex: 1;
        font-weight: 500;
    }

    .alert-close {
        background: transparent;
        border: none;
        font-size: 1.5rem;
        color: inherit;
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.2s;
        padding: 0;
        line-height: 1;
    }

    .alert-close:hover {
        opacity: 1;
    }

    .alerts-container {
        width: 100%;
        max-width: 1200px;
        margin-bottom: 0;
    }

    .langues-page {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1.5rem 0.5rem;
        width: 100%;
        min-height: calc(100vh - 60px);
        background: #f8f9fa;
    }

    .controls-container {
        width: 100%;
        max-width: 1200px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        gap: 1rem;
    }

    .controls-left {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .controls-right {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .btn-create {
        font-size: 0.85rem;
        padding: 0.45rem 1rem;
        border-radius: 4px;
        font-weight: 500;
        transition: all 0.2s ease;
        background-color: #6c757d;
        border: 1px solid #6c757d;
        color: #fff;
        white-space: nowrap;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .btn-create:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #fff;
    }


    /* Container avec scroll */
    .langues-container {
        width: 100%;
        max-width: 1200px;
        background: #fff;
        border: 1px solid #eaeaea;
        border-radius: 6px;
        overflow: hidden;
        /* Garde ça */
    }

    /* Wrapper pour le scroll */
    .table-responsive {
        overflow-x: auto;
        overflow-y: visible;
        -webkit-overflow-scrolling: touch;
        /* Smooth scroll sur mobile */
    }

    /* Style de la scrollbar */
    .table-responsive::-webkit-scrollbar {
        height: 10px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f8f9fa;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #6c757d;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #5a6268;
    }

    /* Pour Firefox */
    .table-responsive {
        scrollbar-width: thin;
        scrollbar-color: #6c757d #f8f9fa;
    }

    /* Table avec scroll - garde la largeur minimale */
    #LanguesTable {
        width: 100%;
        min-width: 800px;
        /* Largeur minimale avant scroll */
        border-collapse: separate;
        border-spacing: 0;
        margin: 0 !important;
        font-size: 0.9rem;
    }

    #LanguesTable thead th {
        background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
        font-weight: 600;
        padding: 0.75rem 1rem;
        /* Réduit de 1.25rem à 0.75rem */
        text-transform: uppercase;
        font-size: 0.75rem;
        /* Réduit de 0.8rem à 0.75rem */
        letter-spacing: 0.5px;
        border-bottom: 2px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        text-align: left;
        position: relative;
    }

    #LanguesTable thead th:last-child {
        border-right: none;
    }

    #LanguesTable thead th:first-child {
        width: 20%;
        border-top-left-radius: 0;
    }

    #LanguesTable thead th:last-child {
        width: 20%;
        text-align: center;
        border-top-right-radius: 0;
    }

    #LanguesTable tbody td {
        padding: 0.65rem 1rem;
        /* Réduit de 1.25rem à 0.65rem */
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
        border-right: 1px solid #f8f9fa;
        background-color: #fff;
        transition: all 0.2s ease;
        white-space: nowrap;
        /* Empêche le retour à la ligne */
    }

    #LanguesTable tbody td:last-child {
        border-right: none;
        text-align: center;
    }

    #LanguesTable tbody tr {
        transition: all 0.2s ease;
    }

    #LanguesTable tbody tr:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    #LanguesTable tbody tr:hover td {
        background-color: #f8f9fa;
    }

    .btn-action {
        border: none;
        background: transparent;
        padding: 0.3rem 0.4rem; /* Réduit */
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.95rem; /* Réduit de 1.1rem à 0.95rem */
        margin: 0 2px; /* Réduit l'espacement */
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative;
}

    .btn-action::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 6px;
        background: currentColor;
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .btn-action:hover::before {
        opacity: 0.1;
    }

    .btn-show {
        color: #0d6efd;
    }

    .btn-show:hover {
        color: #0b5ed7;
        transform: scale(1.2);
    }

    .btn-edit {
        color: #ffc107;
    }

    .btn-edit:hover {
        color: #ffb300;
        transform: scale(1.2);
    }

    .btn-delete {
        color: #dc3545;
    }

    .btn-delete:hover {
        color: #bb2d3b;
        transform: scale(1.2);
    }



    /* DataTables wrapper */
    .dataTables_wrapper {
        padding: 1.5rem;
    }

    /* Search input styling - Amélioré */
    .dataTables_filter {
        margin: 0 !important;
    }

    .dataTables_filter label {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        color: #495057;
    }

    .dataTables_filter label {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
}

    .dataTables_filter input {
        padding: 0.5rem 0.75rem;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        width: 250px;
        font-size: 0.9rem;
        margin: 0 !important;
        background-color: #fff;
        color: #495057;
        transition: all 0.3s ease;
    }

    

    .dataTables_filter input::placeholder {
        color: #adb5bd;
    }

    /* Length menu styling - Amélioré */
    .dataTables_length {
        margin: 0 !important;
    }

    .dataTables_length label {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        color: #495057;
    }

    .dataTables_length select {
        padding: 0.5rem 2rem 0.5rem 0.75rem;
        border-radius: 6px;
        border: 2px solid #e9ecef;
        margin: 0 0.25rem;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236c757d' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        appearance: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .dataTables_length select:focus {
        outline: none;
        border-color: #6c757d;
        box-shadow: 0 0 0 0.25rem rgba(108, 117, 125, 0.15);
    }

    .dataTables_length select:hover {
        border-color: #adb5bd;
    }

    /* Pagination - Améliorée */
    .dataTables_wrapper .dataTables_paginate {
        margin-top: 1.5rem;
        text-align: right;
        padding: 0;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.5rem 0.85rem;
        margin: 0 0.25rem;
        border: 2px solid #e9ecef;
        border-radius: 6px;
        color: #495057;
        background: #fff;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: #f8f9fa;
        border-color: #6c757d;
        color: #6c757d;
        transform: translateY(-2px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
        color: white !important;
        border-color: #6c757d;
        box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.4);
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        color: #dee2e6;
        cursor: not-allowed;
        border-color: #f8f9fa;
        background: #f8f9fa;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        transform: none;
        box-shadow: none;
    }

    /* Info text - Amélioré */
    .dataTables_info {
        padding-top: 1.5rem;
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dataTables_info::before {
        content: "\f05a";
        /* Icône info Font Awesome */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        color: #6c757d;
    }

    /* Table style - Améliorations */
    #LanguesTable {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0 !important;
    }

    #LanguesTable thead th {
        background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
        color: #495057;
        font-weight: 600;
        padding: 1.25rem 1.5rem;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #dee2e6;
        border-right: 1px solid #dee2e6;
        text-align: left;
        position: relative;
    }

    #LanguesTable thead th:last-child {
        border-right: none;
    }

    #LanguesTable thead th:first-child {
        width: 20%;
        border-top-left-radius: 0;
    }

    #LanguesTable thead th:last-child {
        width: 20%;
        text-align: center;
        border-top-right-radius: 0;
    }

    #LanguesTable tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
        border-right: 1px solid #f8f9fa;
        background-color: #fff;
        transition: all 0.2s ease;
    }

    #LanguesTable tbody td:last-child {
        border-right: none;
        text-align: center;
    }

    #LanguesTable tbody tr {
        transition: all 0.2s ease;
    }

    #LanguesTable tbody tr:hover {
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transform: translateY(-1px);
    }

    #LanguesTable tbody tr:hover td {
        background-color: #f8f9fa;
    }

    #LanguesTable tbody tr:last-child td:first-child {
        border-bottom-left-radius: 0;
    }

    #LanguesTable tbody tr:last-child td:last-child {
        border-bottom-right-radius: 0;
    }

    /* Animation pour les lignes vides */
    .dataTables_empty {
        padding: 3rem !important;
        text-align: center;
        color: #6c757d;
        font-style: italic;
    }
</style>

<!-- Contenu -->
<div class="langues-page">


    <!-- Modal de confirmation de suppression -->
    <div id="deleteModal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-exclamation-triangle"></i>
                <h3>Confirmer la suppression</h3>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer la Region <strong id="langueName"></strong> ?</p>
                <p style="color: #6c757d; font-size: 0.9rem;">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-modal btn-cancel" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i> Annuler
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-modal btn-confirm-delete">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>


    @if(session('success'))
    <div class="alerts-container">
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle"></i>
            <span class="alert-message">{{ session('success') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alerts-container">
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <span class="alert-message">{{ session('error') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    </div>
    @endif

    @if(session('warning'))
    <div class="alerts-container">
        <div class="alert alert-warning" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <span class="alert-message">{{ session('warning') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    </div>
    @endif

    @if(session('info'))
    <div class="alerts-container">
        <div class="alert alert-info" role="alert">
            <i class="fas fa-info-circle"></i>
            <span class="alert-message">{{ session('info') }}</span>
            <button type="button" class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    </div>
    @endif

    <!-- Barre de contrôles -->
    <div class="controls-container">
        <div class="controls-left"></div>
        <div class="controls-right">
            <a href="{{route('langues.create')}}" class="btn-create">
                <i class="bi bi-plus-lg"></i> Ajouter une region
            </a>
        </div>
    </div>

    <!-- Card avec DataTable -->
    <div class="langues-container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Rgions</h3>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table id="LanguesTable" class="table display">
                        <thead>
                            <tr>
                                <th>Nom_langue</th>
                                <th>Description</th>
                                <th>Population</th>
                                <th>Superficie</th>
                                <th>Localisation</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regions as $region)
                            <tr>
                                <td>{{ $region->nom_region }}</td>
                                <td>{{ $region->description }}</td>
                                <td>{{ $region->population }}</td>
                                <td>{{ $region->superficie }}</td>
                                <td>{{ $region->localregions }}</td>
                                <td>
                                    <a href="{{ route('regions.show', $region->id_region) }}"
                                        class="btn-action btn-show" title="Voir">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('regions.edit', $region->id_region) }}"
                                        class="btn-action btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('regions.destroy', $region->id_region) }}" method="POST"
                                        style="display: inline-block;"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette région ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-action btn-delete" title="Supprimer"
                                            onclick="showDeleteModal('{{ $region->id_region }}', '{{ $region->nom_region }}')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts JS -->
<!-- Ajouter cette ligne pour importer Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert').fadeOut('slow', function() {
                $(this).remove();
            });
        }, 5000);
    });
    $(document).ready(function () {
    // Initialisation de DataTables
    const table = $('#LanguesTable').DataTable({
        paging: true,
        searching: true,
        lengthChange: true,
        info: true,
        order: [[0, 'asc']],
        pageLength: 10,
        language: {
            search: '',
            searchPlaceholder: 'Rechercher...',
            lengthMenu: "Afficher _MENU_ entrées",
            info: "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            infoEmpty: "Aucune entrée disponible",
            infoFiltered: "(filtré sur _MAX_ entrées au total)",
            zeroRecords: "Aucune langue trouvée",
            paginate: {
                previous: '‹ Précédent',
                next: 'Suivant ›',
                first: 'Premier',
                last: 'Dernier'
            }
        },
        dom: '<"top"lf>rt<"bottom"ip><"clear">',
        initComplete: function() {
            $('.dataTables_length').appendTo('.controls-left');
            $('.dataTables_filter').appendTo('.controls-right');
            $('.btn-create').appendTo('.controls-right');
        }
    });
    
    // SUPPRIMEZ TOUS LES EVENT LISTENERS :
    // $('#LanguesTable').on('click', '.btn-show', ...)
    // $('#LanguesTable').on('click', '.btn-edit', ...)
    // $('#LanguesTable').on('click', '.btn-delete', ...)
    
    // Les actions sont maintenant gérées directement par les liens HTML
});


    // Fonctions pour la modal de suppression
    function showDeleteModal(id, name) {
        document.getElementById('langueName').textContent = name;
        document.getElementById('deleteForm').action = "{{ url('langues') }}/" + id;
        document.getElementById('deleteModal').classList.add('active');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
    }

    // Fermer la modal en cliquant en dehors
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Fermer avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
</script>

@endsection
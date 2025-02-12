@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">📜 Liste des Articles</h2>

        <div class="d-flex justify-content-between flex-wrap mb-3">
            <a href="{{ route('articles.export') }}" class="btn btn-success">
                <i class="fas fa-file-csv"></i> Exporter tous les articles
            </a>
        </div>

        <!-- Formulaire d'import CSV -->
        <div class="card p-3 mb-4 shadow-sm">
            <form action="{{ route('articles.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="input-group">
                    <input type="file" name="csv_file" class="form-control" required>
                    <button type="submit" class="btn btn-success"><i class="fas fa-upload"></i> Importer CSV</button>
                </div>
            </form>
        </div>

        <!-- Barre de recherche -->
        <form action="{{ route('articles.filter') }}" method="GET" class="d-flex mb-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Rechercher un article...">
            <button type="submit" class="btn btn-info"><i class="fas fa-filter"></i> Filtrer</button>
        </form>

        @if(request()->is('articles/filter'))
            <a href="{{ route('articles.export.filtered') }}" class="btn btn-warning mb-3">
                <i class="fas fa-file-export"></i> Exporter les résultats filtrés
            </a>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- TABLE RESPONSIVE -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Flag</th>
                        <th>Vessel Name</th>
                        <th>Registered Owner</th>
                        <th>Call Sign</th>
                        <th>MMSI</th>
                        <th>IMO</th>
                        <th>Ship Type</th>
                        <th>Destination</th>
                        <th>ETA</th>
                        <th>Navigation Status</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Age</th>
                        <th>Time Of Fix</th>
                        <th style="width: 120px;">Actions</th> <!-- Agrandissement de la colonne -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td><small>{{ $article->id }}</small></td>
                            <td><small>{{ $article->flag }}</small></td>
                            <td><small>{{ $article->vessel_name }}</small></td>
                            <td><small>{{ $article->registered_owner }}</small></td>
                            <td><small>{{ $article->call_sign }}</small></td>
                            <td><small>{{ $article->mmsi }}</small></td>
                            <td><small>{{ $article->imo }}</small></td>
                            <td><small>{{ $article->ship_type }}</small></td>
                            <td><small>{{ $article->destination }}</small></td>
                            <td><small>{{ $article->eta }}</small></td>
                            <td><small>{{ $article->navigation_status }}</small></td>
                            <td><small>{{ $article->latitude }}</small></td>
                            <td><small>{{ $article->longitude }}</small></td>
                            <td><small>{{ $article->age }}</small></td>
                            <td><small>{{ $article->time_of_fix }}</small></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    

    <style>
        table td {
            word-break: break-word; /* Empêche les débordements */
            max-width: 150px; /* Limite la largeur des colonnes */
        }

        td:last-child {
            width: 120px; /* Ajustement pour la colonne Actions */
        }
    </style>
@endsection

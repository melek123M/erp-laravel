@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Détails du client : {{ $client->name }}</h1>

        <div class="row mb-3">
            <div class="col-md-6">
                <p><strong>Email :</strong> {{ $client->email }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Téléphone :</strong> {{ $client->phone }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <h3>Liste des Factures</h3>
            </div>
            <div class="col-md-8">
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFactureModal">
                    Ajouter une facture
                </button>
                <button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#unpaidInvoicesModal"
                    id="loadUnpaidInvoices">
                    Afficher les impayées
                </button>
                <button class="btn btn-primary mb-3" id="calculateUnpaidTotal">
                    Calculer le total impayées
                </button>
            </div>
            <div id="unpaidTotalContainer" class="mt-3 text-center" style="display: none;">
                <h5>Total des factures impayées : <span id="unpaidTotalAmount"></span></h5>
            </div>
        </div>
        <table id="invoices-table" class="table table-striped">
            <thead>
                <tr>
                    <th>Montant</th>
                    <th>Date d'échéance</th>
                    <th>Statut</th>
                    <th>Actions </th>
                </tr>
            </thead>
        </table>
        <div class="modal fade" id="addFactureModal" tabindex="-1" aria-labelledby="addFactureModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFactureModalLabel">Ajouter une facture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addFactureForm" method='POST'>
                            @csrf
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="payée">payée</option>
                                    <option value="impayée">impayée</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editFactureModal" tabindex="-1" aria-labelledby="editFactureModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFactureModalLabel">Modifier une facture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editFactureForm" method='PUT'>
                            @csrf
                            <input type="hidden" id="factureId">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="edit_amount" name="amount" required>
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="edit_due_date" name="due_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">status</label>
                                <select class="form-control" name="status" id="edit_status">
                                    <option value="payée">payée</option>
                                    <option value="impayée">impayée</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteFactureModal" tabindex="-1" aria-labelledby="deleteFactureModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteFactureModalLabel">Supprimer une facture</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer cette facture ?</p>
                        <button id="deleteFactureBtn" class="btn btn-danger">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="unpaidInvoicesModal" tabindex="-1" aria-labelledby="unpaidInvoicesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="unpaidInvoicesModalLabel">Factures impayées</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="unpaid-invoices-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Montant</th>
                                    <th>Date d'échéance</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        window.routes = {
            listeFactures: '{{ route('factures.data', ['clientId' => $client->id]) }}',
            storeInvoice: '{{ route('factures.store', ['clientId' => $client->id]) }}',
            unpaidInvoice: '{{ route('factures.unpaid', ['clientId' => $client->id]) }}',
            totalUnpaid: '{{ route('factures.totalUnpaid', ['clientId' => $client->id]) }}',

        };
    </script>
@endsection

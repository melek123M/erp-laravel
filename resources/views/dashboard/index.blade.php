@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Total des Clients</h5>
                                <h2 class="display-4 text-primary">{{ $totalClients }}</h2>
                            </div>
                            <i class="fas fa-users fa-3x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Total des Factures</h5>
                                <h2 class="display-4 text-success">{{ $totalInvoices }}</h2>
                            </div>
                            <i class="fas fa-file-invoice-dollar fa-3x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-lg border-0 rounded">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Montant Impayé</h5>
                                <h2 class="display-4 text-danger">{{ $totalUnpaidAmount }} €</h2>
                            </div>
                            <i class="fas fa-exclamation-triangle fa-3x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
@endsection

@section('js')
    <style>
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 2rem;
        }

        .display-4 {
            font-size: 3rem;
            font-weight: 700;
        }
    </style>
@endsection

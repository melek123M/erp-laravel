<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Client;
use App\Services\InvoiceService;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\CreateFactureRequest;

use function Laravel\Prompts\alert;

class InvoiceController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index($clientId)
    {
        $client = Client::findOrFail($clientId);

        $invoices = $client->invoices()->get();

        return DataTables::of($invoices)
            ->addColumn('action', function ($invoices) {
                return '
            <button class="btn btn-success edit-facture" data-id="' . $invoices->id . '">Modifier</button>
            <button class="btn btn-danger delete-facture" data-id="' . $invoices->id . '">Supprimer</button>
        ';
            })
            ->make(true);
    }

    public function store(CreateFactureRequest $request, $clientId)
    {

        $invoice = $this->invoiceService->createInvoice($clientId, $request->all());

        return response()->json([
            'success' => 'Facture ajoutée avec succès.',
            'invoice' => $invoice,
        ]);
    }

    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);

        return response()->json($invoice);
    }


    public function update(CreateFactureRequest $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $this->invoiceService->updateInvoice($invoice, $request->all());

        return response()->json(['success' => 'Facture mise à jour avec succès.']);
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);

        $this->invoiceService->deleteInvoice($invoice);

        return response()->json(['success' => 'Facture supprimée avec succès.']);
    }
    public function getUnpaidInvoices($clientId)
    {
        $invoices = $this->invoiceService->getOverdueInvoices($clientId);

        return response()->json($invoices);
    }
    public function getTotalUnpaidInvoices($clientId)
    {
        $totalUnpaidInvoices = $this->invoiceService->getTotalUnpaidInvoices($clientId);
        return response()->json(['total' => $totalUnpaidInvoices]);
    }
}

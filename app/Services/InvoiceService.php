<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceService
{
    public function createInvoice($clientId, array $data)
    {
        $data['client_id'] = $clientId;
        return Invoice::create($data);
    }

    public function updateInvoice(Invoice $invoice, array $data)
    {
        $invoice->update($data);
    }

    public function deleteInvoice(Invoice $invoice)
    {
        $invoice->delete();
    }


    public function getTotalUnpaidInvoices($clientId)
    {
        return Invoice::where('client_id', $clientId)
            ->where('status', 'impayée')
            ->sum('amount');
    }

    public function getOverdueInvoices()
    {
        return Invoice::where('status', 'impayée')
            ->where('due_date', '<', now())
            ->get();
    }
}

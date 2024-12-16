<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use SoftDeletes;

    public $table = 'invoices';
    /**
     * Attributs autorisés pour le remplissage en masse.
     */
    protected $fillable = [
        'client_id',
        'amount',
        'due_date',
        'status',
    ];

    /**
     * Règles de validation.
     *
     * @return array
     */
    public static function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0.01',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|in:payée,impayée',
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     *
     * @return array
     */
    public static function messages(): array
    {
        return [
            'client_id.required' => 'Le client est requis.',
            'client_id.exists' => 'Le client sélectionné n\'existe pas.',
            'amount.required' => 'Le montant est requis.',
            'amount.numeric' => 'Le montant doit être un nombre.',
            'amount.min' => 'Le montant doit être supérieur à 0.',
            'due_date.required' => 'La date d\'échéance est requise.',
            'due_date.date' => 'La date d\'échéance doit être une date valide.',
            'due_date.after_or_equal' => 'La date d\'échéance doit être aujourd\'hui ou une date future.',
            'status.required' => 'Le statut est requis.',
            'status.in' => 'Le statut doit être soit "payée" soit "impayée".',
        ];
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

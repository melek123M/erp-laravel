<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public $table = 'clients';

    public $fillable = [
        'name',
        'email',
        'phone',
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',

    ];
    protected $hidden = ['updated_at', 'created_at', 'deleted_at'];

    public static function rules(): array
    {
        return [
            'phone' => ['required', 'regex:/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/', 'unique:clients,phone'],
            'email' => 'required|unique:clients,email',

        ];
    }
    public static function messages(): array
    {
        return [
            'phone.regex' => 'Le numéro de téléphone doit être valide. Exemple : +33 6 12 34 56 78 ou 06 12 34 56 78.',
        ];
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}

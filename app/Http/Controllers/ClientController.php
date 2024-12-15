<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Affiche la vue principale des clients.
     */
    public function index()
    {
        return view('clients.index');
    }

    /**
     * Fournit les données pour DataTables.
     */
    public function data()
    {
        $clients = Client::query();

        return DataTables::of($clients)
            ->addColumn('action', function ($client) {
                return '
                    <button class="btn btn-primary edit-client" data-id="' . $client->id . '">Modifier</button>
                    <button class="btn btn-danger delete-client" data-id="' . $client->id . '">Supprimer</button>
                ';
            })
            ->make(true);
    }

    /**
     * Enregistre un nouveau client.
     */
    public function store(CreateClientRequest $request)
    {
        $input = $request->all();
        Client::create($input);
        return response()->json(['success' => 'Client ajouté avec succès']);
    }

    /**
     * Retourne les données d'un client pour l'édition.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return response()->json($client);
    }

    /**
     * Met à jour un client existant.
     */
    public function update(UpdateClientRequest $request, $id)
    {
        $client = Client::findOrFail($id);
        $input = $request->all();
        $client->update($input);
        return response()->json(['success' => 'Client modifié avec succès']);
    }

    /**
     * Supprime un client.
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['success' => 'Client supprimé avec succès']);
    }
}

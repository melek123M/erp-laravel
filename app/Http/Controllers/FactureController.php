<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }

    public function getClients(Request $request)
    {
        if ($request->ajax()) {
            $clients = Client::select(['id', 'name', 'email', 'phone', 'created_at']);
            return DataTables::of($clients)
                ->addIndexColumn()
                ->make(true);
        }
    }
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:clients,email',
        'phone' => 'required|string|max:15',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    Client::create($request->all());

    return response()->json(['success' => true]);
}
}

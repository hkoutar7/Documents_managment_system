<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ClientController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:client_list', ['only' => ['index']]);
        $this->middleware('permission:client_add', ['only' => ['store']]);
        $this->middleware('permission:client_edit', ['only' => ['update']]);
        $this->middleware('permission:client_delete', ['only' => ['destroy']]);
    }

    public function index() : View
    {
        $num_clients = Client::get()->count();
        $clients = DB::table('clients')->latest()->get();

        return view('clients.index', compact("num_clients",'clients'));
    }

    public function store (StoreClientRequest $request) : RedirectResponse
    {
        $data = $request->all();

        $client = new Client;
        $client['name'] = $data["name"];
        $client['email'] = $data["email"];
        $client['phone_number'] = $data["phone_number"];
        $client['description'] = $data["description"];
        $client->save();

        Alert::success('Client créé avec succès', 'Le client "' . $client->name . '" a été créé et ajouté parmis nos clients');
        return redirect()->back();
    }

    public function update(UpdateClientRequest $request) :RedirectResponse
    {
        $idClient = $request->id;

        $client = Client::findOrFail($idClient);
        $client['name'] = $request["name"];
        $client['email'] = $request["email"];
        $client['phone_number'] = $request["phone_number"];
        $client['description'] = $request["description"];
        $client->save();

        Alert::success('Informations du client mises à jour avec succès', 'Les informations du client "' . $client->name . '" ont été modifiées avec succès.');
        return redirect()->back();
    }

    public function destroy (Request $req) : RedirectResponse
    {
        $client = Client::findOrFail($req->id);

        $client->delete();

        Alert::success('Client supprimé avec succès', 'Le client "' . $client->name . '" a été supprimé avec succès.');
        return redirect()->back();
    }


}

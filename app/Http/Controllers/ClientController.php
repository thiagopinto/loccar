<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientDocumentImage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::with('documents')->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'cnh' => 'required|unique:clients',
            'birthdate' => 'required|date',
            'address_line1' => 'required',
            'documents' => 'required',
            'documents.*' => 'mimes:png,jpg,jpeg,gif'
        ]);

        $clientRequest = $request->all();

        $client = Client::create(
            $clientRequest
        );

        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $document) {
                $path = $document->store('public/clients');
                $documentImage = new ClientDocumentImage([
                    'description' => "{$client->model}-{$client->license_plate}",
                    'path' => $path
                ]);

                $client->documents()->save($documentImage);
            }
        }


        return redirect()->route('clients.index')
            ->with('success', 'Cliente cadastrado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::with('documents')->find($id);

        return view('pages.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'cnh' => 'required',
            'birthdate' => 'required|date',
            'address_line1' => 'required',
            'documents.*' => 'mimes:png,jpg,jpeg,gif'
        ]);

        $client = Client::with('documents')->find($id);

        $clientRequest = $request->all();

        $client->update($clientRequest);


        if ($request->hasfile('documents')) {
            foreach ($request->file('documents') as $document) {
                $path = $document->store('public/clients');
                $documentImage = new ClientDocumentImage([
                    'description' => "{$client->model}-{$client->license_plate}",
                    'path' => $path
                ]);

                $client->documents()->save($documentImage);
            }
        }

        return redirect()->back()->with('success', 'Client atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyImage($id)
    {
        $image = ClientDocumentImage::find($id);
        Storage::delete($image->path);
        $image->delete();
        return redirect()->back()->with('success', 'Imagem apagada');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listeLease(Request $request, $id)
    {
        $client = Client::find($id);
        $status = 'finished';

        $leaseRequests = $client->leaseRequest()->where('status', $status)->paginate(10);

        return view('pages.lease-request.index', compact('leaseRequests', 'status'));
    }
}

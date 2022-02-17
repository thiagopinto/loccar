<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    <div class="hero min-h-screen bg-base-200">
        <div class="text-center hero-content w-full">
            <div class="card flex-shrink-0 w-full shadow-2xl bg-base-100">
                <div class="card-body">
                    <div class="w-full flex justify-end my-1">
                        <a href="{{ url('/') }}" class="btn btn-secondary mx-1">
                            <x-fas-home class="h-6 w-6 mx-1" /> Home
                        </a>
                        <a href="{{ url('/clients/create') }}" class="btn btn-primary mx-1">
                            <x-far-user class="h-6 w-6 mx-1" /> Cadastro de Cliente
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CNH</th>
                                    <th>Data de Nascimento</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>
                                            <div class="flex items-center space-x-3">
                                                @if (count($client->documents) > 0)
                                                <div class="avatar">
                                                    <div class="w-12 h-12 mask mask-squircle">
                                                        <img src="{{ Storage::url($client->documents[0]->path)}}"
                                                            alt="{{ $client->name }}">
                                                    </div>
                                                </div>
                                                @endif

                                                <div>
                                                    <div class="font-bold">
                                                        {{ $client->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $client->cnh }}
                                        </td>
                                        <td>
                                            {{ $client->birthdate }}
                                        </td>
                                        <th>
                                            <a href="{{ url("/clients/{$client->id}/edit") }}"class="btn mx-1">Editar</a>
                                            <a href="{{ url("/client/historic/{$client->id}") }}"class="btn mx-1">Histórico</a>
                                        </th>
                                    </tr>

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>CNH</th>
                                    <th>Data de Nascimento</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $clients }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de reserva') }}
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
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    <th>Carro</th>
                                    <th>Cliente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leaseRequests as $leaseRequest)
                                    <tr>
                                        <td>
                                            {{ $leaseRequest->lease_start }}
                                        </td>
                                        <td>
                                            {{ $leaseRequest->lease_end }}
                                        </td>
                                        <td>
                                            {{ $leaseRequest->car->license_plate }}:
                                            {{ $leaseRequest->car->license_plate }}
                                        </td>
                                        <td>{{ $leaseRequest->client->name }}</td>

                                        <th>
                                            @if ($status == 'pending')
                                                <form method="POST" action="/lease-request/{{ $leaseRequest->id }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="active">
                                                    <button type="submit" class="btn my-1">Confirmar</button>
                                                </form>
                                                <form method="POST" action="/lease-request/{{ $leaseRequest->id }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="canceled">
                                                    <button type="submit" class="btn btn-error my-1">Cancelar</button>
                                                </form>
                                            @endif
                                            @if ($status == 'wait')
                                                <form method="POST" action="/lease-request/{{ $leaseRequest->id }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit" class="btn my-1">Reservar</button>
                                                </form>
                                            @endif
                                            @if ($status == 'active')
                                                <form method="POST" action="/lease-request/{{ $leaseRequest->id }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="finished">
                                                    <button type="submit" class="btn my-1">Devolver</button>
                                                </form>
                                            @endif

                                        </th>
                                    </tr>

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Início</th>
                                    <th>Fim</th>
                                    <th>Carro</th>
                                    <th>Cliente</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $leaseRequests }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

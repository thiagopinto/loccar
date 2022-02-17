<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Carros') }}
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
                        <a href="{{ url('/cars/create') }}" class="btn btn-primary mx-1">
                            <x-fas-car class="h-6 w-6 mx-1" /> Cadastro de Carros
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Modelo</th>
                                    <th>Placa</th>
                                    <th>Cor</th>
                                    <th>Ano</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>
                                            <div class="flex items-center space-x-3">
                                                @if (count($car->images) > 0)
                                                <div class="avatar">
                                                    <div class="w-12 h-12 mask mask-squircle">
                                                        <img src="{{ Storage::url($car->images[0]->path)}}"
                                                            alt="{{ $car->license_plate }}">
                                                    </div>
                                                </div>
                                                @endif

                                                <div>
                                                    <div class="font-bold">
                                                        {{ $car->model }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $car->license_plate }}
                                        </td>
                                        <td>{{ $car->color }}</td>
                                        <td>
                                            {{ $car->year }}
                                        </td>
                                        <th>
                                            <a href="{{ url("/cars/{$car->id}/edit") }}"class="btn">Editar</a>
                                            <form method="POST" action="/cars/{{ $car->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-error my-1">Delete</button>
                                            </form>
                                        </th>
                                    </tr>

                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Modelo</th>
                                    <th>Placa</th>
                                    <th>Cor</th>
                                    <th>Ano</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $cars }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

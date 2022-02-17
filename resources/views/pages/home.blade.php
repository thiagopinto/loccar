<x-guest-layout>
    <div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content rounded-box mx-4">
        <div class="flex-1 px-2 mx-2">
            <span class="text-lg font-bold">
                LocCar,
                @if ($client != null)
                    Oi {{ $client->name }}
                @endif
            </span>
        </div>
        <div class="flex-none px-2 mx-2 lg:flex">
            @if ($client == null)
                <div class="flex items-stretch">
                    <a class="btn btn-ghost btn-sm rounded-btn" href="{{ url('/client/login') }}">
                        <x-fas-check-circle class="inline-block w-5 mr-2 stroke-current" />
                        Login do cliente
                    </a>
                </div>
            @endif

            <div class="flex items-stretch">
                <a class="btn btn-ghost btn-sm rounded-btn" href="{{ url('/login') }}">
                    <x-fas-check-circle class="inline-block w-5 mr-2 stroke-current" />
                    Adm
                </a>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-1 md:grid-cols-2 md:gap-2 lg:grid-cols-3 lg:gap-3 mx-4">
        @foreach ($cars as $car)
            <div class="card text-center shadow-2xl">
                <figure class="px-1 pt-1">
                    <img src="{{ Storage::url($car->images[0]->path) }}" alt="{{ $car->model }}">
                </figure>
                <div class="card-body">
                    <h2 class="card-title">{{ $car->model }}"</h2>
                    <p>Modelo: {{ $car->model }}</p>
                    <p>Ano: {{ $car->year }}</p>
                    <p>Portas: {{ $car->doors }}</p>
                    <p>Valor da diária: {{ $car->daily_rate }}</p>
                    <div class="justify-center card-actions">
                        @if ($car->isDisposable)
                            <a class="btn btn-primary"
                                href="{{ url('lease-request/create/pending') }}/{{ $car->id }}">
                                <x-fas-key class="inline-block w-5 mr-2 stroke-current" />
                                Locar!
                            </a>
                        @else
                            <a class="btn btn-secondary"
                                href="{{ url('lease-request/create/wait') }}/{{ $car->id }}">
                                <x-fas-key class="inline-block w-5 mr-2 stroke-current" />
                                Reservar!
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-guest-layout>

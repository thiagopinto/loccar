<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meios de pagamentos') }}
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
                        <a href="{{ url('/payment-options/create') }}" class="btn btn-primary mx-1">
                            <x-far-user class="h-6 w-6 mx-1" /> Cadastro de forma de pagamento
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Taxa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentOptions as $paymentOption)
                                    <tr>
                                        <td>
                                            <div class="flex items-center space-x-3">
                                                <div>
                                                    <div class="font-bold">
                                                        {{ $paymentOption->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $paymentOption->rate }}
                                        </td>
                                        <th>
                                            <a href="{{ url("/payment-options/{$paymentOption->id}/edit") }}"class="btn">Editar</a>
                                            <form method="POST" action="/payment-options/{{ $paymentOption->id }}">
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
                                    <th>Nome</th>
                                    <th>Taxa</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                        {{ $paymentOptions }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

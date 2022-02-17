<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar usuário') }}
        </h2>
    </x-slot>
    <div class="hero min-h-screen bg-base-200">
        <div class="flex-col justify-center hero-content lg:flex-row w-1/2">
            <div class="card flex-shrink-0 w-full shadow-2xl bg-base-100">
                <div class="card-body">
                    <div class="w-full flex justify-end my-1">
                        <a href="{{ url('/') }}" class="btn btn-secondary mx-1">
                            <x-fas-home class="h-6 w-6 mx-1" /> Home
                        </a>
                    </div>
                    <form method="POST" enctype="multipart/form-data" action="/payment-options/{{ $paymentOption->id }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-1">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nome</span>
                                </label>
                                <input type="text" placeholder="Nome..." name="name"
                                    class="input input-bordered @error('name') input-error @enderror"
                                    value="{{ old('name', $paymentOption->name) }}">

                                @error('name')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror

                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Taxa</span>
                                </label>
                                <input type="number" placeholder="Taxa..." step="0.01" name="rate"
                                    class="input input-bordered @error('daily_rate') input-error @enderror"
                                    value="{{ old('rate', $paymentOption->rate) }}">
                                @error('rate')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        @if (count($errors) > 0)

                            @foreach ($errors->all() as $error)
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $error }}</span>
                                </label>
                            @endforeach

                        @endif
                        <div class="form-control mt-6">
                            <input type="submit" value="Salvar" class="btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>

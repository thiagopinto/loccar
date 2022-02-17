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
                    <form method="POST" enctype="multipart/form-data" action="/clients/{{ $client->id }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-1 md:grid-cols-2 md:gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Nome</span>
                                </label>
                                <input type="text" placeholder="Nome..." name="name"
                                    class="input input-bordered @error('name') input-error @enderror"
                                    value="{{ old('name', $client->name) }}">

                                @error('name')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror

                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">CNH</span>
                                </label>
                                <input type="text" placeholder="CNH..." name="cnh"
                                    class="input input-bordered @error('cnh') input-error @enderror"
                                    value="{{ old('cnh', $client->cnh) }}">

                                @error('cnh')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror

                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Data de nascimento</span>
                                </label>
                                <input type="date" placeholder="Data de nascimento..." name="birthdate"
                                    class="input input-bordered @error('birthdate') input-error @enderror"
                                    value="{{ old('birthdate', $client->birthdate) }}">
                                @error('birthdate')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Endereço</span>
                                </label>
                                <input type="text" placeholder="Endereço..." name="address_line1"
                                    class="input input-bordered @error('address_line1') input-error @enderror"
                                    value="{{ old('address_line1', $client->address_line1) }}">
                                @error('address_line1')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Bairro</span>
                                </label>
                                <input type="text" placeholder="Bairro..." name="address_line2"
                                    class="input input-bordered @error('address_line2') input-error @enderror"
                                    value="{{ old('address_line2', $client->address_line2) }}">
                                @error('address_line2')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Cidade</span>
                                </label>
                                <input type="text" placeholder="Endereço..." name="address_line3"
                                    class="input input-bordered @error('address_line3') input-error @enderror"
                                    value="{{ old('address_line3', $client->address_line3) }}">
                                @error('address_line3')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Documentos</span>
                            </label>
                            <input type="file" placeholder="Documents..." name="documents[]" multiple
                                accept="image/png, image/jpeg, image/bmp"
                                class="input input-bordered @error('documents | documents.*') input-error @enderror">
                            @error('documents | documents.*')
                                <label class="label">
                                    <span class="label-text-alt text-error">{{ $message }}</span>
                                </label>
                            @enderror
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

                    @if (count($client->documents) > 0)
                        <div class="flex overflow-x-auto space-x-8 p-4 m-2 bg-neutral rounded-xl ">
                            @foreach ($client->documents as $document)
                                <div class="flex-shrink-0 w-96 m-2">
                                    <img src="{{ Storage::url($document->path) }}"
                                        class="rounded-box w-96">

                                    <form method="POST" action="/clients/document/{{ $document->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-warning my-1">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif







                </div>
            </div>
        </div>
    </div>

</x-app-layout>

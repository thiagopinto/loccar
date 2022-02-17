<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit car') }}
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
                    <form method="POST" enctype="multipart/form-data" action="/cars/{{ $car->id }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 gap-1 md:grid-cols-2 md:gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Modelo</span>
                                </label>
                                <input type="text" placeholder="Modelo..." name="model"
                                    class="input input-bordered @error('model') input-error @enderror"
                                    value="{{ old('model', $car->model) }}">

                                @error('model')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror

                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Placa</span>
                                </label>
                                <input type="text" placeholder="Placa..." name="license_plate"
                                    class="input input-bordered @error('license_plate') input-error @enderror"
                                    value="{{ old('license_plate', $car->license_plate) }}">

                                @error('license_plate')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror

                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Cor</span>
                                </label>
                                <input type="text" placeholder="Cor..." name="color"
                                    class="input input-bordered @error('color') input-error @enderror"
                                    value="{{ old('color', $car->color) }}">
                                @error('color')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Ano</span>
                                </label>
                                <input type="text" placeholder="Ano..." name="year"
                                    class="input input-bordered @error('year') input-error @enderror"
                                    value="{{ old('year', $car->year) }}">
                                @error('year')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Portas</span>
                                </label>
                                <input type="number" placeholder="Portas..." name="doors"
                                    class="input input-bordered @error('doors') input-error @enderror"
                                    value="{{ old('doors', $car->doors) }}">
                                @error('doors')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Km</span>
                                </label>
                                <input type="number" placeholder="Km..." step="0.01" name="mileage"
                                    class="input input-bordered @error('mileage') input-error @enderror"
                                    value="{{ old('mileage', $car->mileage) }}">
                                @error('mileage')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Valor da diária</span>
                                </label>
                                <input type="number" placeholder="Valor da diária..." step="0.01" name="daily_rate"
                                    class="input input-bordered @error('daily_rate') input-error @enderror"
                                    value="{{ old('daily_rate', $car->daily_rate) }}">
                                @error('daily_rate')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Fotos</span>
                            </label>
                            <input type="file" placeholder="Imgens..." name="imagens[]" multiple
                                accept="image/png, image/jpeg, image/bmp"
                                class="input input-bordered @error('imagens | imagens.*') input-error @enderror">
                            @error('imagens | imagens.*')
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

                    @if (count($car->images) > 0)
                        <div class="flex overflow-x-auto space-x-8 p-4 m-2 bg-neutral rounded-xl ">
                            @foreach ($car->images as $image)
                                <div class="flex-shrink-0 w-96 m-2">
                                    <img src="{{ Storage::url($image->path) }}" class="rounded-box w-96">

                                    <form method="POST" action="/cars/image/{{ $image->id }}">
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

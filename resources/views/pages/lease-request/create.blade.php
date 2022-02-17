<x-guest-layout>
    <div class="hero min-h-screen bg-base-200">
        <div class="flex-col justify-center hero-content lg:flex-row w-1/2">
            <div class="card flex-shrink-0 w-full shadow-2xl bg-base-100">
                <div class="card-body">

                    <form method="POST" enctype="multipart/form-data"
                        action="/lease-request/create/{{ $status }}">
                        @csrf
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <div class="grid grid-cols-1 gap-1 md:grid-cols-2 md:gap-2">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Cliente</span>
                                </label>
                                <input type="text" name="name" class="input input-bordered" value="{{ $client->name }}"
                                    disabled>

                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Carrro</span>
                                </label>
                                <input type="text" name="car" class="input input-bordered"
                                    value="{{ $car->model }}: {{ $car->license_plate }}" disabled>
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Data da retirada</span>
                                </label>
                                <input type="date" placeholder="Data de nascimento..." name="lease_start"
                                    class="input input-bordered @error('lease_start') input-error @enderror"
                                    value="{{ old('lease_start') }}">
                                @error('lease_start')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Data da devolução</span>
                                </label>
                                <input type="date" placeholder="Data de nascimento..." name="lease_end"
                                    class="input input-bordered @error('lease_end') input-error @enderror"
                                    value="{{ old('lease_end') }}">
                                @error('lease_end')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Meio de pagamento</span>
                                </label>
                                <select class="select select-bordered select-primary w-full max-w-xs" name="payment_option_id">
                                    @foreach ($payments as $val)
                                    @if (old('payment_option_id') == $val->id)
                                        <option value="{{ $val->id }}" selected>{{ $val->name }}</option>
                                    @else
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endif
                                    @endforeach
                                </select>


                                @error('payment_option_id')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                            </div>

                        </div>

                        <div class="form-control mt-6">
                            <input type="submit" value="Salvar" class="btn btn-primary">
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

</x-guest-layout>

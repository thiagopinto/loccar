<x-guest-layout>
    <div class="hero min-h-screen bg-base-200">
        <div class="flex-col justify-center hero-content lg:flex-row w-1/2">
            <div class="card flex-shrink-0 w-96 shadow-2xl bg-base-100">
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="/client/login">
                        @csrf
                        <div class="grid grid-cols-1 gap-1">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">CNH</span>
                                </label>
                                <input type="text" placeholder="CNH..." name="cnh"
                                    class="input input-bordered @error('cnh') input-error @enderror"
                                    value="{{ old('cnh') }}">

                                @error('cnh')
                                    <label class="label">
                                        <span class="label-text-alt text-error">{{ $message }}</span>
                                    </label>
                                @enderror
                        </div>


                        <div class="form-control mt-6">
                            <input type="submit" value="Login" class="btn btn-primary">
                        </div>
                    </form>
                    <a class="btn btn-primary" href="/clients/create">Realizar cadastro</a>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>

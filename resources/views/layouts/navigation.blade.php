<div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content rounded-box mx-1">
    <div class="flex-1 px-0 mx-1">
        <span class="text-lg font-bold">
            LocCar
        </span>
    </div>
    <div class="flex-none px-1 mx-1 lg:flex text-sm">
        <div class="flex items-stretch">
            <a class="btn btn-ghost btn-sm rounded-btn m-0" href="{{ url('/lease-request/pending') }}">
                <x-fas-check-circle class="inline-block w-5 mr-1 stroke-current" />
                Confirmar locação
            </a>
            <a class="btn btn-ghost btn-sm rounded-btn" href="{{ url('/lease-request/wait') }}">
                <x-fas-check-circle class="inline-block w-5 mr-1 stroke-current" />
                Lista de espera
            </a>
            <a class="btn btn-ghost btn-sm rounded-btn" href="{{ url('/lease-request/active') }}">
                <x-fas-check-circle class="inline-block w-5 mr-1 stroke-current" />
                Finalizar locação
            </a>
            <a class="btn btn-ghost btn-sm rounded-btn" href="{{ url('/cars') }}">
                <x-fas-car class="inline-block w-5 mr-1 stroke-current" />
                Cadastro de Carros
            </a>
            <a class="btn btn-ghost btn-sm rounded-btn" href="{{ url('/clients') }}">
                <x-far-user class="inline-block w-5 mr-1 stroke-current" />
                Cadastro de Cliente
            </a>
            <a class="btn btn-ghost btn-sm rounded-btn" href="{{ url('/payment-options') }}">
                <x-far-user class="inline-block w-5 mr-1 stroke-current" />
                Meios de pagamentos
            </a>
        </div>
    </div>
    <div class="flex-none hidden sm:flex sm:items-center sm:ml-1">
        <x-dropdown align="right" width="40">
            <x-slot name="trigger">
                <button
                    class="flex items-center transition duration-150 ease-in-out">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div>
</div>

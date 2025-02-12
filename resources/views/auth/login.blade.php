<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
        <div class="d-flex justify-content-center py-4">
            <a href="#" class="d-flex align-items-center w-auto ">
            <img src="img/logo.svg" width="150" height="150">
            </a>
            </div><!-- End Logo -->

        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            <div>
                <p class="text-danger">Utilize a mesma senha do <a href="https://didsemsa.manaus.am.gov.br">Portal DID </a></p>
                <br>
                <hr>
            </div>    
            @csrf

            <div>
                <x-label for="cpf" value="{{ __('CPF') }}" />
                <x-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" required autofocus autocomplete="cpf" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Senha') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

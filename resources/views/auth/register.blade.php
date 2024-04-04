<x-guest-layout>
    <div class="div-login">
        <div class="image">
            <div class="title">Descrube el mundo con felicidad.</div>
        </div>
        <div class="login">
            <div class="div">
                <div class="register-text">¡Bienvenido/a! 😊<br> <p class="subtext">Inserta tus datos para continuar</p></div>
                <div class="inputs">
                    <form method="POST" id="registerForm" action="{{ route('register') }}">
                        @csrf
                        <label for="email" style="color: black">Email</label>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                            <x-text-input id="email"  class="input has-background-white input-border" type="email" name="email" :value="old('email')" required autocomplete="username" />
                            <span class="icon is-small is-left icon-color"><i class="fas fa-envelope"></i></span>
                            <span class="icon is-small is-right icon-color">
                            </p>
                        </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

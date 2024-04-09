<x-guest-layout>
    <!-- Session Status -->
    <div class="image">
        <div class="title">Descubre el mundo con facilidad.</div>
    </div>
    <div class="login">
        <div class="div">
            <div class="text">¡Bienvenido de vuelta!
                {{-- <p class="subtext">Insertar tus datos para continuar</p> --}}
            </div>
            <div class="inputs">
                <x-auth-session-status class="" :status="session('status')" />
                <form class="formlogin" method="POST" id="loginForm" action="{{ route('login') }}">
                    @csrf
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <x-input-error :messages="$errors->get('email')" class="error" />
                    <!-- Email Address -->
                        <div class="field">
                        <x-input-label for="email" :value="__('Email')" style="color: black"/>
                            <p class="control has-icons-left has-icons-right">
                            <x-text-input id="email" class="input has-background-white input-border" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <span class="icon is-small is-left icon-color"><i class="fas fa-envelope"></i></span>
                            </p>
                        </div>
                    <p id="emailError" class="error"></p>

                    <!-- Password -->
                    <div class="field">
                        <p class="control has-icons-left">
                            <x-input-label for="password" :value="__('Password')" style="color: black"/>
                            <p class="control has-icons-left">
                            <x-text-input id="password" class="input has-background-white input-border" type="password" name="password" required autocomplete="current-password"/>
                            <span class="icon is-small is-left icon-color"><i class="fas fa-lock is-black"></i></span></p>

                        </p>
                    </div>
                    <p id="passwordError" class="error"></p>
                    <!-- Remember Me -->
                    <div class="">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <br>
                    <div class="">
                        <x-primary-button class="w-full flex-auto justify-center">
                            {{ __('Log in') }}
                        </x-primary-button>

                    </div>
                        <a class="flex items-center justify-end mt-4" href="{{ route('register') }}">¿No eres usuario? ¡Regístrate!
                        </a>
                </form>

            </div>
        </div>
    </div>
</div>
</x-guest-layout>

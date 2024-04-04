{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="" :status="session('status')" />
    <div class="div-login">
        <div class="image">
            <div class="title">Descubre el mundo con facilidad.</div>
        </div>
        <div class="login">
            <div class="div">
                <div class="text">¡Bienvenido de vuelta!<br>
                <p class="subtext">Insertar tus datos para continuar</p>
                </div>
                <div class="inputs">
                    <form method="POST" id="loginForm" action="{{ route('login') }}">
                        @csrf
                        <label for="email" style="color: black">Email</label>
                        <div class="field">
                            <p class="control-has-icon-left has-icons-right">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Email Address -->
        <div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<x-guest-layout>
<body>
    <div class="div-login">
        <div class="image">
            <div class="title">Descubre el mundo con facilidad.</div>
        </div>
        <div class="login">
            <div class="div">
                <div class="text">¡Bienvenido de vuelta!<br>
                    <p class="subtext">Inserta tus datos para continuar</p>
                </div>
                <div class="inputs">
                    <form method="POST" id="loginForm" action="{{ route('login') }}">
                        @csrf
                        <label for="email" style="color: black">Email</label>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <x-text-input id="email" class="input has-background-white input-border" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                {{-- <input class="" :value="__('Email')" type="text" name="email" id="email" /> --}}
                                <span class="icon is-small is-left icon-color"><i class="fas fa-envelope"></i></span>
                                <span class="icon is-small is-right icon-color"><i class="fas fa-check"></i></span>
                            </p>
                        </div>
                        <p id="emailError" class="error"></p>
                        <!-- PASSWORD -->
                        <label for="password" style="color: black">Password</label>
                        <div class="field">
                            <p class="control has-icons-left">
                                <x-text-input id="password" class="input has-background-white input-border"
                                type="password"
                                name="password"
                                required autocomplete="current-password"/>
                                
                                <span class="icon is-small is-left icon-color"><i class="fas fa-lock is-black"></i></span>
                            </p>
                        </div>
                        <p id="passwordError" class="error"></p>
                        <br>
                            <x-primary-button class="button is-primary is-rounded is-fullwidth submit-button" value="Entrar">
                                {{ __('Log in') }}
                            </x-primary-button>
                            <br>
                            {{-- <input type="submit" class="button is-primary is-rounded is-fullwidth submit-button" value="Entrar"> --}}
                        <a class="flex" href="{{ route('register') }}">¿No eres usuario? ¡Regístrate!</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</x-guest-layout>
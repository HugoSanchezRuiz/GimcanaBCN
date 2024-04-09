<x-guest-layout>
    <!-- Session Status -->
    <div class="image">
        <div class="title">Descubre el mundo con facilidad.</div>
    </div>
    <div class="login">
        <div class="div">
            <div class="text">¡Bienvenido/a! 😊<br>
                {{-- <p class="subtext">Insertar tus datos para continuar</p> --}}
            </div>
            <div class="inputs">
                <x-input-error :messages="$errors->get('password')" class="error" />
                <x-input-error :messages="$errors->get('name')" class="error"/>
                <x-input-error :messages="$errors->get('email')" class="error" />
                <form class="formregistro" id="registerForm" method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div class="field">
                        <x-input-label for="name" :value="__('Name')" style="color: black"/>
                        <p class="control has-icons-left has-icons-right">
                        <x-text-input id="name"  class="input has-background-white input-border" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <span class="icon is-small is-left icon-color"><i class="fa-solid fa-user"></i></span>
                        </p>
                    </div>
                    <!-- Email Address -->

                    <div class="field">
                        <x-input-label for="email" :value="__('Email')" style="color: black" />
                        <p class="control has-icons-left has-icons-right">
                        <x-text-input id="email" class="input has-background-white input-border" type="email" id="email" name="email" :value="old('email')" required autocomplete="username" />
                        <span class="icon is-small is-left icon-color"><i class="fas fa-envelope"></i></span>
                    </div>
                    <p id="emailError" class="error"></p>

                    <!-- Password -->
                    <div class="field">
                        <x-input-label for="password" :value="__('Password')" />
                        <p class="control has-icons-left">
                            <x-text-input id="password" class="input has-background-white input-border" type="password" id="password" name="password" required autocomplete="new-password" />
                            <span class="icon is-small is-left icon-color"><i class="fas fa-lock is-black"></i></span>
                        </p>
                    </div>
                    <p id="passwordError" class="error"></p>

                    <!-- Confirm Password -->
                    <div class="field">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <p class="control has-icons-left">
                            <x-text-input id="password_confirmation" id="password2" class="input has-background-white input-border" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            <span class="icon is-small is-left icon-color"><i class="fas fa-lock is-black"></i></span>
                        </p>
                    </div>
                    <p id="password2Error" class="error"></p>
                    
                    <div class="flex items-center justify-end mt-4">
                        
                        <x-primary-button class="w-full flex-auto justify-center">
                            {{ __('Sign up') }}
                        </x-primary-button>
                    </div>
                    <a class="flex items-center justify-end mt-4" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </form>
            </div>
</x-guest-layout>

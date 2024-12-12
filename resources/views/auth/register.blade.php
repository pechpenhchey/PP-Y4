<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

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
        <div class="mt-2">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn w-full text-center" 
                style="background-color: #ce1212; color: white; height: 40px; border-radius: 6px;">
                {{ __('Register') }}
            </button> 
        </div>

        <hr class="mt-3" style="border-color: #ce1212; border-width: 1px;">

        <div class="mt-2 text-center text-sm text-gray-600 hover:text-gray-900 rounded-md">
            <p>Sign in with </p>
        </div>

        <!-- Google Button -->
        <div class="text-center mt-3">
            <a class="btn w-full text-gray-700 py-3 mx-2" 
                href="{{ route('google-auth') }}" style="max-width: 400px;">
                    <i class="fa-brands fa-google"></i> Google
                </a>
                <a class="btn w-full text-gray-700 py-3 mx-2" 
                href="" style="max-width: 400px;">
                    <i class="fa-brands fa-twitter"></i> Twitter
                </a>
                <a class="btn w-full text-gray-700 py-3 mx-2" 
                href="" style="max-width: 400px;">
                    <i class="fa-brands fa-facebook"></i> Facebook
            </a>
        </div>
    </form>
</x-guest-layout>

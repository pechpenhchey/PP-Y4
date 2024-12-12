<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me and Forgot Password in the Same Row -->
        <div class="row block mt-4 d-flex justify-content-between align-items-center">
            <div class="col-md-6 form-check">
                <label class="form-check-label" for="remember_me">
                    <input id="remember_me" type="checkbox"
                        class="form-check-input rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                @if(Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
            </div>          
        </div>

        <!-- Login Button -->
        <div class="mt-4">
            <button type="submit" class="btn w-full text-center" 
                style="background-color: #ce1212; color: white; height: 40px; border-radius: 6px;">
                {{ __('Log in') }}
            </button>                        
        </div>   
        
        <!-- Register Link -->
        <div class="text-center pt-3">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}">
                Don't have an account? 
                {{ __('Sign up') }}
            </a>
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

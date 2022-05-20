@extends('hito-auth::_layout')

@section('title', 'Login')
@section('subtitle')
    <p>{{ __('hito-auth::login.subtitle') }}</p>
@endsection

@section('content')
    <x-hito::Form action="{{ route('auth.login-check') }}" method="post">
        <div class="space-y-4">
            @if(session('success'))
                <x-hito::alert type="success">{{ session('success') }}</x-hito::alert>
            @endif

            @error('login')
            <div class="py-2 px-4 bg-red-500 rounded text-white font-bold">
                {{ $message }}
            </div>
            @enderror

            <x-hito::Form.Input name="email" type="email"
                          title="{{ __('hito-auth::common.email') }}" />

            <x-hito::Form.Input name="password" type="password"
                          title="{{ __('hito-auth::common.password') }}" />

            <div class="grid grid-cols-2">
                <div>
                    <label>
                        <input type="checkbox" name="remember" value="1">
                        <span>{{ __('hito-auth::login.remember_me') }}</span>
                    </label>
                </div>
                <div class="text-right">
                    <a href="{{ route('auth.reset-password-via-email') }}">{{ __('hito-auth::login.forgot_password') }}</a>
                </div>
            </div>

            <x-hito::form.submit>{{ __('hito-auth::login.submit') }}</x-hito::form.submit>
                
            <div class="flex space-x-2">
                @hook('login-buttons')
            </div>
        </div>
    </x-hito::Form>
@endsection

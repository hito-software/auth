@extends('hito-auth::_layout')

@section('title', 'Reset Password')
@section('subtitle')
    <p class="text-gray-500">Please enter your new password</p>
@endsection

@section('content')
    <form method="post" novalidate>
        @csrf

        <div class="space-y-4">
            <div class="input-group @error('password') input-group--invalid @enderror">
                <label for="password" class="input-group__label">Password</label>
                <input type="password" class="input-group__control" id="password" name="password" />
                @error('password')
                <p class="input-group__error">{{ $message }}</p>
                @enderror
            </div>
            <div class="input-group @error('password_confirmation') input-group--invalid @enderror">
                <label for="password_confirmation" class="input-group__label">Confirm Password</label>
                <input type="password" class="input-group__control" id="password_confirmation" name="password_confirmation" />
                @error('password_confirmation')
                <p class="input-group__error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button class="auth__submit">Reset Password</button>
            </div>
        </div>
    </form>
@endsection

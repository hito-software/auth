@extends('hito-auth::_layout')

@section('title', 'Reset Password')
@section('subtitle')
    <p class="text-gray-500">Please enter your email to reset your password</p>
@endsection

@section('content')
    <form method="post" novalidate>
        @csrf

        <div class="space-y-4">
            <div class="input-group @error('email') input-group--invalid @enderror">
                <label for="email" class="input-group__label">Email address</label>
                <input type="text" class="input-group__control" id="email" name="email" />
                @error('email')
                <p class="input-group__error">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button class="auth__submit">Reset</button>
            </div>
        </div>
    </form>
@endsection

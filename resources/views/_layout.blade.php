@extends('hito::_layouts.base')

@push('css')
    <link rel="stylesheet" href="{{ asset('hito/auth/css/style.css') }}"/>
@endpush

@section('content')
    <div class="hito-auth">
        <div class="hito-auth__main">
            <div class="hito-auth__main__content">
                <div class="hito-auth__main__wrapper">
                    <div class="hito-auth__main__heading">
                        <h3 class="hito-auth__main__title">@yield('title')</h3>
                        <p class="hito-auth__main__subtitle">@yield('subtitle')</p>
                    </div>

                    @yield('content')
                </div>
            </div>

            @include('hito-auth::_footer')
        </div>

        <div class="hito-auth__side relative">
            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center pointer-events-none select-none">

            </div>

            <div class="hito-auth__side__content">
                <div class="hito-auth__side__wrapper">
                    @section('side')
                        <h3 class="hito-auth__side__title">Hito</h3>
                        <p class="hito-auth__side__subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <a href="https://hito-software.github.io" class="hito-auth__side__link" target="_blank">Learn more</a>
                    @show
                </div>
            </div>
        </div>
    </div>
@overwrite

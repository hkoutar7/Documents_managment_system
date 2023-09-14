@extends('layouts.master2')

@section('title', 'Réinitialisation du mot de passe')

@section('css')
<!--- CSS Fontawesome interne -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!--- CSS Ionicons -->
<link href="{{URL::asset('assets/plugins/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
<!--- CSS Typicons interne -->
<link href="{{URL::asset('assets/plugins/typicons.font/typicons.css')}}" rel="stylesheet">
<!--- CSS Feather interne -->
<link href="{{URL::asset('assets/plugins/feather/feather.css')}}" rel="stylesheet">
<!--- CSS d'icônes de drapeaux interne -->
<link href="{{URL::asset('assets/plugins/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet">

<style>
    @media(max-width : 820px) {

        #wrap {
            width: auto !important;
        }
    }

</style>
@endsection

@section('content')

<div id="wrap" class="main-error-wrapper  page page-h " style="width: 900px;height: 900px;margin: 0 auto;">

    <div class="container" style="background: white; border-radius: 54px; padding: 54px;box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">

        <img src="{{ asset('images/authentification/resetPassword.png')}}" alt="error" style="width: 300px">
        <div class="mb-4 text-sm text-gray-600" style="margin-top: 19px; font-size: px;">
        Veuillez remplir ce formulaire pour réinitialiser votre mot de passe
        </div>

        <form method="POST" action="{{ route('password.store') }}" autocomplete="off">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Adresse e-mail -->
            <div style="display: flex; justify-content: center; align-items: center;" class="mb-3">
                <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" autofocus autocomplete="username" style="direction: ltr !important;" />
                <label for="email" style="width : 30%">Adresse e-mail</label>
            </div>

            @error('email')
            <span role="alert" style="width: 100%">
                <div class="alert alert-danger" role="alert" style="border-radius: 8px;margin-top:9px; text-align: left;" class="mt-4">
                    <button aria-label="Fermer" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                    </button>
                    <strong>Erreur</strong>&nbsp; &nbsp; {{$message}}
                </div>
            </span>
            @enderror

            <!-- Password -->
            <div style="display: flex; justify-content: center; align-items: center;" class="mb-3">
                <x-text-input id="password" class="form-control" type="password" name="password" :value="old('password')" autofocus autocomplete="new-password" style="direction: ltr !important;" />
                <label for="password" style="width : 30%">mot de passe</label>
            </div>

            @error('password')
            <span role="alert" style="width: 100%">
                <div class="alert alert-danger" role="alert" style="border-radius: 8px;margin-top:9px; text-align: left;" class="mt-4">
                    <button aria-label="Fermer" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                    </button>
                    <strong>Erreur</strong>&nbsp; &nbsp; {{$message}}
                </div>
            </span>
            @enderror

            <!-- Password confirm -->
            <div style="display: flex; justify-content: center; align-items: center;" class="mb-3">
                <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" :value="old('password_confirmation')" autofocus autocomplete="new-password" style="direction: ltr !important;" />
                <label for="password_confirmation" style="width : 30%">confirmer le mot de passe</label>
            </div>

            @error('password_confirmation')
            <span role="alert" style="width: 100%">
                <div class="alert alert-danger" role="alert" style="border-radius: 8px;margin-top:9px; text-align: left;" class="mt-4">
                    <button aria-label="Fermer" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">&nbsp; &nbsp; &times;</span>
                    </button>
                    <strong>Erreur</strong>&nbsp; &nbsp; {{$message}}
                </div>
            </span>
            @enderror

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn btn-secondary">"Réinitialiser le mot de passe</button>
            </div>
        </form>
    </div>

</div>

<!-- /Wrapper principal de l'erreur -->
@endsection

@section('js')
@endsection

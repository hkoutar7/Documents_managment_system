@extends('simpleTemplate.simple')
@include('layouts.head')

@section('title', "Page de connexion")


@section('cssFiles')
@parent
<link rel="stylesheet" href="{{ asset('css/authentification/signin.css')}}">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">

@endsection

@section('content')

<x-auth-session-status class="mb-4" :status="session('status')" />

@if(session()->has('deleteUser'))
<div class="alert alert-success mg-b-0" role="alert" style="position: fixed; z-index: 1000; left: 21px; bottom: 18px;">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button> &nbsp;
    <strong>Succeess !</strong> &nbsp; {{ session()->get('deleteUser') }}
</div>
@endif


<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex align-items-center justify-content-center h-100">

            <div class="col-md-8 col-lg-7 col-xl-6">
                <img src="{{asset('images/authentification/signin.svg')}}" class="img-fluid" alt="Phone image">
            </div>

            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1" id="form">
                <form method="POST" action="{{ route('login') }}" autocomplete="off" role="connexion">
                    @csrf

                    <!-- Champ de l'adresse e-mail -->
                    <div class="form-outline mb-4">
                        <input type="email" id="form1Example13" class="form-control form-control-lg" name="email" :value="old('email')" autofocus autocomplete="username" />
                        <label class="form-label" for="form1Example13">Adresse e-mail</label>
                    </div>

                    @error('email')
                    <div class="alert alert-danger mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button> &nbsp;&nbsp;
                        <strong>Erreur !</strong> &nbsp; {{$message}}
                    </div>
                    @enderror

                    <!-- Champ du mot de passe -->
                    <div class="form-outline mb-4">
                        <input type="password" id="form1Example23" class="form-control form-control-lg" name="password" autocomplete="current-password" />
                        <label class="form-label" for="form1Example23">Mot de passe</label>
                    </div>

                    @error('password')
                    <div class="alert alert-danger mg-b-0" role="alert">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button> &nbsp;&nbsp;
                        <strong>Erreur !</strong> &nbsp; {{$message}}
                    </div>
                    @enderror

                    <div class="d-flex justify-content-around align-items-center mb-4">
                        <!-- Case à cocher -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="form1Example3" checked />
                            <label class="form-check-label" for="form1Example3">Se souvenir de moi</label>
                        </div>

                        {{-- Mot de passe oublié  --}}
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Mot de passe oublié ?
                        </a>
                        @endif
                    </div>

                    <!-- Bouton de soumission -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Se connecter</button>

                    <div class="divider d-flex align-items-center my-4">
                        <p class="text-center fw-bold mx-3 mb-0 text-muted">OU</p>
                    </div>
                </form>

                {{-- Continuer avec Facebook & Google  --}}
                <a href=" {{ route('auth.socialiste.redirect','facebook') }}" class="btn-primary btn-lg btn-block" style="background-color: #3b5998; text-align: center;" role="button">
                    <i class="fab fa-facebook-f me-2"></i>Continuer avec Facebook
                </a>
                <a href="{{ route('auth.socialiste.redirect','google') }}" class="btn btn-primary btn-lg btn-block" style="background-color: rgb(223 75 50);" role="button">
                    <i class="fab fa-google me-2"></i>Continuer avec Google
                </a>

                <a href="{{ route('register') }}" class="text-center container" style="display: block" id="register">Je n'ai pas de compte</a>
            </div>

        </div>
    </div>
</section>

@endsection



@section('jsFiles')
@parent
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

@endsection

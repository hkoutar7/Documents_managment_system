@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Utilisateurs</h4> &nbsp; &nbsp;
            <a href="{{route('users.index')}}" class="text-muted mt-1 tx-13 mr-2 mb-0" id="span-special">/ tous les utilisateurs</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Afficher les détails de l'utilisateurs</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 129px);">

    <div class="col-12 col-sm-6 col-lg-6 col-xl-3 ltr ltr-elem">
        <div class="card card-primary" style="width: 400px; height: 420px; transform: translateX(100px);">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0 pb-0" style="text-align: center; font-size: 19px; margin-bottom: 19px !important;">
                    Informations personnelles
                </h5>
            </div>
            <hr>

            <div class="card-body text-primary">
                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">Nom</span>
                    <span style="color: dodgerblue">{{ $user->name }}</span>
                </p>
                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">Adresse e-mail</span>
                    <span style="color: dodgerblue">{{ $user->email }}</span>
                </p>
                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">Numéro de téléphone</span>
                    @if (!empty($user->phone))
                    <span style="color: dodgerblue">{{ $user->phone }}</span>
                    @else
                    <span style="color: crimson">Téléphone indisponible</span>
                    @endif
                </p>

                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">Bio</span>
                    @if (!empty($user->description))
                    <span style="color: dodgerblue">{{ $user->description }}</span>
                    @else
                    <span style="color: crimson">Bio indisponible</span>
                    @endif
                </p>

                <p style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                    <span style="font-weight: 800;">Statut du compte</span>
                    @if ($user->isActive == 1)
                    <span style="color: dodgerblue"> Activé
                    </span>
                    @else
                    <span style="color: crimson">
                        Suspendu
                    </span>
                    @endif
                </p>
            </div>
            <div class="form-group mr-4 ml-4" style="font-size: 17px; color: black; display: flex; justify-content: space-between;">
                <strong>Rôles :</strong>
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <label style="padding: 5px 17px; font-size: 17px; background: #8BC34A; color: white; border-radius: 18px; font-weight: 700; letter-spacing: 1px;">
                    {{ $v }}
                </label>
                @endforeach
                @endif
            </div>
        </div>
    </div>

</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection



@section('js')
@endsection

@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">

@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between ltr ltr-elem">
    <div class="main-dashboard-header-right">
        <div>
            <h2 style="font-size: 12px; text-transform: lowercase;">Évaluations des clients <span style="font-size: 10px;color: #616161;">(14,873)</span></h2>
            <div class="main-star" style="justify-content: flex-end; margin-right: 31px; margin-top: -5px">
                <i class="typcn typcn-star active"></i>
                <i class="typcn typcn-star active"></i>
                <i class="typcn typcn-star active"></i>
                <i class="typcn typcn-star active"></i>
                <i class="typcn typcn-star"></i>
                <span></span>
            </div>
        </div>
    </div>
</div>

<div class="main-dashboard-header-left" style="text-align: center; margin: 0 auto 59px;">
    <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1 dosis-font" style="font-size: 43px; word-spacing: 7px; text-transform: capitalize;">! Bienvenue chez DocuVerse </h2>
    <p class="mg-b-0" style="color: #757575; font-size: 13px; margin-top: 3px;">Votre meilleur système de gestion des documents préfectoraux</p>
</div>
<!-- /breadcrumb -->
@endsection


@section('content')

<div class="row row-sm" style="text-align: left">

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" style="position: relative">
        <div class="card overflow-hidden sales-card bg-warning-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">Nombre du document du
                        @php
                        $mydate = getdate(date("U"));
                        echo "$mydate[month]";
                        @endphp
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex" style="flex-direction: row-reverse;">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $month_document }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Comparé au mois précédent</p>
                        </div>
                        <span class="float-right my-auto mr-auto" style="position: absolute; right: 16px;">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7"> +152.3</span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline4" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" style="position: relative">
        <div class="card overflow-hidden sales-card bg-success-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">Nombre de Documents</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex" style="flex-direction: row-reverse;">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Document::get()->count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">documents au total</p>
                        </div>
                        <span class="float-right my-auto mr-auto" style="position: absolute; right: 16px;">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7"> 52,09%</span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline3" class="pt-1">5,10,5,20,22,12,15,18,20,15,8,12,22,5,10,12,22,15,16,10</span>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" style="position: relative">
        <div class="card overflow-hidden sales-card bg-danger-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">Nombre de Clients du
                        @php
                        $mydate=getdate(date("U"));
                        echo "$mydate[month]";
                        @endphp
                    </h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex" style="flex-direction: row-reverse;">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ $month_client }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">Comparé au mois précédent</p>
                        </div>
                        <span class="float-right my-auto mr-auto" style="position: absolute; right: 16px;">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7">+23.09%</span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline2" class="pt-1">3,2,4,6,12,14,8,7,14,16,12,7,8,4,3,2,2,5,6,7</span>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12" style="position: relative">
        <div class="card overflow-hidden sales-card bg-primary-gradient">
            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                <div class="">
                    <h6 class="mb-3 tx-12 text-white">Numéro de Clients</h6>
                </div>
                <div class="pb-0 mt-0">
                    <div class="d-flex" style="flex-direction: row-reverse;">
                        <div class="">
                            <h4 class="tx-20 font-weight-bold mb-1 text-white">{{ App\Models\Client::get()->count() }}</h4>
                            <p class="mb-0 tx-12 text-white op-7">clients au total</p>
                        </div>
                        <span class="float-right my-auto mr-auto" style="position: absolute; right: 16px;">
                            <i class="fas fa-arrow-circle-up text-white"></i>
                            <span class="text-white op-7">+427</span>
                        </span>
                    </div>
                </div>
            </div>
            <span id="compositeline" class="pt-1">5,9,5,6,4,12,18,14,10,15,12,5,8,5,12,5,12,10,16,12</span>
        </div>
    </div>

</div>

<div class="row row-sm" style="flex-direction: row-reverse">

    {{-- Bar Graph --}}
    <div class="col-md-12 col-lg-12 col-xl-7">
        <div class="card" style="padding: 23px 0 0px 16px">
            <label class="main-content-label" style="text-align: left; margin-bottom: 17px; font-size: 11px;">les types des documents préfectoraux les plus demandes</label>
            <div style="width:100%;">
                {!! $chartjs->render() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-5">

        {{-- Circlr graph --}}
        <div class="card card-dashboard-map-one">
            <label class="main-content-label" style="text-align: left">Pourcentage des types de documents les plus demandés</label>
            <div class="">
                {!! $circleStat->render() !!}
            </div>
        </div>

        {{-- Recent clients  --}}
        <div class="card card-dashboard-map-one">
            <div class="card ltr" style="text-align: left">

                <div class="card-header pb-1 ">
                    <h3 class="card-title" style="margin: 0">Clients Récents</h3>
                    <p class="tx-12 mb-0 text-muted mt-1" style="font-size: 10px;">Voici notre 3 client récent.</p>
                </div>

                <div class="card-body p-0 customers mt-1">
                    @foreach ($recentClients as $recentClient)
                    <div class="list-group list-lg-group list-group-flush">
                        <div class="list-group-item list-group-item-action" href="#">
                            <div class="media mt-0" style="gap: 30px">
                                <img class="avatar-lg rounded-circle ml-3 my-auto" src="{{URL::asset('assets/img/faces/3.jpg')}}" alt="Image description" style="width: 56px !important; height: 56px !important;">
                                <div class="media-body">
                                    <div class="d-flex align-items-center">
                                        <div class="mt-0">
                                            <h5 class="mb-1 tx-15 mb-0"> {{ $recentClient->name }} </h5>
                                            <p class="mb-0" style="font-size: 11px">
                                                @if($recentClient->email)
                                                {{$recentClient->email}}
                                                @else
                                                <span class="text-danger">pas d'email disponible</span>
                                                @endif
                                            </p>
                                            <p class="mb-0 tx-13 text-muted" style="font-size: 11px">
                                                @if($recentClient->description)
                                                {{$recentClient->description}}
                                                @else
                                                <span class="text-danger">pas de description disponible</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>


</div>
</div>


</div>
</div>

@endsection


@section('js')
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js')}}"></script>
<script src="{{URL::asset('assets/js/dashboard.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/chart.flot.sampledata.js')}}"></script>
<script src="{{URL::asset('assets/js/apexcharts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<script src="{{URL::asset('assets/js/modal-popup.js')}}"></script>
<script src="{{URL::asset('assets/js/index.js')}}"></script>
<script src="{{URL::asset('assets/js/jquery.vmap.sampledata.js')}}"></script>

<script>



</script>

@endsection

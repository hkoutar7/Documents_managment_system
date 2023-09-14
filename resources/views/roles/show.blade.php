@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/users/style.css')}}">
<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">roles</h4> &nbsp; &nbsp;
            <a href="{{route('roles.index')}}" class="text-muted mt-1 tx-13 mr-2 mb-0" id="span-special">/ Liste des roles</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Afficher les daetails du role</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 129px);">

    <div class="col-12 col-sm-6 col-lg-6 col-xl-3">
        <div class="card card-primary ltr ltr-elem" style="width: 400px; transform: translateX(100px);">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0 pb-0" style="text-align: center; font-size: 19px; margin-bottom: 19px !important;">
                    <span style="font-weight: 800;">Rôle</span>
                    <span style="color: dodgerblue">{{ $role->name  }}</span>
                </h5>
            </div>
            <hr>
            <div class="card-body text-primary">
                <p class="mb-4" style="font-weight: 800;">Permissions :</p>
                <div style="font-size: 17px; color: black; ">
                    @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                    <p style="margin: 0 5px;">- &nbsp; {{ Illuminate\Support\Str::ucfirst($v->name) }}</p>
                    @endforeach
                    @endif
                </div>
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


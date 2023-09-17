@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
<style>
    .containerm {
        position: relative;
    }

    .centered-element {
        position: absolute;
        left: 50%;
        transform: translate(-50%, 0%);
    }

</style>
@endsection


@section('page-header')
<div class="breadcrumb-header justify-content-between ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">principal</h4> &nbsp;&nbsp;
            <span class="text-muted mt-1 tx-13 mr-2 mb-0" id="span-special">/ Modifiez les informations personnelles</span>
        </div>
    </div>
</div>
@endsection



@section('content')

@if(session()->has('updateUser'))
<div class="alert alert-success mg-b-0" role="alert" style="position: fixed; z-index: 1000; left: 21px; bottom: 18px;">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button> &nbsp;
    <strong>Succeess !</strong> &nbsp; {{ session()->get('updateUser') }}
</div>
@endif

@if(session()->has('AddPhoto'))
<div class="alert alert-success mg-b-0" role="alert" style="position: fixed; z-index: 1000; left: 21px; bottom: 18px;">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button> &nbsp;
    <strong>Succeess !</strong> &nbsp; {{ session()->get('AddPhoto') }}
</div>
@endif

@if(session()->has('EcheckPhoto'))
<div class="alert alert-danger mg-b-0" role="alert" style="position: fixed; z-index: 1000; left: 21px; bottom: 18px;">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button> &nbsp;
    <strong>Erreur !</strong> &nbsp; {{ session()->get('EcheckPhoto') }}
</div>
@endif

@if(session()->has('updatePassword'))
<div class="alert alert-success mg-b-0" role="alert" style="position: fixed; z-index: 1000; left: 21px; bottom: 18px;">
    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button> &nbsp;
    <strong>Succeess !</strong> &nbsp; {{ session()->get('updatePassword') }}
</div>
@endif

<div class="row row-sm container" style="flex-direction: row-reverse; margin : 0 auto 30px">

    <!-- Show Personal informayions -->
    <div class="col-lg-4">

        <div class="card mg-b-20 ltr ltr-elem">
            <div class="card-body">
                <div class="pl-0">
                    <div class="main-profile-overview containerm">

                        <div class="main-img-user profile-user centered-element" style="outline: 5px solid #a1b0d1;">
                            @if(empty( auth()->user()->avatar_id ))
                            <img alt="" src="{{URL::asset('assets/img/faces/6.jpg')}}">
                            @else
                            <img alt="image is here" src="{{ userAvatarUrl() }}">
                            @endif
                            <a href="#AddAvatar" class="modal-effect " data-effect="effect-slide-in-right" data-toggle="modal" style="bottom: 26px; position: absolute; right: 33px ">
                                <i class="fas fa-camera profile-edit"></i>
                            </a>
                        </div>

                        <div class="d-flex justify-content-between mg-b-20">
                            <div style="justify-content: space-around; display: flex; flex-direction: column; align-items: center; align-content: center; margin: 0 auto;">
                                <h5 class="main-profile-name">{{ userName() }}</h5>
                                <p class="main-profile-name-text " style="font-size: 12px;">{{ Auth::User()->email }}</p>
                            </div>
                        </div>

                        <h6 class="mt-3 mb-0">Biographie</h6>
                        <div class="main-profile-bio">
                            @if( Auth::User()->description )
                            <p class="mb-0">{{ Auth::User()->description }}</p>
                            @else
                            <p class="text-danger" style="font-size: 12px;">Pas de biographie disponible</p>
                            @endif
                        </div>

                        <h6 class="mt-3 mb-0">Role </h6>
                        @foreach (Auth::User()->role_names as $v)
                        <span class="badge badge-pill badge-success">{{ $v }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="card mg-b-20 ltr ltr-elem">

            <div class="card-body">
                <div class="main-content-label tx-13 mg-b-25">
                    Conatct
                </div>
                <div class="main-profile-contact-list">
                    <div class="media">
                        <div class="media-icon bg-primary-transparent text-primary">
                            <i class="icon ion-md-phone-portrait"></i>
                        </div>
                        <div class="media-body">
                            <span>Numero de telephone</span>
                            <div>
                                @if( Auth::User()->phone_number )
                                <p class="mb-0">{{ Auth::User()->phone_number }}</p>
                                @else
                                <p class="text-danger mb-0" style="font-size: 12px;">Pas de telephone disponible</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    <!-- Edit Personal informations -->
    <div class="col-lg-8">
        <x-app-layout>
            <div class="py-12 ltr ltr-elem" style="padding: 0;background: #e9eef8;">

                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" style="padding: 0;">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </x-app-layout>
    </div>


</div>
</div>
</div>

<!-- Start Add Profile Photo -->
<div class="modal" id="AddAvatar">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo ltr ltr-elem">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter photo de profile</h6>
                <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{route("profile.imageAdd")}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    <input type="hidden" name="id" id="id" value="{{ userID() }}">
                    <div class="col-md-12">
                        <p class="text-danger fs-1 m-0 ltr ltr-elem mb-1" style="font-size: 10px;">les formats appropriés.jpg .jpeg .png .pdf</p>
                        <input id="avatar" type="file" name="avatar" accept=".jpg, .png, image/jpeg, image/png" class="dropify">
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button" style="background: #757575">Annuler</button>
                        <button type="submit" class="btn ripple btn-primary" type="button" style="background:#1976D2">Enregistrer</button>
                    </div>
            </form>

        </div>
    </div>
</div>
<!-- End Add Profile Photo -->

@endsection



@section('js')
<script src="{{URL::asset('assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>
<script src="{{URL::asset('assets/js/advanced-form-elements.js')}}"></script>
<script src="{{URL::asset('assets/js/select2.js')}}"></script>
<script src="{{URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/telephoneinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/telephoneinput/inttelephoneinput.js')}}"></script>

<script>
    document.querySelector('nav').remove()

</script>

@endsection

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

<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/users/style.css') }}">
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Utilisateurs</h4> &nbsp; &nbsp;
            <a href="{{route('users.index')}}" class="text-muted mt-1 tx-13 mr-2 mb-0" id="span-special">/ tous les utilisateurs</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ajouter un utilisateur</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="row">
    @if ($errors->any())
    <div style="z-index: 2; position: absolute; display: flex; flex-direction: column; gap: 7px;">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger mg-b-0" role="alert" style="width: 400px; direction: ltr !important; text-align: left;">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>&nbsp;&nbsp;
            <strong>Erreur! &nbsp;&nbsp;</strong> {{ $error }}
        </div>
        @endforeach
    </div>
    @endif

    <div class="form_wrapper" style="justify-content: center; flex-grow: 0.4; border-radius: 11px; box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 48px; margin-bottom: 80px;">
        <div class="form_container">

            <div class="title_container">
                <h2>Créer un nouveau compte utilisateur</h2>
            </div>

            <div class="row clearfix" style="justify-content: center;">

                <div style="width: 70% !important">
                    <form action="{{ route('users.store') }}" method="post" autocomplete="off">
                        @csrf

                        <div class="input_field"><span><i aria-hidden="true" class="fa fa-user"></i></span>
                            {!! Form::text('name', null, array('placeholder' => 'Entrez le nom du compte', 'class' => 'form-control ltr')) !!}
                        </div>

                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                            {!! Form::text('email', null, array('placeholder' => 'Entrez l\'adresse e-mail du compte', 'class' => 'form-control ltr')) !!}
                        </div>

                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            {!! Form::password('password', array('placeholder' => 'Entrez le mot de passe du compte', 'class' => 'form-control ltr')) !!}
                        </div>

                        <div class="input_field"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                            {!! Form::password('confirm-password', array('placeholder' => 'Confirmez le mot de passe du compte', 'class' => 'form-control ltr')) !!}
                        </div>

                        <div class="input_field select_option">
                            <p class="ltr" style="text-align: left;">Choisissez le rôle de l'utilisateur parmi les rôles suivants</p>
                            {!! Form::select('roles[]', $roles, [], array('class' => 'form-control ltr', 'multiple')) !!}
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Valider</button>
                        </div>

                    </form>
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
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>


@endsection

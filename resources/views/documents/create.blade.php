@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/fileuploads/css/fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css')}}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">


@endsection


@section('page-header')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">principal</h4> &nbsp; &nbsp;
            <a href="{{route('documents.index')}}" class="text-muted mt-1 tx-13 mr-2 mb-0" id="span-special">/ tous les documents</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ ajouter un document</span>
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


    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-header pb-0 ltr ltr-elem">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Liste des documents préfectoraux</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">Ici, vous pouvez consulter votre document en un seul clic </p>
            </div>

            <div class="container p-5">

                <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf

                    <div class="row mt-4" style="flex-direction: row-reverse;">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="ltr-elem">Nom du document</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control ltr" placeholder=" veuillez enter le nom du document" autofocus>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="section" class="ltr-elem">Section du document</label>
                            <select id="section" name="section" class="form-control select1 ltr">
                                <option class="select-c" label="Veuillez choisir une section"></option>
                                @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ (old('section') == $section->id) ? "selected" : "" }}>
                                    {{ $section->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-mt-4">
                        <label for="client" class="ltr-elem">Nom du client <span style="font-size: 11px;color: #959595"></span></label>
                        <select id="client" name="client" class="form-control select2 ltr" style="text-align: left">
                            <option class="select-c" label="Veuillez choisir le nom du client"></option>
                            @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ (old('client') == $client->id) ? "selected" : "" }}>
                                {{ $client->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="description" class="ltr-elem">Description <span style="font-size: 11px;color: #959595;">(facultatif)</span></label>
                            <textarea id="description" name="description" class="form-control ltr " placeholder="Veuillez saisir une petite description sur le document" rows="4">{{old('description')}}</textarea>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="media" class="ltr-elem">Pièces jointes <span style="font-size: 11px;color: #959595;">(facultatif)</span></label>
                            <p class="text-danger fs-1 m-0 ltr ltr-elem mb-1" style="font-size: 10px;">les formats appropriés.jpg .jpeg .png .pdf</p>
                            <input id="media" name="attachment" type="file" class="dropify" accept=".jpg, .png, image/jpeg, image/png, application/pdf">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-outline-primary mt-5" style="display: block;margin: 0 auto;">
                        Valider &nbsp; &nbsp;<i class="fa fa-plus"></i>
                    </button>

                </form>

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
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fileuploads/js/file-upload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js')}}"></script>
<script src="{{URL::asset('assets/plugins/fancyuploder/fancy-uploader.js')}}"></script>

@endsection

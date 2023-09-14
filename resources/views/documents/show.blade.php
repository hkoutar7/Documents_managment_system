@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/multislider/multislider.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/authentification/signin.css')}}">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">


<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
@endsection


@section('page-header')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">principal</h4> &nbsp; &nbsp;
            <a href="{{route('documents.index')}}" class="text-muted mt-1 tx-13 mr-2 mb-0" id="span-special">/ tous les documents</a>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ consulter le document</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->

@endsection


@section('content')
<!-- row -->
<div class="row">
    @include('sweetalert::alert')

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

            <div class="card-header pb-0 ltr-elem ltr">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0 ltr-elem ltr">Consultation des Pièces Jointes</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">Bienvenue dans la section de consultation des pièces jointes de votre document préfectoral. <br> Ici, vous pouvez explorer en un seul clic toutes les annexes et informations complémentaires associées au document spécifié.</p>
            </div>

            <div class="d-md-flex" style="padding: 21px 30px; flex-direction: row-reverse;">

                <div class="mr-3">
                    <div class="panel panel-primary tabs-style-4">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu ">
                                <ul class="nav panel-tabs">
                                    <li class="">
                                        <a href="#description" class="active" data-toggle="tab">
                                            <i class="fa fa-border-none"></i> &nbsp; description
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#attachments" data-toggle="tab">
                                            <i class="fa fa-file"></i> &nbsp; Pièces jointes
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabs-style-4" style="width: 100%;">
                    <div class="panel-body tabs-menu-body mr-3">
                        <div class="tab-content">

                            <div class="tab-pane active" id="description">
                                <table class="table table-hover mb-0 text-md-nowrap ltr" style="text-align: left;">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="tble-title">document name</th>

                                            <td>{{ $document->name }}</td>
                                            <td scope="row" class="tble-title">document section</td>
                                            <td>{{$document->section->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tble-title">created by</th>
                                            <td>{{ $document->user->name }}</td>
                                            <td scope="row" class="tble-title">created at</td>
                                            <td>{{ display_date2($document["created_at"]) }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tble-title">nom du client</th>
                                            <td colspan="3">
                                                {{ Illuminate\Support\Str::ucfirst($document->client->name) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row" class="tble-title">description</th>
                                            <td colspan="3">
                                                @if($document->description)
                                                {{$document->description}}
                                                @else
                                                <span class="text-danger">pas description disponible</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane" id="attachments">
                                @can('add_attachment')
                                <form action="{{ route('attachments.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row row-sm mb-4" style="flex-direction: row-reverse;">
                                        <div class="col-sm-12 col-md-9 col-lg-9" style="width: 100%">
                                            <div class="custom-file">
                                                <input type="hidden" name="document_id" id="document_id" value="{{ $document->id }}">
                                                <input type="hidden" name="document_name" id="document_name" value="{{ $document->name }}">
                                                <input name="attachment" class="custom-file-input" id="customFile" type="file" accept=".jpg, .png, image/jpeg, image/png, application/pdf">
                                                <label class="custom-file-label" for="customFile">Sélectionner un fichier</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            Valider &nbsp; &nbsp;<i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </form>
                                @endcan

                                @can('list_attachments')
                                <div class="table-responsive" style="display: inline-grid;">
                                    <table class="table table-striped mg-b-0 text-md-nowrap ltr table-responsive" style="text-align: left;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nom du pièce jointe</th>
                                                <th>description</th>
                                                <th>Créé le</th>
                                                <th>Ajouté par</th>
                                                <th>Opérations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach($document->attahments as $attachment)
                                            <tr>
                                                <th scope="row">{{ $i++ }}</th>
                                                <td>{{ $attachment->name  }}</td>
                                                <td>
                                                    @if($attachment->description)
                                                    {{$attachment->description}}
                                                    @else
                                                    <span class="text-danger">pas description disponible</span>
                                                    @endif
                                                </td>
                                                <td>{{ display_date2($attachment["created_at"])  }}</td>
                                                <td>{{ $attachment->user->name }}</td>
                                                <td>
                                                    <div class="btn-icon-list" style="gap: 5px;">
                                                        @can('view_attachment')
                                                        <form action="{{ route('attachments.view') }}" method="get" target="_blank">
                                                            @csrf
                                                            <input type="hidden" name="attachment_name" id="attachment_name" value="{{ $attachment->name }}">
                                                            <input type="hidden" name="document_name" id="document_name" value="{{ $document->name }}">
                                                            <button type="submit" class="btn btn-success btn-icon m-0">
                                                                <i class="fa fa-eye" style="font-size: .9rem;"></i>
                                                            </button>
                                                        </form>
                                                        @endcan

                                                        @can('download_attachment')
                                                        <form action="{{ route('attachments.download') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="attachment_name" id="attachment_name" value="{{ $attachment->name }}">
                                                            <input type="hidden" name="document_name" id="document_name" value="{{ $document->name }}">
                                                            <button type="submit" class="btn btn-secondary btn-icon m-0">
                                                                <i class="fa fa-download" style="font-size: .9rem;"></i>
                                                            </button>
                                                        </form>
                                                        @endcan

                                                        @can('edit_attachment')
                                                        <button data-attachment_id="{{ $attachment->id }}" data-attachment_name='{{ $attachment->name }}' data-description="{{ $attachment->description }}" data-document_name="{{$document->name}}" data-target="#modalEdit" data-toggle="modal" data-effect="effect-scale" class="btn btn-secondary btn-icon m-0">
                                                            <i class="fa fa-pen" style="font-size: .9rem;"></i>
                                                        </button>
                                                        @endcan

                                                        @can('delete_attachment')
                                                        <button data-attachment_id="{{ $attachment->id }}" data-attachment_name="{{ $attachment->name }}" data-document_name="{{$document->name}}" data-target="#modalDelete" data-toggle="modal" data-effect="effect-scale" class="btn btn-danger btn-icon m-0">
                                                            <i class="fa fa-trash" style="font-size: .9rem;"></i>
                                                        </button>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @endcan
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- Start Delete Modal --}}
    <div class="modal" id="modalDelete">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span></button>
                    <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>

                    <form action="{{ route('attachments.delete') }}" method="post">
                        @csrf

                        <input type="hidden" id="attachment_id" name="attachment_id" value="">
                        <input type="hidden" name="document_name" id="document_name" value="">
                        <h4 class="tx-danger mg-b-20">
                            Supprimer la pièce jointe : <span id="attachment_name"></span>
                        </h4>
                        <p class="mg-b-20 mg-x-20">Attention ! Cette action supprimera la pièce jointe sélectionnée</p>

                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Fermer</button>
                        <button type="submit" class="btn ripple btn-danger pd-x-25">Supprimer</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Modal --}}

    {{-- Start Edit Modal --}}
    <div class="modal" id="modalEdit" class="ltr ltr-elem" style="text-align: left; direction: ltr;">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">Modifier les détails de la pièce jointe</h6>
                    <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('attachments.modify') }}" method="post" autocomplete="off">
                    @csrf

                    <div class="modal-body mt-3">
                        <div class="form-outline">
                            <label class="form-label" for="typeText">Nom de la pièce jointe</label>
                            <input type="text" name="attachment_name" id="attachment_name" value="" class="form-control @error('attachment_name') is-invalid @enderror" />
                            <input type="hidden" value="" id="attachment_id" name="attachment_id">
                            <input type="hidden" value="" id="document_name" name="document_name">
                        </div>

                        @error('attachment_name')
                        <div class="alert alert-danger mg-b-0 mt-2" role="alert" style=" direction: ltr !important; text-align: left;">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>&nbsp;&nbsp;
                            <strong>Erreur! &nbsp;&nbsp;</strong> {{ $message }}
                        </div>
                        @enderror

                        <div class="form-outline mt-3">
                            <label class="form-label" for="textAreaExample">Description <span style="font-size: 11px;color: #959595;">(facultatif)</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4"></textarea>
                        </div>

                        @error('description')
                        <div class="alert alert-danger mg-b-0 mt-2" role="alert" style=" direction: ltr !important; text-align: left;">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>&nbsp;&nbsp;
                            <strong>Erreur! &nbsp;&nbsp;</strong> {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Fermer</button>
                        <button class="btn ripple btn-primary" type="submit">Enregistrer les modifications</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    {{-- End Edit Modal --}}




</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection



@section('js')
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>


<script>
    $('#modalDelete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var attachment_id = button.data('attachment_id')
        var attachment_name = button.data('attachment_name')
        var document_name = button.data('document_name')

        var modal = $(this)

        modal.find('.modal-body #attachment_id').val(attachment_id);
        modal.find('.modal-body #document_name').val(document_name);
        modal.find('.modal-body #attachment_name').html(attachment_name);


    })

    $('#modalEdit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var attachment_id = button.data('attachment_id')
        var attachment_name = button.data('attachment_name')
        var attachment_desc = button.data('description')
        var document_name = button.data('document_name')

        var modal = $(this)

        modal.find('.modal-body #attachment_id').val(attachment_id);
        modal.find('.modal-body #document_name').val(document_name);
        modal.find('.modal-body #attachment_name').val(attachment_name);
        modal.find('.modal-body #description').val(attachment_desc);


    })

</script>



@endsection

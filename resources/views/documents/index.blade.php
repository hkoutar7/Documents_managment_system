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
{{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css"> --}}
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script> --}}
{{-- <script src="{{asset('js/documents/main.js')}}"></script> --}}

@endsection


@section('page-header')

@include('sweetalert::alert')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">principal</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0" id="span-special">/ tous les documents</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->

@endsection


@section('content')
<!-- row -->
<div class="row">

    {{-- table data  --}}

    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-header pb-0 ltr-elem ltr">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0">Liste des documents préfectoraux</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2">Ici, vous pouvez consulter votre document en un seul clic </p>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                </div>
                <div class="col-md-5 icond" style="display: flex; justify-content: flex-end; gap: 13px; padding: 10px 35px;">
                    @can('export_document_excel')
                    <a href="{{ route('documents.export') }}" type="button" class="btn btn-outline-primary" data-mdb-ripple-color="dark">Exporter Excel &nbsp;
                        <i class="fa fa-file-csv"></i>
                    </a>
                    @endcan
                    @can('add_document')
                    <a href="{{ route('documents.create') }}" type="button" class="btn btn-outline-primary" data-mdb-ripple-color="dark">Ajouter un document &nbsp;
                        <i class="fa fa-file-medical"></i>
                    </a>
                    @endcan
                </div>
            </div>

            @can('list_documents')
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table key-buttons text-md-nowrap ltr" style="text-align: left;">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">ID</th>
                                <th class="border-bottom-0">Nom du document</th>
                                <th class="border-bottom-0">Section</th>
                                <th class="border-bottom-0">nom du client</th>
                                <th class="border-bottom-0">Créé le</th>
                                <th class="border-bottom-0">Description</th>
                                <th class="border-bottom-0">Opérations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($documents as $document)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $document->name }}</td>
                                <td>{{ $document->section->name }}</td>
                                <td>{{ $document->client->name}}</td>
                                <td>{{ display_date($document['created_at']) }}</td>
                                <td>
                                    @if($document->description)
                                    {{$document->description}}
                                    @else
                                    <span class="text-danger">pas description disponible</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown" style="display: inline-block;">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-secondary ltr-elem" data-toggle="dropdown" type="button">
                                            <i class="fas fa-caret-down ml-1"></i> &nbsp; opération
                                        </button>
                                        <div class="dropdown-menu tx-13">
                                            <h6 class="dropdown-header ltr tx-uppercase tx-11 tx-bold tx-inverse tx-spacing-1">Choisissez votre opération</h6>
                                            @can('view_document')
                                            <a class="dropdown-item ltr-elem" href="{{ route('documents.show',$document->id) }}"><i class="fa fa-eye"></i> &nbsp;  Voir le document </a>
                                            @endcan
                                            @can('edit_document')
                                            <a class="dropdown-item ltr-elem" href="{{ route('documents.edit',$document->id) }}"><i class="fa fa-pen"></i>&nbsp; Modifier le document </a>
                                            @endcan
                                            @can('archive_document')
                                            <a class="dropdown-item ltr-elem" data-id="{{$document->id}}" data-name="{{$document->name}}" data-target="#modalArchive" data-toggle="modal" data-effect="effect-scale"> <i class="fa fa-box"></i> &nbsp; Archiver le document</a>
                                            @endcan
                                            @can('delete_document')
                                            <a class="dropdown-item ltr-elem" data-id="{{$document->id}}" data-name="{{$document->name}}" data-target="#modalDelete" data-toggle="modal" data-effect="effect-scale"> <i class="fa fa-trash"></i> &nbsp; Supprimer le document</a>
                                            @endcan
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endcan
        </div>
    </div>

    {{-- Start Archive Modal --}}
    <div class="modal" id="modalArchive">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span></button>
                    <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>

                    <form action="{{ route('documents.softdelete') }}" method="post">
                        @csrf

                        <input type="hidden" id="id_doc" name="id_doc" value="">
                        <input type="hidden" name="name_doc" id="name_doc" value="">
                        <h4 class="tx-danger mg-b-20">
                            Archiver le Document : <span id="special"></span>
                        </h4>
                        <p class="mg-b-20 mg-x-20">Attention ! Cette action archivera le document sélectionné.</p>

                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Fermer</button>
                        <button type="submit" class="btn ripple btn-danger pd-x-25">Archiver</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- End Archive Modal --}}

    {{-- Start Delete Modal --}}
    <div class="modal" id="modalDelete">

        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span></button>
                    <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>

                    <form action="{{ route('documents.forcedelete') }}" method="post">
                        @csrf

                        <input type="hidden" id="id_doc" name="id_doc" value="">
                        <input type="hidden" name="name_doc" id="name_doc" value="">
                        <h4 class="tx-danger mg-b-20">
                            Supprimer le Document : <span id="special"></span>
                        </h4>
                        <p class="mg-b-20 mg-x-20">Attention ! Cette action supprimera le document sélectionné.</p>

                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Fermer</button>
                        <button type="submit" class="btn ripple btn-danger pd-x-25">Supprimer</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    {{-- End Delete Modal --}}


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
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>

<script>
    $('#modalArchive').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)

        var document_name = button.data('name')
        var document_id = button.data('id')

        var modal = $(this)

        modal.find('.modal-body #name_doc').val(document_name);
        modal.find('.modal-body #id_doc').val(document_id);
        modal.find('.modal-body #special').html(document_name);
    })

    $('#modalDelete').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)

        var document_name = button.data('name')
        var document_id = button.data('id')

        var modal = $(this)

        modal.find('.modal-body #name_doc').val(document_name);
        modal.find('.modal-body #id_doc').val(document_id);
        modal.find('.modal-body #special').html(document_name);
    })

</script>

@endsection

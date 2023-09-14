@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
@endsection


@section('page-header')
@include('sweetalert::alert')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <div class="d-flex align-items-center">
                <h4 class="content-title mb-0">Principal</h4>
                <span class="text-muted ml-3 tx-13">/ Recherchez votre document</span>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb -->

@endsection


@section('content')
<!-- row -->
<div class="row row-sm">
    @if ($errors->any())
    <div style="z-index: 6; position: absolute; display: flex; flex-direction: column; gap: 7px;">
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

    @can('filter_documents')
    <div class="col-xl-3 col-lg-3 col-md-12 mb-3 mb-md-0 mb-5 rtl rtl-elem" style="direction: rtl;text-align: left;">
        <div class="card">
            <div class="card-header border-bottom pt-3 pb-3 mb-0 font-weight-bold text-uppercase">Filtrer</div>
            <div class="card-body pb-0 mb-3">

                <form action="{{ route('reports.filter') }}" method="POST" role="search" autocomplete="off">
                    @csrf
                    <div class="form-group">
                        <label for="section" class="form-label">Section</label>
                        <select id="section" name="section" class="form-control select1 ltr">
                            <option disabled class="select-c" label="Choisissez une section"></option>
                            @foreach($sections as $section)
                            <option value="{{ $section->id }}">
                                {{ $section->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class=" mg-t-10 mg-lg-t-0">
                        <label for="doc_from">Document depuis</label>
                        <div>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                    </div>
                                </div>
                                <input id="doc_from" name="doc_from" class="form-control fc-datepicker" placeholder="MM/JJ/AAAA" type="text" value="{{old('doc_from')}}" style="text-align: left">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 mg-t-10 mg-lg-t-0">
                        <label for="doc_to">Document jusqu'à</label>
                        <div>
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                    </div>
                                </div>
                                <input id="doc_to" name="doc_to" class="form-control fc-datepicker" placeholder="MM/JJ/AAAA" type="text" value="{{old('doc_to')}}" style="text-align: left">
                            </div>
                        </div>
                    </div>

                    <button class="mt-3 btn btn-outline-primary" style="display: block; margin : 0 auto">filter</button>
                </form>

            </div>
        </div>
    </div>
    @endcan

    <div class="col-xl-9 col-lg-9 col-md-12">

        @can('search_documents')
        <div class="card">
            <div class="card-body p-2">
                <div class="input-group" style="flex-direction: row-reverse">
                    <input id="filter_engine" name="filter_engine" type="text" class="form-control ltr" placeholder="Rechercher par nom...">

                    <span class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="white">
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </button>
                    </span>
                </div>
            </div>
        </div>
        @endcan

        <div class="row row-sm">

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0 ltr-elem ltr">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mg-b-0" style="color: #5b6e88; font-size: 13px; font-weight: 500;">Liste des documents préfectoraux</h4>
                            <i class="mdi mdi-dots-horizontal text-gray"></i>
                        </div>
                        <p class="tx-12 tx-gray-500 mb-2">Ici, vous pouvez consulter votre document en un seul clic </p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-md-nowrap ltr" id="example2" style="text-align: left;">
                                <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">ID</th>
                                        <th class="wd-15p border-bottom-0">Nom du document</th>
                                        <th class="wd-20p border-bottom-0">Section</th>
                                        <th class="wd-15p border-bottom-0">Créé le</th>
                                        <th class="wd-10p border-bottom-0">Description</th>
                                        <th class="wd-25p border-bottom-0">Opérations</th>
                                    </tr>
                                </thead>
                                <tbody id="table-foggy">
                                    @php $i = 1; @endphp
                                    @foreach($documents as $document)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $document->name }}</td>
                                        <td>{{ $document->section->name }}</td>
                                        <td>{{ display_date2($document['created_at']) }}</td>
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
                                                    <a class="dropdown-item ltr-elem" href="{{ route('documents.show',$document->id) }}"><i class="fa fa-eye"></i> &nbsp; Voir le document </a>
                                                    <a class="dropdown-item ltr-elem" href="{{ route('documents.edit',$document->id) }}"><i class="fa fa-pen"></i>&nbsp; Modifier le document </a>
                                                    <a class="dropdown-item ltr-elem" data-id="{{$document->id}}" data-name="{{$document->name}}" data-target="#modalArchive" data-toggle="modal" data-effect="effect-scale"> <i class="fa fa-box"></i> &nbsp; Archiver le document</a>
                                                    <a class="dropdown-item ltr-elem" data-id="{{$document->id}}" data-name="{{$document->name}}" data-target="#modalDelete" data-toggle="modal" data-effect="effect-scale"> <i class="fa fa-trash"></i> &nbsp; Supprimer le document</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!-- row closed -->
</div>
<!-- Container closed -->
</div>
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
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<script src="{{URL::asset('assets/plugins/pickerjs/picker.min.js')}}"></script>
<script src="{{URL::asset('assets/js/form-elements.js')}}"></script>

<script src="{{asset('js/reports/main.js')}}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();

</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="{{asset('js/reports/filter.js')}}"></script> --}}
@endsection

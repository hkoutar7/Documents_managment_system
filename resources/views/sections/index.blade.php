@extends('layouts.master')


@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
@endsection


@section('page-header')
@include('sweetalert::alert')

<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">principal</h4> &nbsp; &nbsp;
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ tous les sections</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')

<!-- row -->
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
        <div class="card">
            <div class="card-header pb-0">

                <div class="d-flex justify-content-between ltr ltr-elem">
                    <h4 class="card-title mg-b-0">
                        @if($section_num == 0)
                        <span style="color: red">
                            Aucune section disponible
                        </span>&nbsp;
                        @elseif($section_num == 1)
                        <span style="color: #2196F3;">
                            Une seule section disponible
                        </span>&nbsp;
                        @else
                        <span style="color: #2196F3;">
                            Il y'a {{$section_num}} sections disponibles
                        </span>&nbsp;
                        @endif
                    </h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2 ltr ltr-elem">Gérer les sections : vous pouvez les contrôler en ajoutant, en modifiant ou en supprimant une section.</p>
                @can('section_create')
                <div>
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20" style="margin: 22px auto 2px;">
                        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-super-scaled" data-toggle="modal" href="#modaldemo8"> Ajouter une section &nbsp; &nbsp; <i class="fa fa-plus"></i></a>
                    </div>
                </div>
                @endcan
            </div>
            @can('section_list')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap ltr" id="example1" style="overflow: hidden;">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">nom du section</th>
                                <th class="wd-20p border-bottom-0">description</th>
                                <th class="wd-15p border-bottom-0">operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0
                            @endphp
                            @foreach($sections as $section)

                            <tr style="width : 100%">
                                <td>{{++$i}}</td>
                                <td>{{ $section->name }}</td>
                                <td>
                                    @if($section->description)
                                    {{$section->description}}
                                    @else
                                    <span class="text-danger">pas description disponible</span>
                                    @endif
                                </td>
                                <td style="display: flex;align-items: center; justify-content: flex-start; flex-wrap: wrap; width: 100%;gap : 10px">
                                    @can('section_edit')
                                    <a style="width : 30%" class="modal-effect btn btn-outline-success btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#UpdateModal" data-id='{{$section->id}}' data-section_name='{{$section->name}}' data-description='{{$section->description}}'><i class="las la-pen"></i></a>
                                    @endcan
                                    @can('section_delete')
                                    <a style="width : 30%;margin-top: 0;" class="modal-effect btn btn-outline-danger btn-block" data-effect="effect-slide-in-right" data-toggle="modal" href="#DeleteModal" data-id='{{ $section->id }}' data-section_name='{{$section->name}}'><i class="las la-trash"></i></a>
                                    @endcan
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
</div>

<!-- row closed -->

</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->


<!-- Start Add Section -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo ltr ltr-elem">
            <div class="modal-header">
                <h6 class="modal-title">Ajouter une section</h6>
                <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="{{route("sections.store")}}" method="post" autocomplete="off">
                <div class="modal-body">
                    @csrf

                    <div class="mb-3 mt-3">
                        <label for="section_name" class="form-label">Nom de la section :</label>
                        <input type="text" class="form-control" id="section_name" placeholder="Saisissez le nom de votre section" name="section_name" value="{{ old('section_name') }}">
                    </div>
                    <label for="description">Description de la section :</label>
                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Saisissez une description de la section">{{old('description')}}</textarea>
                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Annuler</button>
                    <button type="submit" class="btn ripple btn-primary" type="button">Enregistrer</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Add Section-->

<!-- Start Moodal edit -->
<div class="modal" id="UpdateModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo ltr ltr-elem">
            <div class="modal-header">
                <h6 class="modal-title">Modifiez les informations de la section </h6>
                <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>

            <form action="sections/update" method="post" autocomplete="off">
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <div class="mb-3 mt-3">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="section_name" class="form-label">Nom de la section :</label>
                        <input type="text" class="form-control" id="section_name" placeholder="Saisissez le nom de votre section" name="section_name" value="">
                    </div>
                    <label for="description">Description de la section :</label>
                    <textarea class="form-control" rows="5" id="description" name="description" placeholder="Saisissez une description de la section"></textarea>

                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Annuler</button>
                    <button type="submit" class="btn ripple btn-primary" type="button">Enregistrer</button>
                </div>
            </form>

        </div>
    </div>

</div>
<!-- End Modal edit -->

<!--Start Modal Delete -->
<div class="modal" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo ltr ltr-elem">

            <div class="modal-header">
                <h6 class="modal-title">Supprimer cette section</h6>
                <button aria-label="Fermer" class="mr-0 close" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="sections/destroy" method="post" autocomplete="off">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="section_name" class="form-label">Nom de la section :</label>
                    <input type="text" class="form-control" id="section_name" name="section_name" value="" readonly>
                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Annuler</button>
                    <button type="submit" class="btn ripple btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End Modal Delete -->


@endsection


</div>


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
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>

{{-- <script src="{{asset('js/reports/main.js')}}"></script> --}}


{{-- script Start Modal edit  --}}
<script>
    $('#UpdateModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })

</script>
{{-- script End Modal edit  --}}

{{-- Start Modal delete  --}}
<script>
    $('#DeleteModal').on('show.bs.modal', function(event) {
        let btn = $(event.relatedTarget)
        let id = btn.data('id')
        let name = btn.data('section_name')

        let mod = $(this)

        mod.find('.modal-body #id').val(id);
        mod.find('.modal-body #section_name').val(name);
    })

</script>
{{-- End Modal delete  --}}


@endsection

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
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">roles</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Liste des roles</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')
@include('sweetalert::alert')
<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0 ltr ltr-elem">
                <p class="tx-12 tx-gray-500 mb-2">Bienvenue dans la section de gestion des autorisations des utilisateurs. Vous pouvez contrôler les autorisations des utilisateurs grâce à cette section.</p>
                @can('role-create')
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20" style="">
                        <a href="{{ route('roles.create') }}" class="btn btn-outline-primary btn-block">Créer un nouveau rôle &nbsp;&nbsp;&nbsp; <i class="fa fa-circle-check"></i></a>
                    </div>
                </div>
                @endcan
            </div>
            @can('role-list')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap ltr" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">ID</th>
                                <th class="wd-15p border-bottom-0">Nom du rôle</th>
                                <th class="wd-25p border-bottom-0">Opérations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($roles as $role)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$role->name}} </td>
                                <td>
                                    @can('role_show')
                                    <a class="btn btn-outline-success" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-eye"></i></a>
                                    @endcan
                                    @can('role-edit')
                                    <a class="btn btn-outline-primary" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-pen"></i></a>
                                    @endcan
                                    @can('role-delete')
                                    <a class="modal-effect btn btn-outline-danger" data-effect="effect-slide-in-right" data-toggle="modal" href="#DeleteModal" data-id='{{ $role->id }}' data-name='{{$role->name}}'><i class="fa fa-trash"></i></a>
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
@endsection

<!--Start Modal Delete -->
<div class="modal" id="DeleteModal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo ltr ltr-elem">

            <div class="modal-header">
                <h6 class="modal-title">Supprimer le rôle</h6>
                <button aria-label="Close" class="close mr-0" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ url('roles/destroy') }}" method="post" autocomplete="off">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="name" class="form-label">Nom du rôle :</label>
                    <input type="text" class="form-control" id="name" name="name" value="" readonly>
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


<script>
    $('#DeleteModal').on('show.bs.modal', function(event) {
        let btn = $(event.relatedTarget)
        let id = btn.data('id')
        let name = btn.data('name')

        let mod = $(this)

        mod.find('.modal-body #id').val(id);
        mod.find('.modal-body #name').val(name);
    })

</script>

@endsection

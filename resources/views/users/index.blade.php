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
<style>
    .editl:hover path {
        fill: white
    }

</style>
@endsection


@section('page-header')
@include('sweetalert::alert')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Utilisateurs</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Liste des utilisateurs</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')
<!-- row -->
<div class="row">

    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">

                <div class="d-flex justify-content-between ltr ltr-elem">
                    <h4 class="card-title mg-b-0">
                        @if($num_users == 0)
                        <span style="color: red">
                            Aucun utilisateur trouvé
                        </span>&nbsp;
                        @elseif($num_users == 1)
                        <span style="color: #2196F3">
                            Il y'a Un seul utilisateur
                        </span>&nbsp;
                        @else
                        <span style="color: #2196F3">
                            Il y a {{$num_users}} utilisateurs
                        </span>&nbsp;
                        @endif</h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2 ltr ltr-elem">Bienvenue dans la section de gestion des utilisateurs. Vous pouvez contrôler les utilisateurs grâce à cette section.</p>
                @can('user_create')
                <div style="display: flex; justify-content: center; align-items: center;">
                    <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20" style="">
                        <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-block"><i class="fa fa-user-plus"></i> &nbsp;&nbsp;&nbsp; Ajouter un utilisateur</a>
                    </div>
                </div>
                @endcan

            </div>
            @can('user_list')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap ltr" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">Id</th>
                                <th class="wd-15p border-bottom-0">Nom complet</th>
                                <th class="wd-20p border-bottom-0">E-mail</th>
                                <th class="wd-15p border-bottom-0">État du compte</th>
                                <th class="wd-10p border-bottom-0">Role</th>
                                <th class="wd-25p border-bottom-0">Opérations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}} </td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if ($user->isActive == 1)
                                    <span style="position:relative; display :block;width : 50% ;background-color: #6aa52b; " class="badge badge-success">
                                        Activé
                                    </span>
                                    @else
                                    <span style="position:relative; display :block; width : 50% ;background-color: #cf5151;; " class="badge badge-success">
                                        Suspendu
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                    @endforeach
                                    @endif
                                </td>
                                <td>
                                    @can('user_show')
                                    <a class="btn btn-outline-success" href="{{ route('users.show',$user->id) }}"><i class="fa fa-user-tie"></i></a>
                                    @endcan
                                    @can('user_edit')
                                    <a class="btn btn-outline-primary editl" href="{{ route('users.edit',$user->id) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512">
                                            <path fill="#0162e8" d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H322.8c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1H178.3zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z" /></svg>
                                    </a>
                                    @endcan
                                    @can('user_delete')
                                    <a class="modal-effect btn btn-outline-danger" data-effect="effect-slide-in-right" data-toggle="modal" href="#DeleteModal" data-id='{{ $user->id }}' data-name='{{$user->name}}' data-password='{{$user->password}}'><i class="fa fa-user-slash"></i></a>
                                    @endcan
                                    @can('user_changeStatus')
                                    <a class="modal-effect btn btn-outline-danger" data-effect="effect-slide-in-right" data-toggle="modal" href="#ChangeStatus" data-id='{{ $user->id }}' data-name='{{$user->name}}' data-status='{{$user->isActive}}'><i class="fa fa-ban"></i></a>
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
                <h6 class="modal-title">Supprimer le compte</h6>
                <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ url('users/destroy') }}" method="post" autocomplete="off">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="name" class="form-label">Nom d'utilisateur :</label>
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

<!--Start Modal ChangeStatus -->
<div class="modal" id="ChangeStatus">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo ltr ltr-elem">

            <div class="modal-header">
                <h6 class="modal-title">Modifier le statut de l'utilisateur</h6>
                <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ url('users/changeStatus') }}" method="post" autocomplete="off">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="status" id="status" value="">
                    <label for="name" class="form-label">Nom d'utilisateur :</label>
                    <input type="text" class="form-control" id="name" name="name" value="" readonly>
                </div>

                <div class="modal-footer">
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Annuler</button>
                    <button type="submit" class="btn ripple " id="changeBtn"></button>
                </div>
            </form>
        </div>
    </div>
</div>


<!--End Modal ChangeStatus -->




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


    $('#ChangeStatus').on('show.bs.modal', function(event) {
        let btn = $(event.relatedTarget);
        let id = btn.data('id');
        let name = btn.data('name');
        let status = btn.data('status');

        let mod = $(this);

        mod.find('.modal-body #id').val(id);
        mod.find('.modal-body #name').val(name);
        mod.find('.modal-body #status').val(status);

        let changeBtn = $('#changeBtn');

        if (status == 1) {
            changeBtn.text('Désactiver le compte')
                .addClass('btn-danger')
                .removeClass('btn-success');
        } else {
            changeBtn.text('Activer le compte')
                .addClass('btn-success')
                .removeClass('btn-danger');
        }
    });

</script>

@endsection

@extends('layouts.master')

@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/documents/index.css') }}">
@endsection


@section('page-header')

@include('sweetalert::alert')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between special ltr ltr-elem">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">principal</h4> &nbsp; &nbsp;
            <span class="text-muted mt-1 tx-13 mr-2 mb-0">/ notre clients</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection


@section('content')

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


<div class="row">
    <div class="col-xl-12">
        <div class="card">

            <div class="card-header pb-0 ltr ltr-elem">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mg-b-0" style="text-transform: lowercase !important">
                        @if($num_clients == 0)
                        <span style="color: red">Il n'y a aucun client maintenant</span>&nbsp;
                        @elseif($num_clients == 1)
                        <span style="color: #2196F3;">Il y a une seule client</span>&nbsp;
                        @else
                        <span style="color: #2196F3;">Il y a {{$num_clients}} clients</span>&nbsp;
                        @endif
                    </h4>
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
                <p class="tx-12 tx-gray-500 mb-2 ltr ltr-elem">Dans cette section, vous pouvez gérer les propriétaires des documents préfectoraux.</p>
                @can('client_add')
                <div class="col-sm-6 col-md-4 col-xl-3 mg-t-20 mt-5" style="margin: 22px auto 2px;">
                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-super-scaled" data-toggle="modal" href="#AddClient"> Ajouter une client &nbsp; &nbsp; <i class="fa fa-plus"></i></a>
                </div>
                @endcan
            </div>
            @can('client_list')
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table text-md-nowrap ltr" id="example2" style="text-align: left">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">Nom complet</th>
                                <th class="wd-20p border-bottom-0">numero de telephone</th>
                                <th class="wd-15p border-bottom-0">email</th>
                                <th class="wd-10p border-bottom-0">biographie</th>
                                <th class="wd-25p border-bottom-0">operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach($clients as $client)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td> {{$client->name}} </td>
                                <td>
                                    @if($client->phone_number)
                                    {{$client->phone_number}}
                                    @else
                                    <span class="text-danger">pas de telephone</span>
                                    @endif
                                </td>
                                <td>
                                    @if($client->email)
                                    {{$client->email}}
                                    @else
                                    <span class="text-danger">pas d'email</span>
                                    @endif
                                </td>
                                <td>
                                    @if($client->description)
                                    {{$client->description}}
                                    @else
                                    <span class="text-danger">Pas de biographie du client</span>
                                    @endif
                                </td>
                                <td>
                                    @can('client_edit')
                                    <a class="modal-effect btn btn-outline-success" data-effect="effect-slide-in-right" data-toggle="modal" href="#updateClient" data-id='{{$client->id}}' data-name='{{$client->name}}' data-phone_number='{{$client->phone_number}}' data-email='{{$client->email}}' data-description='{{$client->description}}'><i class="las la-pen"></i></a>
                                    @endcan
                                    @can('client_delete')
                                    <a class="modal-effect btn btn-outline-danger" data-effect="effect-slide-in-right" data-toggle="modal" href="#deleteClient" data-id='{{ $client->id }}' data-name='{{$client->name}}'><i class="las la-trash"></i></a>
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

    <!-- Start Add Client -->
    <div class="modal" id="AddClient">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo ltr ltr-elem">

                <div class="modal-header">
                    <h6 class="modal-title">Ajouter un client</h6>
                    <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="{{route("clients.store")}}" method="post" autocomplete="off">
                    <div class="modal-body">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du client <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Veuillez saisir le nom du client" value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Téléphone du client <span style="color: #BDBDBD; font-size: 10px;">(optionel)</span></label>

                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Veuillez saisir le téléphone" value="{{ old('phone_number') }}">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email du client <span style="color: #BDBDBD; font-size: 10px;">(optionel)</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Veuillez saisir l'email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="description">Description du client <span style="color: #BDBDBD; font-size: 10px;">(optionel)</span></label>
                            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Saisissez une description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Annuler</button>
                        <button type="submit" class="btn ripple btn-primary" type="button">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Client -->

    <!-- Start Update Client -->
    <div class="modal" id="updateClient">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo ltr ltr-elem">

                <div class="modal-header">
                    <h6 class="modal-title">editer les informations du client</h6>
                    <button aria-label="Fermer" class="close mr-0" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="clients/update" method="post" autocomplete="off">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="id" name="id" value="">
                            <label for="name" class="form-label">Nom du client <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Veuillez saisir le nom du client" value="">
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Téléphone du client <span style="color: #BDBDBD; font-size: 10px;">(optionel)</span></label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Veuillez saisir le téléphone" value="">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email du client <span style="color: #BDBDBD; font-size: 10px;">(optionel)</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Veuillez saisir l'email" value="">
                        </div>

                        <div class="mb-3">
                            <label for="description">Description du client <span style="color: #BDBDBD; font-size: 10px;">(optionel)</span></label>
                            <textarea class="form-control" rows="5" id="description" name="description" placeholder="Saisissez une description"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Annuler</button>
                        <button type="submit" class="btn ripple btn-primary" type="button">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Update Client -->

    <!--Start Modal Delete -->
    <div class="modal" id="deleteClient">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo ltr ltr-elem">

                <div class="modal-header">
                    <h6 class="modal-title">Supprimer ce client</h6>
                    <button aria-label="Fermer" class="mr-0 close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="clients/destroy" method="post" autocomplete="off">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">
                        <label for="name" class="form-label">Nom du client :</label>
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


{{-- script Start Modal edit  --}}
<script>
    $('#updateClient').on('show.bs.modal', function(event) {

        var button = $(event.relatedTarget)

        var id = button.data('id')
        var name = button.data('name')
        var phone_number = button.data('phone_number')
        var email = button.data('email')
        var description = button.data('description')

        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #name').val(name);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #phone_number').val(phone_number);
        modal.find('.modal-body #description').val(description);
    });

</script>
{{-- script End Modal edit  --}}

{{-- Start Modal delete  --}}
<script>
    $('#deleteClient').on('show.bs.modal', function(event) {
        let btn = $(event.relatedTarget)
        let id = btn.data('id')
        let name = btn.data('name')

        let mod = $(this)

        mod.find('.modal-body #id').val(id);
        mod.find('.modal-body #name').val(name);
    })

</script>
{{-- End Modal delete  --}}


@endsection

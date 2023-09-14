<!-- main-sidebar -->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar sidebar-scroll">

    <div class="main-sidebar-header active">
        <a class="desktop-logo logo-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="main-logo" alt="logo"></a>
        <a class="desktop-logo logo-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="main-logo dark-theme" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-light active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-icon" alt="logo"></a>
        <a class="logo-icon mobile-logo icon-dark active" href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon-white.png')}}" class="logo-icon dark-theme" alt="logo"></a>
    </div>


    <div class="main-sidemenu">

        {{-- personal informations  --}}
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    @if(empty(Auth::User()->avatar_id))
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('assets/img/faces/6.jpg')}}">
                    @else
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{userAvatarUrl()}} ">
                    @endif
                    <span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ Auth::User()->name }}</h4>
                    <span class="mb-0 text-muted">{{ Auth::User()->email }}</span>
                </div>
            </div>
        </div>

        {{-- Start side bar  --}}

        <ul class="side-menu">

            <li class="side-item side-item-category">principal</li>
            <li class="slide">
                @can ('dashboard')
                <a class="side-menu__item" href="{{ route('dashboard') }}">
                    <i class="fa iconf fa-tablet"></i>
                    <span class="side-menu__label">tableau de bord</span>
                </a>
                @endcan
            </li>

            <li class="side-item side-item-category">Général</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{url('/' . $page='#') }}">
                    <i class="fa fa-file iconf"></i>
                    <span class="side-menu__label">documents</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    @can ('documents')
                    <li><a class="slide-item" href="{{ route('documents.index')  }}">documents</a></li>
                    @endcan
                    @can('archives')
                    <li><a class="slide-item" href="{{ route('archives.index')  }}">documents archives</a></li>
                    @endcan
                </ul>
            </li>

            @can('reports')
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class="fa iconf fa-folder"></i>
                    <span class="side-menu__label">rapports</span>
                    <i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('reports.index') }}">rapport</a></li>
                </ul>
            </li>
            @endcan

            <li class="side-item side-item-category">paramètres</li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class="fa fa-users iconf"></i>
                    <span class="side-menu__label">utilisateurs et rôles</span><i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    @can('users')
                    <li><a class="slide-item" href="{{ route('users.index') }}">Utilisateurs</a></li>
                    @endcan
                    @can('roles')
                    <li><a class="slide-item" href="{{ route('roles.index') }}">rôles</a></li>
                    @endcan
                </ul>
            </li>
            @can ('sections')
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="{{ url('/' . $page='#') }}">
                    <i class="fa iconf fa-layer-group"></i>
                    <span class="side-menu__label">Sections & Client</span><i class="angle fe fe-chevron-down"></i>
                </a>
                <ul class="slide-menu">
                    <li><a class="slide-item" href="{{ route('sections.index') }}">sections</a></li>
                    <li><a class="slide-item" href="{{ route('clients.index') }}">clients</a></li>
                </ul>
            </li>
            @endcan

        </ul>

        {{-- End side bar  --}}

    </div>
</aside>
<!-- main-sidebar -->

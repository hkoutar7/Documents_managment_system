<!-- main-header opened -->
<div class="main-header sticky side-header nav nav-item gogo" >

    <div class="container-fluid">
        <div class="main-header-left ">
            <div class="responsive-logo">
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
                <a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
            </div>

            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left"></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>

            <div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
                <input class="form-control" placeholder="Cherchez n'importe quoi..." type="search">
                <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
            </div>

        </div>
        <div class="main-header-right">

            {{-- Start Flag Lang  --}}
            <ul class="nav">
                <li class="">
                    <div class="dropdown  nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent">
                                <img src="{{URL::asset('assets/img/flags/french_flag.jpg')}}" alt="img">
                            </span>
                            <div class="my-auto">
                                <strong class="mr-2 ml-2 my-auto">Francais</strong>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
            {{-- End Flag Lang  --}}


            {{-- Start Search --}}
            <div class="nav nav-item  navbar-nav-right ml-auto">
                <div class="nav-link" id="bs-example-navbar-collapse-1">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button type="reset" class="btn btn-default">
                                    <i class="fas fa-times"></i>
                                </button>
                                <button type="submit" class="btn btn-default nav-link resp-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                {{-- End Search --}}


                {{-- Start zoom size  --}}
                <div class="nav-item full-screen fullscreen-button">
                    <a class="new nav-link full-screen-link" href="#" style="display: flex; justify-content: center; align-items: center;"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize">
                            <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path>
                        </svg></a>
                </div>
                {{-- End Zoom size  --}}


                {{-- Start Settings  --}}
                <div class="dropdown main-profile-menu nav nav-item nav-link ltr ltr-elem">
                    <a class="profile-user d-flex" href="">
                        @if(empty(Auth::User()->avatar_id))
                        <img alt="image inexistante" src="{{URL::asset('assets/img/faces/6.jpg')}}">
                        @else
                        <img alt="image n est pas trouve" src="{{userAvatarUrl()}} " style="outline: 3px solid #0060e9;">
                        @endif
                    </a>
                    <div class="dropdown-menu ">

                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user">
                                    @if(empty(Auth::User()->avatar_id))
                                    <img alt="image inexistante" src="{{URL::asset('assets/img/faces/6.jpg')}}">
                                    @else
                                    <img alt="image n est pas trouve" src="{{userAvatarUrl()}} " style="outline: 3px solid #0060e9;">
                                    @endif
                                </div>
                                <div class="mr-3 my-auto" style=" display: flex; flex-direction: column-reverse; align-items: flex-start; margin-left: 7px;">
                                    <h6>{{ Auth::User()->name }}</h6>
                                    <span>{{ Auth::User()->email }}</span>
                                </div>
                            </div>
                        </div>

                        <a class="dropdown-item" href="{{ route("profile.edit") }}" style="gap: 8px"><i class="bx bx-user-circle"></i>Profil</a>
                        <a class="dropdown-item" href=" {{ route("profile.edit") }} " style="gap: 8px"><i class="bx bx-cog"></i>Modifier le profil</a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bx bx-log-out"></i><span style="margin-left: 9px;">Se déconnecter</span>
                            </button>
                        </form>

                    </div>
                </div>
                {{-- End  Settings  --}}

            </div>
        </div>
    </div>
</div>
<!-- /main-header -->

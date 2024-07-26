<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8"/>
    <title>Furqan mebel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesdesign" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    {{--    <link href="{{asset('assets/css/select2.css')}}" rel="stylesheet"/>--}}

    <!-- jquery.vectormap css -->
    <link href="{{asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"
          type="text/css"/>

    <!-- Bootstrap Css -->
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/libs/dropzone/min/dropzone.min.css')}}" id="app-style" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
</head>

<body data-topbar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->

<!-- Begin page -->
<div id="layout-wrapper">

    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('home')}}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-dark.png')}}" alt="logo-dark" height="20">
                                </span>
                    </a>

                    <a href="{{route('home')}}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('assets/images/logo-sm.png')}}" alt="logo-sm-light" height="22">
                                </span>
                        <span class="logo-lg">
                                    <img src="{{asset('assets/images/logo-light.png')}}" alt="logo-light" height="20">
                                </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                        id="vertical-menu-btn">
                    <i class="ri-menu-2-line align-middle"></i>
                </button>

                <!-- App Search-->
                <form class="app-search d-none d-lg-block">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="ri-search-line"></span>
                    </div>
                </form>

            </div>

            <div class="d-flex">

                <div class="dropdown d-inline-block d-lg-none ms-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ri-search-line"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="mb-3 m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="ri-fullscreen-line"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block user-dropdown">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-xl-inline-block ms-1">{{Auth::user()->name}}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="javascript: void(0)"><i
                                class="ri-user-line align-middle me-1"></i> Profile</a>
                        <a class="dropdown-item d-block" href="javascript: void(0)"><span
                                class="badge bg-success float-end mt-1">11</span><i
                                class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="{{route('logout')}}"><i
                                class="ri-shut-down-line align-middle me-1 text-danger"></i> Çıxış</a>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">Menu</li>

                    <li>
                        <a href="{{route('home')}}" class="waves-effect">

                            <span>Admin panel</span>

                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-layout-3-line"></i>
                            <span>İstifadəçilər</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('users.create')}}">İstifadəçi yarat</a></li>
                            <li><a href="{{route('users.index')}}">İstifadəçilər</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('mains.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Hero</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('abouts.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Haqqımızda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('categories.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Kateqoriyalar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('products.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Məhsullar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('campaigns.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Kampaniyalar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('blogs.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Xəbərlər</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('testimonials.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Müştəri rəyləri</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('credits.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Kredit şərtləri</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('offices.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Filiallar</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('images.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Logo</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('socials.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Sosial şəbəkələr</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('words.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Tərcümələr</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('contacts.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Əlaqə mesajları</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('contact_items.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>Əlaqə məlumatları</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('singles.index')}}">
                            <i class="ri-layout-3-line"></i>
                            <span>SEO</span>
                        </a>
                    </li>


                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

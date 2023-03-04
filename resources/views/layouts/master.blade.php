
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Starter Laravel Application') }}</title>
      <link rel="stylesheet" href="/css/app.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
   <!-- Left navbar links -->
   <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
    </li>
  </ul>

  <!-- SEARCH FORM -->
  <div class="input-group input-group-sm">
    <input class="form-control col-3 form-control-navbar"   type="search" placeholder="Search" aria-label="Search">
    <div class="input-group-append">
      <button class="btn btn-navbar" >
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
</nav>
    {{-- <div class="input-group input-group-sm">
      <input class="form-control col-3 form-control-navbar"  v-model="search" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" >
          <i class="fa fa-search"></i>
        </button>
      </div>
    </div>
  </nav> --}}
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/img/logo.png" alt="Present Tense Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span style="font-size: 14px" class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ Auth::user()->name }}
           <p> {{ Auth::user()->type }}</p>
        </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
                <router-link to="/dashboard" class="nav-link">
                  <i class="nav-icon fas fa-th text-blue"></i>
                  <p>
                   Dashboard
                    {{-- <span class="right badge badge-danger">New</span> --}}
                  </p>
                </router-link>
              </li>


        @can('isAdmin')
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fas fa-users nav-icon text-green"></i>
                  <p>Users</p>
                </router-link>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-lock nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-lock nav-icon"></i>
                  <p>Permissions</p>
                </a>
              </li>
            </ul>
          </li>
          @endcan


          @can('isAdmin')
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cog"></i>
              <p>
                DVDS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/audio-dvds" class="nav-link">
                    <i class="far fa-file-audio nav-icon text-green"></i>
                    <p>Audio DVDS</p>
                  </router-link>
              </li>
              <li class="nav-item">

                <li class="nav-item">
                    <router-link to="/video-dvds" class="nav-link">
                        <i class="far fa-file-video nav-icon nav-icon text-green"></i>
                        <p>Video DVDS</p>
                      </router-link>
                  </li>
              </li>
            </ul>
          </li>
          @endcan


          @can('isAdmin')
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-music"></i>
              <p>
                SONGS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                    <router-link to="/present-tense-songs" class="nav-link">
                        <i class="fa fa-music nav-icon nav-icon nav-icon text-green"></i>
                        <p>The Present Tense Songs</p>
                      </router-link>
                  </li>

              <li class="nav-item">
                    <router-link to="/ten-major-songs" class="nav-link">
                        <i class="fa fa-music nav-icon nav-icon nav-icon text-green"></i>
                        <p>God Ten Major Songs</p>
                      </router-link>
              </li>

              <li class="nav-item">
                    <router-link to="/praises-and-worship-songs" class="nav-link">
                        <i class="fa fa-music nav-icon nav-icon nav-icon text-green"></i>
                        <p>Praises And Whorship</p>
                      </router-link>
              </li>

              <li class="nav-item">
                    <router-link to="/big-songbook-songs" class="nav-link">
                        <i class="fa fa-music nav-icon nav-icon nav-icon text-green"></i>
                        <p>Big Song Book Songs</p>
                      </router-link>
              </li>
              <li class="nav-item">
                    <router-link to="/in-various-tongues-songs" class="nav-link">
                        <i class="fa fa-music nav-icon nav-icon nav-icon text-green"></i>
                        <p>Songs In Various Tongues</p>
                      </router-link>
              </li>
            </ul>
          </li>
          @endcan

          {{-- @can('isAdmin')
          <li class="nav-item">
            <router-link to="/developer" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Developer
                </p>
            </router-link>
     </li>
          @endcan --}}


          {{-- <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Profile
              </p>
            </router-link>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                            <i class="nav-icon fa fa-power-off text-red"></i>
             <p>
                 {{ __('Logout') }}
            </p>
         </a>

         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    {{-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div> --}}
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023-2023 <a href="/">{{ config('app.name', 'Laravel') }}</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth

<!-- REQUIRED SCRIPTS -->

<script src="/js/app.js"></script>
</body>
</html>

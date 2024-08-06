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

<title>DashBoard</title>

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="{{asset("admin/css/fontawesome.all.css")}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset("admin/css/adminlte.css")}}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
@yield('adminCss')
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset("admin/img/logo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Degel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset("admin/img/user-profile.jpg")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin user</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{route("cat.index")}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
          Categories   
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("skill.index")}}" class="nav-link">
              <i class="nav-icon fas fa-brain"></i>
              <p>
          skills   
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("exam.index")}}" class="nav-link">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
          exams   
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("student.index")}}" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
          Students   
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("admin.index")}}" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
          admins   
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route("msg.index")}}" class="nav-link">
              <i class="fas fa-envelope"></i>
              
              <p>
          msgs   
              </p>
            </a>
          </li>
          @if (App::getlocale() == "en")
          <li class="nav-item">
            <a href="{{route("lang.set",["lang"=> "ar"])}}" class="nav-link">
              <i class="fas fa-envelope"></i>
              
              <p>
          ar   
              </p>
            </a>
          </li>
            @else
            <li class="nav-item">
              <a href="{{route("lang.set",["lang"=> "en"])}}" class="nav-link">
                <i class="fas fa-envelope"></i>
                
                <p>
            en   
                </p>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield("content")
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
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset("admin/js/jquery.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("admin/js/bootstrap.bundle.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("admin/js/adminlte.js")}}"></script>
@yield("js.admin")
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

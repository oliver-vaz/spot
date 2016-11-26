<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ URL::to( '/' ). "/bootstrap/css/bootstrap.min.css"  }} " rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/'). "/dist/css/AdminLTE.min.css" }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you ######## HEYYYYYYYYYYYY!! ######
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ URL::to('/'). "/dist/css/skins/skin-yellow.min.css" }} " rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
  -->
  <body class="skin-yellow sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="\" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Spot</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="{{ URL::to('/'). "/dist/img/user2-160x160.jpg" }}" class="user-image" alt="User Image"/>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Usuario</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="{{ URL::to('/'). "/dist/img/user2-160x160.jpg" }} " class="img-circle" alt="User Image" />
                    <p>
                      Usuario - Spot
                      <small>Since 2008</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Salir de la App</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="{{ URL::to('/'). "/dist/img/user2-160x160.jpg" }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>
                @if( isset($user) )
                  $user
                @else
                  Usuario
                @endif
              </p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header"><b>Opciones</b></li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ URL::to('/home')}}"><i class='fa fa-link'></i> <span>Dashboard</span></a></li>
            <li><a href="{{ URL::to('/maintenances/create')}}"><i class='fa fa-link'></i> <span>Mantenimientos</span></a></li>
            <li><a href="{{ URL::to('/drivers/create')}}"><i class='fa fa-link'></i> <span>Conductores</span></a></li>
            <li><a href="{{ URL::to('/cars/create')}}"><i class='fa fa-link'></i> <span>Carros</span></a></li>
            <!--<li><a href="{{ URL::to('/customers/create')}}"><i class='fa fa-link'></i> <span>Pendiente</span></a></li>             <li class="treeview">
              <a href="#"><i class='fa fa-link'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#">Reporte tipo 1</a></li>
                <li><a href="#">Reporte tipo 2</a></li>
                <li><a href="#">Reporte tipo 3</a></li>
                <li><a href="#">Reporte tipo 4</a></li>
              </ul>
            </li> -->
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          @if( isset($data['']) )
          <h1>
            {{ $data[title]."<small>".$data['description']."</small>" }}
          </h1>
          @else
          <h1>
            Spot<small></small>
          </h1>
          @endif
        </section>

      @yield( 'page_content' )
    </div>
      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Spot Servicios Profesionales S.A de C.V.
        </div>
        <!-- Default to the left -->
        <strong>Crafted by <a href="vazquezoliver@gmail.com">Oliver Vazquez</a>.</strong>
      </footer>
    <!-- Control Sidebar -->      
    <aside class="control-sidebar control-sidebar-dark">                
      <!-- Create the tabs -->
      <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane active" id="control-sidebar-home-tab">
          <h3 class="control-sidebar-heading">Recent Activity</h3>
          <ul class='control-sidebar-menu'>
            <li>
              <a href='javascript::;'>
                <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                  <p>Will be 23 on April 24th</p>
                </div>
              </a>
            </li>              
          </ul><!-- /.control-sidebar-menu -->

          <h3 class="control-sidebar-heading">Tasks Progress</h3> 
          <ul class='control-sidebar-menu'>
            <li>
              <a href='javascript::;'>               
                <h4 class="control-sidebar-subheading">
                  Custom Template Design
                  <span class="label label-danger pull-right">70%</span>
                </h4>
                <div class="progress progress-xxs">
                  <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                </div>                                    
              </a>
            </li>                         
          </ul><!-- /.control-sidebar-menu -->         

        </div><!-- /.tab-pane -->
        <!-- Stats tab content -->
        <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">            
          <form method="post">
            <h3 class="control-sidebar-heading">General Settings</h3>
            <div class="form-group">
              <label class="control-sidebar-subheading">
                Report panel usage
                <input type="checkbox" class="pull-right" checked />
              </label>
              <p>
                Some information about this general settings option
              </p>
            </div><!-- /.form-group -->
          </form>
        </div><!-- /.tab-pane -->
      </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class='control-sidebar-bg'></div>
  </div><!-- ./wrapper -->

  <!-- REQUIRED JS SCRIPTS -->
  <script type="application/javascript" >var main_path = '{{ URL::to('/') }}' ;</script>
  <!-- jQuery 2.1.4 -->
  <script type="application/javascript" src="{{ URL::to('/'). "/plugins/jQuery/jQuery-2.1.4.min.js" }}"></script>
  <!-- Bootstrap 3.3.2 JS -->
  <script type="application/javascript" src="{{ URL::to('/'). "/bootstrap/js/bootstrap.min.js" }}"></script>
  <!-- AdminLTE App -->
  <script type="application/javascript" src="{{ URL::to('/'). "/dist/js/app.min.js" }}"></script>
  @yield('js')

  @yield( 'modals' )
</body>
</html>
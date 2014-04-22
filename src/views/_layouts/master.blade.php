<!Doctype html>
<html>
    <head>
        <meta name='author' content='Cristian Moreno' />
        <meta name='author' content='Edgardo Troche' />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ (isset($title))? $title : 'Sistema Ecsa' }}</title>
        <link rel="stylesheet" href="{{ asset('packages/ecco/ecsa/css/bootstrap.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/ecco/ecsa/font-awesome/css/font-awesome.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/ecco/ecsa/css/app.css') }}" />
        <script src="{{ asset('packages/ecco/ecsa/js/jquery-2.1.0.min.js') }}" ></script>
        <script src="{{ asset('packages/ecco/ecsa/js/bootstrap.js') }}" ></script>
        @yield('assets')
    </head>
    <body>
        <div id="wrapper">
            <!-- Sidebar -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
              <!-- Brand and toggle get grouped for better mobile display -->
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                  <span class="sr-only">navegcion</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">{{ \Config::get('ecsa::app') }}</a>
              </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                  <ul class="nav navbar-nav side-nav">
                     @if(\Session::get('company'))
                    <li {{ ($active == 1) ? 'class="active"' : '' }} ><a href="{{ URL::route('dashboard.index') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                    <li {{ ($active == 3) ? 'class="active"' : '' }} ><a href="{{ URL::route(\Config::get('ecsa::prefix').'.clientes.index') }}"><i class="fa fa-male"></i> Clientes</a></li>
                    @endif
                    <li {{ ($active == 2) ? 'class="active"' : '' }} ><a href="{{ URL::route(\Config::get('ecsa::prefix').'.organization.index') }}"><i class="fa fa-bookmark"></i> {{trans('ecsa::titles.organization.index')}}</a></li>
                  </ul>

                  <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                      @if(\Session::get('company'))
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-unlink"></i> Administrar Otra Empresa</a>
                       @else
                        <a href="{{ URL::route('company.select') }}" ><i class="fa fa-link"></i> Administrar Empresa</a>
                       @endif
                    </li>
                    <li class="dropdown alerts-dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                        <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                        <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                        <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                        <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                        <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                        <li class="divider"></li>
                        <li><a href="#">View All</a></li>
                      </ul>
                    </li>
                    <li class="dropdown user-dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-user"></i> 
                          {{ ucwords($user->first_name) }} {{ ucwords($user->last_name) }}
                          <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Perfil</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ URL::route('account.logout') }}"><i class="fa fa-power-off"></i> {{ trans('ecsa::titles.user.logout') }}</a></li>
                      </ul>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            <div id="page-wrapper">
                <div class="row">
                <div class="col-lg-12">
                  @yield('title')
                  @yield('breadcrumb')
                  @yield('info')
                </div>
              </div><!-- /.row -->
              <div class="row">
                @yield('content')
                @yield('right')
              </div>
            </div>
        </div>
    </body>
</html>
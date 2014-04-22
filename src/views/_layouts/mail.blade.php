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
    </head>
    <body>
        <div id="wrapper">
            <!-- Sidebar -->
            <div id="page-wrapper">
                <div class="row">
                <div class="col-lg-12">
                    <h1>Bienvenido a ECSA</h1>
                    <table class="table-striped table table-bordered" >
                        <thead>
                            <tr>
                                <th colspan="2" > Datos de Tu Cuenta en ECSA</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Tu Nombre: </th>
                                <td>{{ $nombre }}</td>
                            </tr>
                            <tr>
                                <th>Contraseña</th>
                                <td>{{ $pass }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3>Gracias Por tu Registro en ECSA</h3>
                </div>
              </div><!-- /.row -->
            </div>
        </div>
    </body>
</html>
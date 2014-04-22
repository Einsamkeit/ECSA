<!Doctype html>
<html>
    <head>
        <meta name='author' content='Cristian Moreno' />
        <meta name='author' content='Edgardo Troche' />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ (isset($title))? $title : 'Sistema Ecsa' }}</title>
        <link rel="stylesheet" href="{{ asset('packages/ecco/ecsa/css/login.css') }}" />
        <link rel="stylesheet" href="{{ asset('packages/ecco/ecsa/css/bootstrap.css') }}" />
        <script src="{{ asset('packages/ecco/ecsa/js/jquery-2.1.0.min.js') }}" ></script>
        <script src="{{ asset('packages/ecco/ecsa/js/bootstrap.js') }}" ></script>
        <style>
            h1 { font-size: 16px; }
        </style>
    </head>
    <body>
        @yield('content')
    </body>
</html>
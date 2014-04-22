<!Doctype html>
<html>
    <head>
        <meta name='author' content='Cristian Moreno' />
        <meta name='author' content='Edgardo Troche' />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ (isset($title))? $title : 'Sistema Ecsa' }}</title>
        <link rel="stylesheet" href="{{ asset('packages/ecco/ecsa/css/login.css') }}" />
    </head>
    <body>
        @yield('menu')
        @yield('content')
    </body>
</html>
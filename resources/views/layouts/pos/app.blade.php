<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>POS Efata Game Solution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.pos.components.style')
    @stack('css')
</head>

<body>
    <div id="layoutDefault">
        <div id="layoutDefault_content">
            <main>
                @include('layouts.pos.components.navbar')

                @yield('content')
            </main>
        </div>
    </div>

    @include('layouts.pos.components.script')
    @stack('js')
</body>

</html>

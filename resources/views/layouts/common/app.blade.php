<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="keywords" content="#filledlater" />
        <meta name="description" content="#filledlater" />
        <meta name="author" content="Efata Game Solution" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            @if(View::hasSection('title'))
                @yield('title')
            @else
                Efata Game Solution
            @endif
        </title>

        @include('layouts.common.components.style')

    </head>
    <body>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    @yield('content')
                </main>
            </div>
            <div id="layoutDefault_footer">
                @include('layouts.common.components.footer')
            </div>
        </div>
        @include('layouts.common.components.script')
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    {{-- start head --}}
    @include('frontend.dashboard.layouts.partials.head')
    {{-- end head --}}
</head>
<body >
    <div id="app">
        {{-- start sidebar --}}
        @yield('sidebar')
        {{-- @include('frontend.dashboard.layouts.partials.sidebar') --}}
        {{-- end sidebar --}}
        <div id="main">
           {{-- start topbar --}}
           @include('frontend.dashboard.layouts.partials.topbar')
           {{-- end topbar --}}

           {{-- start content --}}
           @yield('content')
           {{-- end content --}}

            {{-- start footer --}}
            @include('frontend.dashboard.layouts.partials.footer')
            {{-- end footer --}}
        </div>
    </div>
    {{-- modalUser --}}
    @include('frontend.dashboard.layouts.partials.modalUser')
   {{-- start script --}}
   @include('frontend.dashboard.layouts.partials.script')
   {{-- end script --}}
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Voler Admin Dashboard</title>

    @include('frontend.dashboard.partials.head')
</head>
<body>
    <div id="app">

        @include('frontend.dashboard.partials.sidebar')
        @yield('content')
        @include('frontend.layouts.partials.footer')
    </div>
    @include('frontend.dashboard.partials.script')
</body>
</html> --}}

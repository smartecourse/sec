<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{{-- @if (strlen(Req)) --}}
<title>{{ Request::segment(2) == '' ? 'Dashboard' : (Request::segment(3) != '' && strlen(Request::segment(3)) > 3 ? ucwords(str_replace('-', ' ', Request::segment(3))) : ucwords(str_replace('-', ' ', Request::segment(2)))) }}</title>
<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.css') }}">

<link rel="stylesheet" href="{{ asset('frontend/assets/vendors/chartjs/Chart.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/vendors/simple-datatables/style.css') }}">

<link rel="stylesheet" href="{{ asset('frontend/assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
{{-- yield css  --}}
{{-- end css --}}
<link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.svg') }}" type="image/x-icon">
<link rel="stylesheet" href=" {{ asset('frontend/assets/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
@yield('dashboard-css')


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.83.1">
<title>
    {{ 
        Request::segment(2) != null 
        ?
            ucwords(str_replace('-', ' ', Request::segment(2))).' - '
        :
        (Request::segment(1) != null
        ?
            ucwords(str_replace('-', ' ', Request::segment(1)))
        :
        '')
    }}
    Smart Course
</title>

<!-- Bootstrap core CSS -->
<link href=" {{ asset('frontend/assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<!-- Custom styles for this template -->
<link href=" {{ asset('frontend/assets/css/style.css') }} " rel="stylesheet">
{{-- animations --}}
<link rel="stylesheet" href=" {{ asset('frontend/assets/dist/css/animations.css') }} ">
{{-- FontAwesome --}}
<link rel="stylesheet" href=" {{ asset('frontend/assets/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="{{ asset('frontend/assets/plyr.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/assets/css/dark-mode.css') }}">


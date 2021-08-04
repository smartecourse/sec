<!DOCTYPE html>
<html lang="en">
<head>
@include('frontend.layouts.partials.head')
</head>
<body class="d-flex flex-column h-100">
<div class="header-3-3 container-xxl mx-auto py-5 p-0 position-relative" style="font-family: 'Poppins', sans-serif">
@include('frontend.layouts.partials.navbar')
<!-- START NAVIGATION TOPBAR  -->
<main class="flex-shrink-0">
<!-- end navigation -->
@yield('content')
@yield('download')
</div>
  <!-- <section> begin ============================-->
</main>
@include('frontend.layouts.partials.footer')
<!-- <section> close ============================-->
<script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script src=" {{ asset('frontend/assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src=" {{ asset('frontend/assets/js/dark-mode-switch.js') }}"></script>

{{-- audioPlayer --}}
<script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
<script>
    const player = new Plyr('#player',{
        ratio: '16:9',
        enabled: /iPhone|iPad|iPod/,
        // autopause: true,
        // autoplay: true,
        controls: [
                'play-large', // The large play button in the center
                'restart', // Restart playback
                'rewind', // Rewind by the seek time (default 10 seconds)
                'play', // Play/pause playback
                'fast-forward', // Fast forward by the seek time (default 10 seconds)
                'progress', // The progress bar and scrubber for playback and buffering
                'current-time', // The current time of playback
                'duration', // The full duration of the media
                'mute', // Toggle mute
                'volume', // Volume control
                'captions', // Toggle captions
                'settings', // Settings menu
                'pip', // Picture-in-picture (currently Safari only)
                'airplay', // Airplay (currently Safari only)
                // 'download', // Show a download button with a link to either the current source or a custom URL you specify in your options
                'fullscreen', // Toggle fullscreen
            ],
        youtube: {
            playsinline: true,
            autoplay:true
        },

    });
</script>

<script>
$(document).ready(function(){
var scroll_start = 0;
var startchange = $('#startchange');
var offset = startchange.offset();
if (startchange.length){
    $(document).scroll(function() {
        scroll_start = $(document).scrollTop();
        if(scroll_start > offset.top) {
            // $(".navbar-top").css('backdrop-filter', 'blur(10px)');
            $(".navbar-top").css('background-color', '#fff');
        } else {
            $('.navbar-top').css('background', 'transparent');
        }
    });
}
});

$(window).scroll(function() {
    $('#belajar').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow+200) {
            $(this).addClass("hatch");
        }
    });

    $('#regular').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow+200) {
            $(this).addClass("bigEntrance");
        }
    });
    $('#private').each(function(){
    var imagePos = $(this).offset().top;

    var topOfWindow = $(window).scrollTop();
        if (imagePos < topOfWindow+200) {
            $(this).addClass("expandOpen");
        }
    });
});
</script>

</html>







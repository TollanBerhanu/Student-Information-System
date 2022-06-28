{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Dashboard 1 --}}

    <div class="row">
        <div class="container_b">
            <div class="bird-container bird-container--one">
                <div class="bird bird--one"></div>
            </div>
{{--            <div class="bird-container bird-container--two">--}}
{{--                <div class="bird bird--two"></div>--}}
{{--            </div>--}}
            <div class="bird-container bird-container--three">
                <div class="bird bird--three"></div>
            </div>
{{--            <div class="bird-container bird-container--four">--}}
{{--                <div class="bird bird--four"></div>--}}
{{--            </div>--}}
            <div class="bird-container bird-container--five">
                <div class="bird bird--five"></div>
            </div>
{{--            <div class="bird-container bird-container--six">--}}
{{--                <div class="bird bird--six"></div>--}}
{{--            </div>--}}
            <div class="bird-container bird-container--seven">
                <div class="bird bird--seven"></div>
            </div>
{{--            <div class="bird-container bird-container--eight">--}}
{{--                <div class="bird bird--eight"></div>--}}
{{--            </div>--}}
            <div class="bird-container bird-container--nine">
                <div class="bird bird--nine"></div>
            </div>
        </div>
    </div>

@endsection

{{-- Scripts Section --}}
@section('styles')
   <style>
       body{
           background-image: url({{asset('media/bg/bg-nature.jpg')}});
           background-position: center; /* Center the image */
           background-repeat: no-repeat; /* Do not repeat the image */
           background-size: cover; /* Resize the background image to cover the entire container */
       }
       .container_b {
           /*background: #d9f4ff;*/
           width: 100%;
           height: 50vh;
           margin: 0 auto;
           position: relative;
           overflow: hidden;
       }

       .bird {
           background-image: url({{asset('media/svg/objects/bird.svg')}});
           color: #2d2443;
           background-size: auto 100%;
           width: 88px;
           height: 125px;
           will-change: background-position;
           -webkit-animation-name: fly-cycle;
           animation-name: fly-cycle;
           -webkit-animation-timing-function: steps(10);
           animation-timing-function: steps(10);
           -webkit-animation-iteration-count: infinite;
           animation-iteration-count: infinite;
       }
       .bird--one {
           -webkit-animation-duration: 1s;
           animation-duration: 1s;
           -webkit-animation-delay: -0.5s;
           animation-delay: -0.5s;
       }
       .bird--two {
           -webkit-animation-duration: 0.9s;
           animation-duration: 0.9s;
           -webkit-animation-delay: -0.75s;
           animation-delay: -0.75s;
       }
       .bird--three {
           -webkit-animation-duration: 1.25s;
           animation-duration: 1.25s;
           -webkit-animation-delay: -0.25s;
           animation-delay: -0.25s;
       }
       .bird--four {
           -webkit-animation-duration: 1.1s;
           animation-duration: 1.1s;
           -webkit-animation-delay: -0.5s;
           animation-delay: -0.5s;
       }
       .bird--five {
           -webkit-animation-duration: 1.1s;
           animation-duration: 1.1s;
           -webkit-animation-delay: -0.4s;
           animation-delay: -0.4s;
       }
       .bird--six {
           -webkit-animation-duration: 0.9s;
           animation-duration: 0.9s;
           -webkit-animation-delay: -0.65s;
           animation-delay: -0.65s;
       }
       .bird--seven {
           -webkit-animation-duration: 1.45s;
           animation-duration: 1.45s;
           -webkit-animation-delay: -0.85s;
           animation-delay: -0.85s;
       }
       .bird--eight {
           -webkit-animation-duration: 1.15s;
           animation-duration: 1.15s;
           -webkit-animation-delay: -0.25s;
           animation-delay: -0.25s;
       }
       .bird--nine {
           -webkit-animation-duration: 1.45s;
           animation-duration: 1.45s;
           -webkit-animation-delay: -0.85s;
           animation-delay: -0.85s;
       }
       .bird--ten {
           -webkit-animation-duration: 1.15s;
           animation-duration: 1.15s;
           -webkit-animation-delay: -0.25s;
           animation-delay: -0.25s;
       }

       .bird-container {
           position: absolute;
           bottom: 45%;
           left: 0;
           transform: scale(0) translateX(-10vw);
           will-change: transform;
           -webkit-animation-name: fly-right-one;
           animation-name: fly-right-one;
           -webkit-animation-timing-function: linear;
           animation-timing-function: linear;
           -webkit-animation-iteration-count: infinite;
           animation-iteration-count: infinite;
       }
       .bird-container--one {
           -webkit-animation-duration: 15s;
           animation-duration: 15s;
           -webkit-animation-delay: 0.5s;
           animation-delay: 0.5s;
       }
       .bird-container--two {
           -webkit-animation-duration: 16s;
           animation-duration: 16s;
           -webkit-animation-delay: 1s;
           animation-delay: 1s;
       }
       .bird-container--three {
           -webkit-animation-duration: 14.6s;
           animation-duration: 14.6s;
           -webkit-animation-delay: 2.5s;
           animation-delay: 2.5s;
       }
       .bird-container--four {
           -webkit-animation-duration: 16s;
           animation-duration: 16s;
           -webkit-animation-delay: 4.25s;
           animation-delay: 4.25s;
       }
       .bird-container--five {
           -webkit-animation-duration: 12s;
           animation-duration: 12s;
           -webkit-animation-delay: 6.3s;
           animation-delay: 6.3s;
       }
       .bird-container--six {
           -webkit-animation-duration: 11s;
           animation-duration: 11s;
           -webkit-animation-delay: 8.7s;
           animation-delay: 8.7s;
       }
       .bird-container--seven {
           -webkit-animation-duration: 14.6s;
           animation-duration: 14.6s;
           -webkit-animation-delay: 11.55s;
           animation-delay: 11.55s;
       }
       .bird-container--eight {
           -webkit-animation-duration: 18s;
           animation-duration: 18s;
           -webkit-animation-delay: 13.6s;
           animation-delay: 13.6s;
       }
       .bird-container--nine {
           -webkit-animation-duration: 14.6s;
           animation-duration: 14.6s;
           -webkit-animation-delay: 15.55s;
           animation-delay: 15.55s;
       }
       .bird-container--ten {
           -webkit-animation-duration: 18s;
           animation-duration: 18s;
           -webkit-animation-delay: 17.6s;
           animation-delay: 17.6s;
       }

       @-webkit-keyframes fly-cycle {
           100% {
               background-position: -900px 0;
           }
       }

       @keyframes fly-cycle {
           100% {
               background-position: -900px 0;
           }
       }
       @-webkit-keyframes fly-right-one {
           0% {
               transform: scale(0.3) translateX(-10vw);
           }
           10% {
               transform: translateY(2vh) translateX(10vw) scale(0.4);
           }
           20% {
               transform: translateY(0) translateX(30vw) scale(0.5);
           }
           30% {
               transform: translateY(4vh) translateX(50vw) scale(0.6);
           }
           40% {
               transform: translateY(2vh) translateX(70vw) scale(0.6);
           }
           50% {
               transform: translateY(0) translateX(90vw) scale(0.6);
           }
           60% {
               transform: translateY(0) translateX(110vw) scale(0.6);
           }
           100% {
               transform: translateY(0) translateX(110vw) scale(0.6);
           }
       }
       @keyframes fly-right-one {
           0% {
               transform: scale(0.3) translateX(-10vw);
           }
           10% {
               transform: translateY(2vh) translateX(10vw) scale(0.4);
           }
           20% {
               transform: translateY(0) translateX(30vw) scale(0.5);
           }
           30% {
               transform: translateY(4vh) translateX(50vw) scale(0.6);
           }
           40% {
               transform: translateY(2vh) translateX(70vw) scale(0.6);
           }
           50% {
               transform: translateY(0) translateX(90vw) scale(0.6);
           }
           60% {
               transform: translateY(0) translateX(110vw) scale(0.6);
           }
           100% {
               transform: translateY(0) translateX(110vw) scale(0.6);
           }
       }
       @-webkit-keyframes fly-right-two {
           0% {
               transform: translateY(-2vh) translateX(-10vw) scale(0.5);
           }
           10% {
               transform: translateY(0) translateX(10vw) scale(0.4);
           }
           20% {
               transform: translateY(-4vh) translateX(30vw) scale(0.6);
           }
           30% {
               transform: translateY(1vh) translateX(50vw) scale(0.45);
           }
           40% {
               transform: translateY(-2.5vh) translateX(70vw) scale(0.5);
           }
           50% {
               transform: translateY(0) translateX(90vw) scale(0.45);
           }
           51% {
               transform: translateY(0) translateX(110vw) scale(0.45);
           }
           100% {
               transform: translateY(0) translateX(110vw) scale(0.45);
           }
       }
       @keyframes fly-right-two {
           0% {
               transform: translateY(-2vh) translateX(-10vw) scale(0.5);
           }
           10% {
               transform: translateY(0) translateX(10vw) scale(0.4);
           }
           20% {
               transform: translateY(-4vh) translateX(30vw) scale(0.6);
           }
           30% {
               transform: translateY(1vh) translateX(50vw) scale(0.45);
           }
           40% {
               transform: translateY(-2.5vh) translateX(70vw) scale(0.5);
           }
           50% {
               transform: translateY(0) translateX(90vw) scale(0.45);
           }
           51% {
               transform: translateY(0) translateX(110vw) scale(0.45);
           }
           100% {
               transform: translateY(0) translateX(110vw) scale(0.45);
           }
       }
   </style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection

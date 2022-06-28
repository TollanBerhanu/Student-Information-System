{{-- Extends layout --}}
@extends('layout.empty')

{{-- Content --}}
@section('content')

    {{-- About --}}
    <div class="global-container">
        <header>
            <div class="title">
                <h3>SSMS</h3>
            </div>
            <div class="content">
                <h5>About</h5>
                <p>This is a collection of words that are put here as placeholder for a description of the SSMS system.</p>
            </div>
        </header>
    </div>

@endsection

@section('styles')
    <style>

        .global-container{
            position: relative;
            top: 20%;
        }
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            width: 60%;
            height: 100vh;
            margin: 0 auto;
            font-family: poppins, serif;
        }

        body header {
            height: 100%;
            display: flex;
            align-items: center;
            column-gap: 50px;
        }

        body header .title, body header .content {
            flex: 1;
        }

        body header .title h3 {
            font-size: 46px;
        }

        body header .content h5 {
            font-size: 24px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .content {
            height: 50vh;
            margin-top: auto;
            margin-bottom: auto;
        }

        body header .content p {
            font-size: 18px;
        }

        body main {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            column-gap: 50px;
            row-gap: 70px;
            padding: 50px 0;
        }

        @media screen and (max-width: 1440px) {
            body {
                width: 70%;
            }

            body main {
                column-gap: 50px;
            }
        }

        @media screen and (max-width: 1024px) {
            body {
                width: 80%;
            }

            body main {
                column-gap: 35px;
            }
        }

        @media screen and (max-width: 768px) {
            body {
                width: 90%;
            }

            body main {
                column-gap: 25px;
            }
        }

        @media screen and (max-width: 600px) {
            body {
                width: 90%;
                height: auto;
                margin: 50px auto 10px;
            }

            body header {
                height: auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                row-gap: 20px;
            }

            body header .title {
                align-self: flex-start;
            }

            body header .title h3 {
                font-size: 30px;
            }

            body main {
                grid-template-columns: repeat(2, 1fr);
                column-gap: 0px;
                row-gap: 0px;
            }

            body main .profile:nth-child(2), body main .profile:nth-child(4), body main .profile:nth-child(6) {
                margin-top: 50px;
            }

            body main .profile:nth-child(3), body main .profile:nth-child(5) {
                margin-top: 0px;
            }
        }
    </style>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection

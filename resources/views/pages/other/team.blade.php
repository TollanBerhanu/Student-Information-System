{{-- Extends layout --}}
@extends('layout.empty')

{{-- Content --}}
@section('content')

    {{-- About --}}
    <div class="global-container">
        <header>
            <div class="title">
                <h3>The creative crew</h3>
            </div>
            <div class="content">
                <h5>who we are</h5>
                <p>We are team of creatively diverse. driven. innovative individuals working on various projects from around
                    the world.</p>
            </div>
        </header>

        <main>
            @foreach($data as $item)
                <div class="profile">
                    <figure data-value="{{$item['role']}}">
                        <img src="{{ asset($item['image']) }}" alt="">
                        <figcaption>{{$item["name"]}}</figcaption>
                    </figure>
                </div>
            @endforeach

        </main>
    </div>

@endsection

@section('styles')
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            width: 60%;
            height: 100vh;
            margin: 0px auto;
            font-family: poppins;
        }

        body header {
            height: 20%;
            display: flex;
            align-items: center;
            column-gap: 50px;
        }

        body header .title, body header .content {
            flex: 1;
        }

        body header .title h3 {
            font-size: 36px;
        }

        body header .content h5 {
            font-size: 16px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        body header .content p {
            text-align: justify;
            font-size: 14px;
        }

        body main {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            column-gap: 50px;
            row-gap: 70px;
            padding: 50px 0px;
        }

        body main .profile {
            display: flex;
            justify-content: center;
            position: relative;
        }

        body main .profile figure {
            width: 85%;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        body main .profile figure img {
            width: 80%;
        }

        body main .profile figure figcaption {
            font-size: 16px;
            font-weight: 500;
            margin-top: 12px;
            text-transform: capitalize;
            cursor: pointer;
        }

        body main .profile figure::after {
            content: attr(data-value);
            width: 100%;
            transform-origin: 0 0;
            transform: rotate(90deg);
            position: absolute;
            text-transform: uppercase;
            font-size: 12px;
            right: -92%;
        }

        body main .profile:nth-child(2) {
            margin-top: 70px;
        }

        body main .profile:nth-child(4) {
            margin-top: -70px;
        }

        body main .profile:nth-child(6) {
            margin-top: -70px;
        }

        body footer {
            height: 5%;
            color: #BDBDBD;
            display: grid;
            place-items: center;
            font-size: 12px;
        }

        body footer a {
            text-decoration: none;
            color: inherit;
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

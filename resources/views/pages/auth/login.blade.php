{{-- Extends layout --}}
@extends('layout.empty')

{{-- Content --}}
@section('content')

    {{-- Login --}}
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h3 class="card-title text-center">Log in</h3>
                <div class="card-text">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
{{--                    <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                        {{$email}}--}}
{{--                    </div>--}}
                    <form action="{{ route('loginValidate') }}" method="post">
                        @csrf
                        <!-- to error: add class "has-danger" -->
                        <div class="form-group">
                            <label for="email_field">Email address</label>
                            <input type="email" name="email" value="{{ old('email')}}" class="form-control form-control-sm" id="email_field"
                                   aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="password_field">Password</label>
                            <a href="#" style="float:right;font-size:12px;">Forgot password?</a>
                            <input type="password" name="password"  class="form-control form-control-sm" id="password_field">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        html, body {
            height: 100%;
        }

        .global-container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5f5;
        }

        form {
            padding-top: 10px;
            font-size: 14px;
            margin-top: 30px;
        }

        .card-title {
            font-weight: 300;
        }

        .btn {
            font-size: 14px;
            margin-top: 20px;
        }


        .login-form {
            width: 400px;
            margin: 20px;
        }

        .sign-up {
            text-align: center;
            padding: 20px 0 0;
        }

        .alert {
            margin-bottom: -30px;
            font-size: 13px;
            margin-top: 20px;
        }
        .alert ul{
            margin: 0;
        }
    </style>
@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
@endsection

{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" action="{{ route("pcRegistrationAcceptPage") }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                        <div class="image-input-wrapper" style="background-image: url('/media/team/awol.jpg')"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <h3 class="card-title">

                        Student:  {{$student['first_name']." ". $student['middle_name']." ". $student['last_name']}}
                    </h3>
                </div>
                <div class="form-group row">
                    <h3 class="card-title">
                        ID: {{$student['student_id']}}
                    </h3>
                </div>

                <input type="hidden" value="{{$student['id']}}" name="id">

                <table>
                    <tbody><tr>
                        <td>
                            <h3 class="card-title">
                                Serial No.
                            </h3>
                        </td>
                        <td>
                            <div class="col-25">
                                <input class="form-control  @error('serialNo')
                        is-invalid
                    @enderror"
                                " type="text" value="{{old('serialNo')}}" name="serialNo">
                            </div>

                        @error('serialNo')
                            <span class="text-danger" >
                            {{"Invalid serial number" }}
                                </span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3 class="card-title">
                                Trade Mark
                            </h3>
                        </td>

                        <td>
                            <div class="col-25">
                                <input class="form-control  @error('t_mark')
                        is-invalid
                    @enderror"
                                       type="text" value="{{old('t_mark')}}" name="t_mark">
                                @error('t_mark')
                                <span class="text-danger" >
        {{$message }}
    </span>
                                @enderror
                            </div>
                        </td>


                    </tr>

                    <tr>
                        <td>
                            <h3 class="card-title">
                                Color
                            </h3>
                        </td>
                        <td>
                            <div class="col-25">
                                <input class="form-control  @error('color')
                        is-invalid
                    @enderror"
                                " type="text" value="{{old('color')}}" name="color">
                                @error('color')
                                <span class="text-danger" >
        {{$message }}
    </span>
                                @enderror
                            </div>
                        </td>


                    </tr>
                    </tbody></table>


                <div class="card-footer">
                    <div class="row">
                        <div class="col-25">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                        </div>
                    </div>
                </div>
        </form>
            </div>


    </div>

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        @if(Session::has('notification'))//this line works as expected

        var type = "{{ Session::get('alert_type', 'info') }}";
        //but the type var gets assigned with default value(info)
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}", "{{ Session::get('notification') }}");
                break;
        }
        @endif
    </script>
@endsection

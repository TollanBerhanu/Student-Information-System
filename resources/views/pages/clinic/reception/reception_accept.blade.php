{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" action="{{ route("receptionAcceptHandle") }}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                        <div class="image-input-wrapper" style="background-image: url('/{{$student['profile']}}')"></div>
                    </div>
                </div>
                <div class="form-group row">
                    <h3 class="card-title">
                        Student: {{$student['first_name']." ".$student['last_name']}}
                    </h3>
                </div>
                <div class="form-group row">
                    <h3 class="card-title">
                        ID: {{$student['student_id']}}
                    </h3>
                </div>
                <div class="form-group row">
                    @if ($errors->any())
                        <div class="alert alert-danger col-10 mx-auto">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <input type="hidden" value="{{$student['id']}}" name="id">
                <div class="form-group">
                    <label>Room</label>
                    <select class="form-control form-control-solid" name="room_id">
                        <option value="-1">None</option>
                        @foreach($rooms as $room)
                            <option value="{{$room['id']}}" {{old('room_id') ? (old('room_id') == $room['id'] ? "selected" : "") : "" }}>{{$room['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-10">
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                    </div>
                </div>
            </div>
        </form>
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

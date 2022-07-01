{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Clinic Room Update Form
            </h3>
        </div>
        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" action="{{ route("roomUpdateHandle") }}">
            @csrf
            <div class="card-body">
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
                <input type="hidden" value="{{$room['id']}}" name="id">
                <div class="form-group row">
                    <label class="col-2 col-form-label">Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ old('name') ? old('name') : $room['name'] }}" name="name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control form-control-solid" rows="3" name="description">{{old('description') ? old('description') : $room['description']}}</textarea>
                </div>
                <div class="form-group">
                    <label>Clinic</label>
                    <select class="form-control form-control-solid" name="clinic_id">
                        <option value="-1">None</option>
                        @foreach($clinics as $clinic)
                            <option value="{{$clinic['id']}}" {{old('clinic_id') ? (old('clinic_id') == $clinic['id'] ? "selected" : "") : (($room['clinic_id'] == $clinic['id'] ? "selected" : "")) }}>{{$clinic['name']}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">Changing Room type will reset assignations</span>
                </div>

                <div class="form-group">
                    <label>Room Type</label>
                    <select class="form-control form-control-solid" name="room_type_id">
                        <option value="-1">None</option>
                        @foreach($room_types as $room_type)
                            <option value="{{$room_type['id']}}" {{old('room_type_id') ? (old('room_type_id') == $room_type['id'] ? "selected" : "") : (($room['room_type_id'] == $room_type['id'] ? "selected" : "")) }}>{{$room_type['name']}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">Changing Room type will reset assignations</span>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success mr-2">Save</button>
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

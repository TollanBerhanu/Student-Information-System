{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Privilege Registration Form
            </h3>
        </div>
        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" action="{{ route("privilegeRegisterHandle") }}">
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
                <div class="form-group row">
                    <label class="col-2 col-form-label">Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text" value="{{ old('name') }}" name="name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control form-control-solid" rows="3" name="description">{{old('description')}}</textarea>
                </div>
                <div class="form-group">
                    <label>System</label>
                    <select class="form-control form-control-solid" name="system_id">
                        <option value="-1">None</option>
                        @foreach($systems as $system)
                            <option value="{{$system['id']}}" {{old('system_id') ? (old('system_id') == $system['id'] ? "selected" : "") : "" }}>{{$system['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success mr-2">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
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

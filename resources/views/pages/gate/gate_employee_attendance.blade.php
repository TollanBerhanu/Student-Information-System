{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Employee Information Update Form
            </h3>
        </div>
        <!--begin::Form-->
        <form method="get" action="{{ url("/gate/employeeAttendance") }}">
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
                    <label for="example-password-input" class="col-2 col-form-label">Profile</label>
                    <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                        <div class="image-input-wrapper"
                             style="background-image: url('/{{ old('profile') ? old('profile') : $_user['profile']}}')"></div>

                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                               data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                            <i class="fa fa-pen icon-sm text-muted"></i>
                            <input type="file" name="profile" accept=".png, .jpg, .jpeg"/>
                            <input type="hidden" name="profile_avatar_remove"/>
                        </label>

                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow"
                              data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                      <i class="ki ki-bold-close icon-xs text-muted"></i>
                     </span>
                    </div>
                </div>
                <input type="hidden" value="{{$_user['id']}}" name="user_id">
                <div class="form-group row">
                    <label class="col-2 col-form-label">First Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text"
                               value="{{ old('first_name') ? old('first_name') : $_user['first_name']}}"
                               name="first_name"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-2 col-form-label">Last Name</label>
                    <div class="col-10">
                        <input class="form-control" type="text"
                               value="{{ old('last_name')  ? old('last_name') : $_user['last_name'] }}"
                               name="last_name"/>
                    </div>
                </div>
                <div class="form-group row">
                 <label  class="col-2 col-form-label">Select Shift</label>
                     <div class="col-10">
                            <select class="form-control" name="shift" aria-label="Default select example">
                                    <option value="-1">None</option>
                                    <option value="morinig">Morning</option>
                                     <option value="after_noon">After Noon</option>
                                     <option value="night">Night</option>
                             </select>
                     </div>
                </div>
                <div class="form-group row">
                 <label  class="col-2 col-form-label">Select Gate</label>
                     <div class="col-10">
                            <select class="form-control" name="gate_id">
                            <option value="-1">None</option>
                        @foreach($gates as $gate)
                               <option value="{{$gate->id}}">{{$gate->gate_name}}</option>
                        @endforeach
                             </select>
                     </div>
                </div>

               
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-10">
                            <button type="submit" class="btn btn-success mr-2">add</button>
                            
                            <a href="{{ url("gate/attendance") }}" class="btn btn-secondary">Cancel</a>
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
        var avatar3 = new KTImageInput('kt_image_3');

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
        switch (type) {
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

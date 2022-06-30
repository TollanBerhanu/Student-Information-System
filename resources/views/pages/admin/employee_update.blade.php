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
        <form method="POST" enctype="multipart/form-data" action="{{ route("employeeUpdateHandle") }}">
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
                <input type="hidden" value="{{$_user['id']}}" name="id">
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
                    <label class="col-3 col-form-label">Sex</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio"
                                       {{ old('sex') ? (old('sex') == "Male" ? 'checked': '' ) : ($_user['sex'] == "Male" ? 'checked' : "")}} value="Male"
                                       name="sex"/>
                                <span></span>
                                Male
                            </label>
                            <label class="radio">
                                <input type="radio"
                                       {{ old('sex') ? (old('sex') == "Female" ? 'checked': '') : ($_user['sex'] == "Female" ? 'checked' : "")}} value="Female"
                                       name="sex"/>
                                <span></span>
                                Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-email-input" class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input class="form-control" type="email"
                               value="{{ old('email')  ? old('email') : $_user['email'] }}" name="email"/>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-tel-input" class="col-2 col-form-label">Phone Number</label>
                    <div class="col-10">
                        <input class="form-control" type="tel"
                               value="{{ old('phone_number')  ? old('phone_number') : $_user['phone_number'] }}"
                               name="phone_number"/>
                    </div>
                </div>
                {{--                <div class="form-group row">--}}
                {{--                    <label for="example-password-input" class="col-2 col-form-label">Password</label>--}}
                {{--                    <div class="col-10">--}}
                {{--                        <input class="form-control" value="--unchanged--" name="password"/>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="form-group">
                    <label>College</label>
                    <select class="form-control form-control-solid" name="college_id">
                        <option value="-1">None</option>
                        @foreach($colleges as $college)
                            <option
                                value="{{$college['id']}}" {{ old('college_id') ? (old('college_id') == $college['id'] ? "selected" : "") : ($_user['college'] ? ($_user['college']['id'] == $college['id'] ? "selected" : "") : "")}}>{{$college['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select class="form-control form-control-solid" name="role_id">
                        <option value="-1">None</option>
                        @foreach($systems as $system)
                            <optgroup label="{{$system['name']}}">
                                @foreach($system['role'] as $role)
                                    <option
                                        value="{{$role['id']}}" {{ old('role_id') ? (old('role_id') == $role['id'] ? "selected" : "") : ($_user['role'] ? ($_user['role']['id'] == $role['id'] ? "selected" : "") : "")}}>{{$role['name']}}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Status</label>
                    <div class="col-3">
                   <span class="switch switch-success">
                    <label>
                     <input type="hidden" value="0" name="status"/>
                     <input type="checkbox" value="1" name="status" {{$_user['status'] ? "checked" : ""}}/>
                     <span></span>
                    </label>
                   </span>
                    </div>
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
                <div class="card-footer">
                    <div class="row">
                        <div class="col-2">
                        </div>
                        <div class="col-10">
                            <button type="submit" class="btn btn-success mr-2">Save</button>
                            <a href="{{ route("employeeList") }}" class="btn btn-secondary">Cancel</a>
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

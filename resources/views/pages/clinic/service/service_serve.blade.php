{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                {{$room['name']}}
            </h3>
        </div>
        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" action="{{ route("serviceCompleteHandle") }}">
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
                <div class="separator separator-solid separator-border-2 mb-5"></div>
                <div class="form-group row">
                    <h3 class="card-title">
                        Diagnosis
                    </h3>
                </div>
                <input type="hidden" name="id" value="{{$service_request['id']}}"/>
                <input type="hidden" name="service_item_count"
                       value="{{count($service_request['service_request_items'])}}"/>
                <input type="hidden" name="service_item_data"
                       value="{{ old('service_item_data') ? old('service_item_data') : '{}'}}"
                       id="service_item_data_array"/>
                <div class="form-group row">
                    <label>Response</label>
                    <textarea class="form-control form-control-solid" rows="3"
                              name="description">{{old('response')}}</textarea>
                </div>
                @if(count($service_request['service_request_items']) == 0)
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">
                                    Service Request Items
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @foreach($service_request['service_request_items'] as $item)
                                <div class="form-group row">
                                    <label>{{$item['name']}}</label>
                                    <div class="form-group row">
                                        <label>Description</label>
                                        <textarea onkeyup="data_input({{$item['id']}})" class="form-control form-control-solid" rows="3"
                                                  id="{{'s_r_description_'.$item['id']}}"></textarea>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-3 col-form-label">Status</label>
                                        <div class="col-3">
                                       <span class="switch switch-sm">
                                        <label>
                                         <input type="checkbox" onchange="data_input({{$item['id']}})" id="{{'s_r_status_'.$item['id']}}" name="status"/>
                                         <span></span>
                                        </label>
                                       </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator separator-solid separator-border-2 mb-2"></div>
                            @endforeach
                        </div>
                    </div>
                @endif
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

        function data_input(cb) {
            let data = document.getElementById('service_item_data_array').value;
            data = JSON.parse(data);
            if (cb.checked) {
                if (data.indexOf(cb.value) === -1) {
                    data.push(cb.value);
                }
            } else {
                let temp = [];
                for (let item of data) {
                    if (item !== cb.value) {
                        temp.push(item);
                    }
                }
                data = temp;
            }
            // console.log(data);
            document.getElementById('service_item_data_array').value = JSON.stringify(data);
        }

        window.addEventListener('load', function () {
            let data = document.getElementById('service_item_data_array').value;
            data = JSON.parse(data);
            let temp = [];
            for (let item of data) {
                temp.push(item + '');
                try {
                    // console.log(item);
                    document.getElementById('symptom_' + item + '_id').checked = true;
                    // console.log(item + " Done");
                } catch (ignored) {
                }
            }
            document.getElementById('service_item_data_array').value = JSON.stringify(temp);
        });

        // Class definition
        var KTFormRepeater = function () {

            // Private functions
            var demo1 = function () {
                $('#kt_repeater_1').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function () {
                        $(this).slideDown();
                    },

                    hide: function (deleteElement) {
                        $(this).slideUp(deleteElement);
                    }
                });
            }

            return {
                // public functions
                init: function () {
                    demo1();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTFormRepeater.init();
        });

    </script>
@endsection


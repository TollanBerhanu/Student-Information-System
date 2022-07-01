{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-header">
            <h3 class="card-title">
                Diagnosis
            </h3>
        </div>
        <div class="card card-custom gutter-b">
            <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-bold nav-tabs-line">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1_4">
                                <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                <span class="nav-text">New Diagnosis</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2_4">
                                <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                <span class="nav-text">Forward to Room</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                                <span class="nav-icon"><i class="flaticon2-drop"></i></span>
                                <span class="nav-text">Previous Diagnosis</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <!-- Complete Diagnosis -->
                    <div class="tab-pane fade show active" id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">
                        <form method="POST" enctype="multipart/form-data" action="{{ route("diagnosisCompleteHandle") }}">
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
                                    <h3 class="card-title">
                                        Pending: {{$diagnosis['pending_request'] ? "True" : "False"}}
                                    </h3>
                                </div>
                                <div class="separator separator-solid separator-border-2 mb-5"></div>
                                <div class="form-group row">
                                    <h3 class="card-title">
                                        Diagnosis
                                    </h3>
                                </div>
                                <input type="hidden" name="id" value="{{$diagnosis['id']}}"/>
                                <input type="hidden" name="symptom_list"
                                       value="{{ old('symptom_list') ? old('symptom_list') : '[]'}}"
                                       id="symptom_data_array"/>
                                <input type="hidden" name="disease_list"
                                       value="{{ old('disease_list') ? old('disease_list') : '[]'}}"
                                       id="disease_data_array"/>
                                <div class="form-group row">
                                    <label>Description</label>
                                    <textarea class="form-control form-control-solid" rows="3"
                                              name="description">{{old('description')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="accordion accordion-light accordion-toggle-arrow" id="symptoms_accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingOne2">
                                                <div class="card-title" data-toggle="collapse"
                                                     data-target="#collapseOne2">
                                                    Symptoms
                                                </div>
                                            </div>
                                            <div id="collapseOne2" class="collapse show"
                                                 data-parent="#symptoms_accordion">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="checkbox-list">
                                                            <label>Symptom List</label>
                                                            @foreach ($symptoms as $symptom)
                                                                <label class="checkbox">
                                                                    <input type="checkbox"
                                                                           onchange="symptom_selection(this)"
                                                                           id="{{'symptom_'.$symptom['id']."_id"}}"
                                                                           value="{{$symptom['id']}}"/>
                                                                    <span></span>
                                                                    {{$symptom['name']}}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label>Diagnosis</label>
                                    <textarea class="form-control form-control-solid" rows="3"
                                              name="diagnosis">{{old('diagnosis')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <div class="accordion accordion-light accordion-toggle-arrow" id="diseases_accordion">
                                        <div class="card">
                                            <div class="card-header" id="headingTwo2">
                                                <div class="card-title collapsed" data-toggle="collapse"
                                                     data-target="#collapseTwo2">
                                                    Diseases
                                                </div>
                                            </div>
                                            <div id="collapseTwo2" class="collapse" data-parent="#diseases_accordion">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="checkbox-list">
                                                            <label>Disease List</label>
                                                            @foreach ($diseases as $disease)
                                                                <label class="checkbox">
                                                                    <input type="checkbox"
                                                                           onchange="disease_selection(this)"
                                                                           id="{{'disease_'.$disease['id']."_id"}}"
                                                                           value="{{$disease['id']}}"/>
                                                                    <span></span>
                                                                    {{$disease['name']}}
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-10">
                                        <button type="submit" class="btn btn-success mr-2">Complete</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Forward to room -->
                    <div class="tab-pane fade" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">
                        <form method="POST" enctype="multipart/form-data" action="{{ route("diagnosisForwardHandle") }}">
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
                                    <h3 class="card-title">
                                        Forward to Service Room
                                    </h3>
                                </div>
                                <div class="form-group row">
                                    <label>Description</label>
                                    <textarea class="form-control form-control-solid" rows="3"
                                              name="description">{{old('description')}}</textarea>
                                </div>
                                <div class="form-group">
                                    <div id="kt_repeater_1">
                                        <div class="form-group row" id="kt_repeater_1">
                                            <label class="col-lg-2 col-form-label text-right">Service Request Item:</label>
                                            <div data-repeater-list="" class="col-lg-10">
                                                <div data-repeater-item class="form-group row align-items-center">
                                                    <div class="col-md-3">
                                                        <input type="text" name="service_item[0]" class="form-control" placeholder="Service Item Name"/>
                                                        <div class="d-md-none mb-2"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <div data-repeater-item class="form-group row align-items-center">
                                                    <div class="col-md-3">
                                                        <input type="text" name="service_item[1]" class="form-control" placeholder="Service Item Name"/>
                                                        <div class="d-md-none mb-2"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                                <div data-repeater-item class="form-group row align-items-center">
                                                    <div class="col-md-3">
                                                        <input type="text" name="service_item[2]" class="form-control" placeholder="Service Item Name"/>
                                                        <div class="d-md-none mb-2"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-sm font-weight-bolder btn-light-danger">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label text-right"></label>
                                            <div class="col-lg-4">
                                                <a href="javascript:;" data-repeater-create="" class="btn btn-sm font-weight-bolder btn-light-primary">
                                                    Add
                                                </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="separator separator-solid separator-border-2 mb-5"></div>
                                <input type="hidden" name="id" value="{{$diagnosis['id']}}"/>
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
                                        <button type="submit" class="btn btn-success mr-2">Forward</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Previous Diagnosis -->
                    <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">
                        @foreach($previous_diagnosis as $prev_diag)
                            <div class="card card-custom gutter-b">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h3 class="card-label">
                                            Diagnosis: {{$prev_diag['created_at']->format('M d, Y  H:i')}}
                                            <small>{{$prev_diag['discarded'] ? "Discarded" : "Accepted"}}</small>
                                        </h3>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Description -->
                                    <div class="card card-custom gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Description
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{$prev_diag['description']}}
                                        </div>
                                    </div>

                                    <!-- Symptoms -->
                                    <div class="card card-custom gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Symptoms
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body pt-1">
                                                @if(count($prev_diag['symptoms']) == 0)
                                                    --
                                                @endif
                                                @foreach($prev_diag['symptoms'] as $diag_symptom)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="d-flex flex-column font-weight-bold">
                                                            <div
                                                                class="text-dark text-hover-primary mb-1 font-size-lg">{{$diag_symptom['symptom']['name']}}</div>
                                                            <span
                                                                class="text-muted">{{$diag_symptom['symptom']['description']}}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Services -->
                                    <div class="card card-custom gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Services
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body pt-1">
                                                @if(count($prev_diag['services']) == 0)
                                                    --
                                                @endif
                                                @foreach($prev_diag['services'] as $diag_service)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="d-flex flex-column font-weight-bold">
                                                            <div class="text-dark text-hover-primary mb-1 font-size-lg">Description</div>
                                                            <span class="text-muted">{{$diag_service['description']}}</span>
                                                            <div class="text-dark text-hover-primary mb-1 font-size-lg">Response</div>
                                                            <span class="text-muted">{{$diag_service['response']}}</span>
                                                        </div>
                                                        <div class="d-flex flex-column font-weight-bold">
                                                            <div class="text-dark text-hover-primary mb-1 font-size-lg">{{$diag_service['description']}}</div>
                                                        </div>
                                                        @foreach($diag_service['service_request_items'] as $service_items)
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="d-flex flex-column font-weight-bold">
                                                                    <div class="text-dark text-hover-primary mb-1 font-size-lg">{{$service_items['name']}}</div>
                                                                    <span class="text-muted">{{$service_items['description']}}</span>
                                                                    <span class="text-muted">Status: {{$service_items['status'] ? "True" : "False"}}</span>
                                                                    <span class="text-muted">File: {{$service_items['fileable'] ? "True" : "False"}}</span>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Diagnosis -->
                                    <div class="card card-custom gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Diagnosis
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{$prev_diag['diagnosis']}}
                                        </div>
                                    </div>

                                    <!-- Disease -->
                                    <div class="card card-custom gutter-b">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h3 class="card-label">
                                                    Diseases
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body pt-1">
                                                @if(count($prev_diag['diseases']) == 0)
                                                    --
                                                @endif
                                                @foreach($prev_diag['diseases'] as $diag_disease)
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="d-flex flex-column font-weight-bold">
                                                            <div
                                                                class="text-dark text-hover-primary mb-1 font-size-lg">{{$diag_disease['disease']['name']}}</div>
                                                            <span class="text-muted">{{$diag_disease['disease']['description']}}</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!--begin::Form-->


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

        function disease_selection(cb) {
            let data = document.getElementById('disease_data_array').value;
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
            document.getElementById('disease_data_array').value = JSON.stringify(data);
        }

        function symptom_selection(cb) {
            let data = document.getElementById('symptom_data_array').value;
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
            document.getElementById('symptom_data_array').value = JSON.stringify(data);
        }

        window.addEventListener('load', function () {
            let data = document.getElementById('symptom_data_array').value;
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
            document.getElementById('symptom_data_array').value = JSON.stringify(temp);

            data = document.getElementById('disease_data_array').value;
            data = JSON.parse(data);
            temp = [];
            for (let item of data) {
                temp.push(item + '');
                try {
                    // console.log(item);
                    document.getElementById('disease_' + item + '_id').checked = true;
                    // console.log(item + " Done");
                } catch (ignored) {
                }
            }
            document.getElementById('disease_data_array').value = JSON.stringify(temp);
        });

        // Class definition
        var KTFormRepeater = function() {

            // Private functions
            var demo1 = function() {
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
                init: function() {
                    demo1();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTFormRepeater.init();
        });

    </script>
@endsection


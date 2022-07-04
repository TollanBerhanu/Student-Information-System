{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
{{--            <div class="mb-7">--}}
{{--                <div class="row align-items-center">--}}
{{--                    <div class="col-lg-6 col-xl-8">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-md-6 my-2 my-md-0">--}}

{{--                                <div class="input-icon">--}}
{{--                                    <input--}}
{{--                                        type="text"--}}
{{--                                        class="form-control"--}}
{{--                                        placeholder="Search..."--}}
{{--                                        onkeyup="input_changed(this)"--}}
{{--                                        id="kt_datatable_search_query"--}}
{{--                                    />--}}
{{--                                    <span>--}}
{{--                                            <i--}}
{{--                                                class="flaticon2-search-1 text-muted"--}}
{{--                                            ></i>--}}
{{--                                        </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">--}}
{{--                        <a--}}
{{--                            href="?query="--}}
{{--                            id="kt_datatable_search_query_link"--}}
{{--                            class="btn btn-light-primary px-6 font-weight-bold"--}}
{{--                        >Search</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table
                class="datatable datatable-bordered datatable-head-custom"
                id="kt_datatable"
            >
                <thead>
                <tr>
                    <th>Profile</th>
                    <th>Full Name</th>
                    <th>Request Description</th>
                    <th>Service Request Items</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($service_requests as $service_request)
                    <tr>
                        <td>
                            <img class="rounded-circle w-50px h-50px" alt="5x5"
                                 src="/{{$service_request['diagnosis']['student']['profile']}}"
                                 data-holder-rendered="true"></td>
                        <td>{{ $service_request['diagnosis']['student']['first_name']. " " .$service_request['diagnosis']['student']['last_name'] }}</td>
                        <td>{{ $service_request['description'] }}</td>
                        <td>{{ count($service_request['service_request_items']) }}</td>
                        <td>{{ $service_request['created_at']->format('M d, Y  H:i') }}</td>
                        <td>{{ $service_request['id']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script>
        // Class definition
        let KTDatatableHtmlTableDemo = (function () {
            // Private functions
            // demo initializer
            let demo = function demo() {
                let datatable = $("#kt_datatable").KTDatatable({
                    data: {
                        saveState: false,
                    },
                    search: {
                        input: $("#kt_datatable_search_query"),
                        key: "generalSearch",
                    },
                    columns: [
                        {
                            field: "Profile",
                            type: "string",
                            width: 75,
                            textAlign: 'center',
                            sortable: false
                        }, {
                            field: "Full Name",
                            type: "string",
                            width: 100
                        },
                        {
                            field: "Request Description",
                            type: "string",
                            width: 200
                        },
                        {
                            field: "Service Request Items",
                            type: "string",
                            width: 150,
                        },
                        {
                            field: "Date",
                            type: "string",
                            width: 150
                        },
                        {
                            field: "Action",
                            title: "Action",
                            autoHide: false,
                            // callback function support for column rendering
                            template: function template(row) {
                                return (
                                    `<a href="/clinic/service/serve/${row['Action']}" class="btn btn-primary btn-clean  mr-2" title="Select Student">
	                                     View
                                    </a>`
                                );
                            },
                        },
                    ],
                });
                $("#kt_datatable_search_status").on("change", function () {
                    datatable.search($(this).val().toLowerCase(), "Status");
                });
                $("#kt_datatable_search_type").on("change", function () {
                    datatable.search($(this).val().toLowerCase(), "Type");
                });
                $(
                    "#kt_datatable_search_status, #kt_datatable_search_type"
                ).selectpicker();
            };

            return {
                // Public functions
                init: function init() {
                    // init demo
                    demo();
                },
            };
        })();

        jQuery(document).ready(function () {
            KTDatatableHtmlTableDemo.init();
        });

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

        function input_changed(input){
            let search = document.getElementById('kt_datatable_search_query_link');
            let link = search.href;
            link = link.split('=')[0];
            link += '=' + input.value;
            search.href = link;
        }
    </script>
@endsection


{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    <div class="card card-custom">
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-6 my-2 my-md-0">
                                <div class="input-icon">
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Search..."
                                        id="kt_datatable_search_query"
                                    />
                                    <span>
                                            <i
                                                class="flaticon2-search-1 text-muted"
                                            ></i>
                                        </span>
                                </div>
                            </div>
                            <div class="col-md-6 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label
                                        class="mr-3 mb-0 d-none d-md-block"
                                    >Status:</label
                                    >
                                    <select
                                        class="form-control"
                                        id="kt_datatable_search_status"
                                    >
                                        <option value="">All</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        <a
                            href="#"
                            class="btn btn-light-primary px-6 font-weight-bold"
                        >Search</a
                        >
                    </div>
                </div>
            </div>
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
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Sex</th>
                    <th>Phone Number</th>
                    <th>College</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>
                            <img class="rounded-circle w-50px h-50px" alt="5x5"
                                 src="/{{$employee['profile']}}"
                                 data-holder-rendered="true"></td>
                        <td>{{ $employee['first_name'] }}</td>
                        <td>{{ $employee['last_name'] }}</td>
                        <td>{{ $employee['sex'] }}</td>
                        <td>{{ $employee['phone_number'] }}</td>
                        <td>{{ $employee['college'] ? $employee['college']['name'] : "Unassigned" }}</td>
                        <td>{{ $employee['role'] ? $employee['role']['name'] : "Unassigned" }}</td>
                        <td>{{ $employee['status'] ? 1 : 2 }}</td>
                        <td>{{ $employee['id']}}</td>
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
                        saveState: {
                            cookie: false,
                        },
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
                            field: "First Name",
                            type: "string",
                            width: 100
                        },
                        {
                            field: "Last Name",
                            type: "string",
                            width: 100
                        },
                        {
                            field: "Sex",
                            type: "string",
                            width: 50,
                        },
                        {
                            field: "Phone Number",
                            type: "string",
                            width: 150
                        },
                        {
                            field: "College",
                            type: "string",
                        },
                        {
                            field: "Role",
                            type: "string",
                            width: 90
                        },
                        {
                            field: "Status",
                            title: "Status",
                            autoHide: false,
                            // callback function support for column rendering
                            template: function template(row) {
                                let status = {
                                    1: {
                                        title: "Active",
                                        class: " label-light-success",
                                    },
                                    2: {
                                        title: "Inactive",
                                        class: " label-light-danger",
                                    }
                                };
                                return (
                                    '<span class="label font-weight-bold label-lg' +
                                    status[row.Status]["class"] +
                                    ' label-inline">' +
                                    status[row.Status].title +
                                    "</span>"
                                );
                            },
                        },
                        {
                            field: "Action",
                            title: "Action",
                            autoHide: false,
                            // callback function support for column rendering
                            template: function template(row) {
                                return (
                                    `<a href="/admin/employee/update/${row['Action']}" class="btn btn-sm btn-clean btn-icon mr-2" title="Edit details">
	                                    <span class="svg-icon svg-icon-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                                        fill="#000000" fill-rule="nonzero"
                                                        transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2"
                                                          rx="1"/>
                                                </g>
                                            </svg>
	                                     </span>
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
    </script>
@endsection


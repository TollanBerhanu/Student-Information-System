 {{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

    {{-- Permanent ID --}}
    
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">HTML Table
                <span class="d-block text-muted pt-2 font-size-sm">Datatable initialized from HTML table</span></h3>
            </div>
            <div class="card-toolbar">
                {{--<!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-print"></i>
                                    </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown--> --}}
                <form method="POST" enctype="multipart/form-data" action="{{ route("ID_PermanentGenerate") }}">
                    @csrf
                    <input type="text" style="display:none" name="selectedIDs" id="sel">
                    <!--begin::Button-->
                    <button type="submit" onclick="getSelected()" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Generate IDs</button>
                    <!--end::Button-->
                </form>
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                    <select class="form-control" id="kt_datatable_search_status">
                                        <option value="">All</option>
                                        <option value="4">Active</option>
                                        <option value="2">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-4 my-2 my-md-0">
                                <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Type:</label>
                                    <select class="form-control" id="kt_datatable_search_type">
                                        <option value="">All</option>
                                        <option value="1">Online</option>
                                        <option value="2">Retail</option>
                                        <option value="3">Direct</option>
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>
                    </div> --}}
                </div>
            </div>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
                <thead>
                    <tr>
                        {{-- <th title="No.">No.</th> --}}
                        <th title="Full Name">Full Name</th>
                        <th title="ID">ID No.</th>
                        <th title="Sex">Sex</th>
                        <th title="College">College</th>
                        <th title="Faculty">Faculty</th>
                        <th title="Department">Department</th>
                        <th title="Program">Program</th>
                        <th title="Join Year">Join Year</th>
                        <th title="Status">Status</th>
                        <th title="select">Select</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- <form method="POST" enctype="multipart/form-data" action="{{ route("ID_PermanentGenerate") }}">
                    @csrf --}}
                    @foreach ($students as $stud)
                    <tr>
                        {{-- <td>{{ $loop->index }}</td> --}}
                        <td>{{ $stud->first_name }} {{ $stud->middle_name }} {{ $stud->last_name }}</td>
                        <td>{{ $stud->student_id }}</td>
                        <td>{{ $stud->sex }}</td>
                        <td>{{ $stud->program->department->faculty->college->name }}</td>
                        <td>{{ $stud->program->department->faculty->name }}</td>
                        <td>{{ $stud->program->department->name }}</td>
                        <td>{{ $stud->program->name }}</td>
                        <td>{{ $stud->join_year }}</td>
                        <td>@if ($stud->status == 1)
                            4
                        @else
                            2
                        @endif</td>
                        <td><input type="checkbox" name="selected" onchange="selectListener({{ $stud->id }})"></td>
                    </tr>
                    @endforeach
                      {{--   <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">Generate</button>
                    </form> --}}
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
    <!--end::Card-->

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <!--end::Page Scripts-->

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

        function privilege_selection(cb){
            let data = document.getElementById('role_privilege_data_array').value;
            data = JSON.parse(data);
            if(cb.checked){
                if(data.indexOf(cb.value) === -1){
                    data.push(cb.value);
                }
            }
            else {
                let temp = [];
                for(let item of data){
                    if(item !== cb.value){
                        temp.push(item);
                    }
                }
                data = temp;
            }
            // console.log(data);
            document.getElementById('role_privilege_data_array').value = JSON.stringify(data);
        }

        window.addEventListener('load', function (){
            let data = document.getElementById('role_privilege_data_array').value;
            data = JSON.parse(data);
            let temp = [];
            for(let item of data){
                temp.push(item+'');
                try{
                    // console.log(item);
                    document.getElementById('role_' + item + '_privilege').checked = true;
                    // console.log(item + " Done");
                }
                catch (ignored){}
            }
            document.getElementById('role_privilege_data_array').value = JSON.stringify(temp);
        })

    </script>
@endsection























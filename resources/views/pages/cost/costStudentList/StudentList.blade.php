{{-- Extends layout --}}
 @extends('layout.default')

 {{-- Content --}}
 @section('content')
 
     {{-- Permanent ID --}}
     
     <!--begin::Card-->
     <div class="card card-custom">
         <div class="card-header flex-wrap border-0 pt-6 pb-0">
             <div class="card-title">
                 <h5>Search:
                 {{-- <span class="d-block text-muted pt-2 font-size-sm">Datatable initialized from HTML table</span></h3> --}}
             </div>
        <div class="card-body">
        </div>
        <div class="card-toolbar">
            <form method="POST" enctype="multipart/form-data" action="{{ route("generateReport") }}">
                @csrf
                <input type="text" style="display:none" name="selectedIDs" class="sel">
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
                </span>
               Generate Report
               </button>
                <!--end::Button-->
          </form>
        </div>
       </div>
                <!--begin: Search Form-->
            <form method="POST" enctype="multipart/form-data" action="{{ route("searchStudentwitDepartment") }}">
                @csrf
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon" style="margin-left: 15px">
                                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                        <select class="form-control" id="kt_datatable_search_status">
                                            <option value="">All</option>
                                            <option value="4">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Department:</label>
                                        <select class="form-control" name="department">
                                            <option value=""></option>
                                            @foreach ($department as $dept)
                                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-xl-4 mt-5 mt-lg-0" style="margin-left:-70px;">
                            <button type="submit" class="btn btn-light-primary px-6 font-weight-bold">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </form>
                <!--end::Search Form-->
        
        </div>
        <!--end::Card-->

    <!--begin: Datatable-->
    <table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
        <thead>
            <tr>
                {{-- <th title="No.">No.</th> --}}
                <th title="Full Name">Full Name</th>
                <th title="ID">ID No.</th>
                <th title="Sex">Sex</th>
                <th title="Department">Department</th>
                <th title="Program">Program</th>
                <th title="Join Year">Join Year</th>
                <th title="select">Select</th>
            </tr>
        </thead>
        <tbody>
            {{-- <form method="POST" enctype="multipart/form-data" action="{{ route("generateReport") }}">
            @csrf --}}
            @foreach ($students as $stud)
            <tr>
           {{-- <td>{{ $loop->index }}</td> --}}
                <td>{{ $stud->first_name }} {{ $stud->middle_name }} {{ $stud->last_name }}</td>
                <td>{{ $stud->student_id }}</td>
                <td>{{ $stud->sex }}</td>
                <td>{{ $stud->program->department->name }}</td>
                <td>{{ $stud->program->name }}</td>
                <td>{{ $stud->join_year }}</td> 
                <td><input type="checkbox" name="selected" onchange="selectListener({{ $stud->id }})"></td> 
            </tr>

            @endforeach
           

            </form> 
        </tbody>
    </table>
@endsection
{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
    
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
    <!--end::Page Scripts-->

    <script>
             var selected = [];
        function selectListener(id){
        const index = selected.indexOf(id);
        if (index > -1) { 
            selected.splice(index, 1); // 2nd parameter means remove one item only
        }
        else{
            selected.push(id);
        }
        }
        function getSelected(){
        document.getElementsByClassName('sel').forEach(sel => {
            sel.value = selected;
        })
        }
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
                    document.getElementById('role_' + item + '_privilege').checked = true;
                }
                catch (ignored){}
            }
            document.getElementById('role_privilege_data_array').value = JSON.stringify(temp);
        })

    </script>
@endsection


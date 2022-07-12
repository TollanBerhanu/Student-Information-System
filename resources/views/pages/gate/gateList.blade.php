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
                                        onkeyup="input_changed(this)"
                                        id="kt_datatable_search_query"
                                    />
                                    <span>
                                            <i
                                                class="flaticon2-search-1 text-muted"
                                            ></i>
                                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                        <a
                            href="?query="
                            id="kt_datatable_search_query_link"
                            class="btn btn-light-primary px-6 font-weight-bold"
                        >Search</a>
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
                   
                    <th>Gate Name</th>
                    <th>College</th>
                    <th>College Code</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($gateList as $gate)
                    <tr>
                       t->gate['gate_name']}}</td>
                        <td>{{ $gate['college']['name']}}</td>
                        <td>{{ $gate['college']['code'] }}</td>
                        
                       
                    </tr>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>

@endsection

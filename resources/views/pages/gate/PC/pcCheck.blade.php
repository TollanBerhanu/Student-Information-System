{{-- Extends layout --}}
{{--@extends('layout.default')--}}

{{-- Content --}}
{{--@section('content')--}}

{{--@if (Session::get('success'))--}}
{{--    <div class="alert alert-success">--}}
{{--        {{ Session::get('success') }}--}}
{{--    </div>--}}
{{--@endif--}}


{{--<center>--}}
{{--    <form method="GET" action="{{ route('checkPc') }}">--}}
{{--        @csrf--}}

{{--        <input type="text" name="stud_id" value="">--}}
{{--        <button type="submit" class="btn btn-primary mt-3">Search</button>--}}
{{--        @error('stud_id')--}}
{{--        <br><span class="text-danger">--}}
{{--                {{ "Invalid ID number" }}--}}
{{--            </span>--}}
{{--        @enderror--}}

{{--    </form>--}}
{{--</center>--}}



{{--    <div style="width: 90%;height:90%; position: absolute;margin-top: 5px; border: 3px solid black;">--}}
{{--        <div style="width: 45%; height:90%;float: left;border-right: 3px solid black;margin-top: 10px; padding: 10px;">--}}


{{--                <table style="row-gap:5px ;">--}}
{{--                    <tr>--}}
{{--                        <td>Name :</td>--}}
{{--                        <td>{{$Pcinfo->student->first_name}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Id :</td>--}}
{{--                        <td>{{$Pcinfo->student->student_id}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>company :</td>--}}
{{--                        <td>{{$Pcinfo['t_mark']}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Color :</td>--}}
{{--                        <td>{{$Pcinfo['color']}}</td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Serial No :</td>--}}
{{--                        <td>{{$Pcinfo['serialNo']}}</td>--}}
{{--                    </tr>--}}
{{--                </table>--}}



{{--                <table style="row-gap:5px ;">--}}
{{--                    <tr>--}}
{{--                        <td>Name :</td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Id :</td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Trade Mark :</td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Color :</td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                    <tr>--}}
{{--                        <td>Serial No :</td>--}}
{{--                        <td></td>--}}
{{--                    </tr>--}}
{{--                </table>--}}





{{--        </div>--}}
{{--        <div style="float: right;height:300px;max-width: 45%;margin-top: 10px;">--}}
{{--            @error('stud_id')--}}
{{--            <center><img src="{{ asset('images/incorrect.png') }}" width=50% style="margin: auto;"></center>--}}
{{--            @enderror--}}

{{--            @if(! $errors->has('stud_id'))--}}
{{--                <center><img src="{{ asset('images/login_2.jpg') }}" width=50% style="margin: auto;"></center>--}}
{{--                <center><img src="{{ asset('images/correct.png') }}" width=50% style="margin: auto;"></center>--}}

{{--            @endif--}}
{{--        </div>--}}


{{--    </div>--}}


{{--@else--}}
{{--    <center>--}}
{{--        <p style="color: red">Error input</p>--}}
{{--    </center>--}}
{{--@endif--}}



{{--@endsection--}}

{{-- Styles Section --}}
{{--@section('styles')--}}

{{--@endsection--}}

{{-- Scripts Section --}}
{{--@section('scripts')--}}
{{--    <script>--}}
{{--        // Class definition--}}
{{--        let KTDatatableHtmlTableDemo = (function () {--}}
{{--            // Private functions--}}
{{--            // demo initializer--}}
{{--            let demo = function demo() {--}}
{{--                let datatable = $("#kt_datatable").KTDatatable({--}}
{{--                    data: {--}}
{{--                        saveState: false,--}}
{{--                    },--}}
{{--                    search: {--}}
{{--                        input: $("#kt_datatable_search_query"),--}}
{{--                        key: "generalSearch",--}}
{{--                    },--}}
{{--                    columns: [--}}
{{--                        {--}}
{{--                            field: "Profile",--}}
{{--                            type: "string",--}}
{{--                            width: 75,--}}
{{--                            textAlign: 'center',--}}
{{--                            sortable: false--}}
{{--                        }, {--}}
{{--                            field: "First Name",--}}
{{--                            type: "string",--}}
{{--                            width: 100--}}
{{--                        },--}}
{{--                        {--}}
{{--                            field: "Last Name",--}}
{{--                            type: "string",--}}
{{--                            width: 100--}}
{{--                        },--}}
{{--                        {--}}
{{--                            field: "ID",--}}
{{--                            type: "string",--}}
{{--                            width: 100--}}
{{--                        },--}}
{{--                        {--}}
{{--                            field: "Sex",--}}
{{--                            type: "string",--}}
{{--                            width: 50,--}}
{{--                        },--}}
{{--                        ,--}}
{{--                        {--}}
{{--                            field: "Action",--}}
{{--                            title: "Action",--}}
{{--                            autoHide: false,--}}
{{--                            // callback function support for column rendering--}}
{{--                            template: function template(row) {--}}
{{--                                return (--}}
{{--                                    `<a href="/gate/admin/register_pc/${row['Action']}" class="btn btn-primary btn-clean  mr-2" title="Select Student">--}}
{{--	                                     Select--}}
{{--                                    </a>`--}}
{{--                                );--}}
{{--                            },--}}
{{--                        },--}}
{{--                    ],--}}
{{--                });--}}
{{--                $("#kt_datatable_search_status").on("change", function () {--}}
{{--                    datatable.search($(this).val().toLowerCase(), "Status");--}}
{{--                });--}}
{{--                $("#kt_datatable_search_type").on("change", function () {--}}
{{--                    datatable.search($(this).val().toLowerCase(), "Type");--}}
{{--                });--}}
{{--                $(--}}
{{--                    "#kt_datatable_search_status, #kt_datatable_search_type"--}}
{{--                ).selectpicker();--}}
{{--            };--}}

{{--            return {--}}
{{--                // Public functions--}}
{{--                init: function init() {--}}
{{--                    // init demo--}}
{{--                    demo();--}}
{{--                },--}}
{{--            };--}}
{{--        })();--}}

{{--        jQuery(document).ready(function () {--}}
{{--            KTDatatableHtmlTableDemo.init();--}}
{{--        });--}}

{{--        var avatar3 = new KTImageInput('kt_image_3');--}}

{{--        toastr.options = {--}}
{{--            "closeButton": true,--}}
{{--            "debug": false,--}}
{{--            "newestOnTop": false,--}}
{{--            "progressBar": true,--}}
{{--            "positionClass": "toast-top-right",--}}
{{--            "preventDuplicates": false,--}}
{{--            "onclick": null,--}}
{{--            "showDuration": "300",--}}
{{--            "hideDuration": "1000",--}}
{{--            "timeOut": "5000",--}}
{{--            "extendedTimeOut": "1000",--}}
{{--            "showEasing": "swing",--}}
{{--            "hideEasing": "linear",--}}
{{--            "showMethod": "fadeIn",--}}
{{--            "hideMethod": "fadeOut"--}}
{{--        };--}}
{{--        @if(Session::has('notification'))//this line works as expected--}}

{{--        var type = "{{ Session::get('alert_type', 'info') }}";--}}
{{--        //but the type var gets assigned with default value(info)--}}
{{--        switch(type){--}}
{{--            case 'info':--}}
{{--                toastr.info("{{ Session::get('message') }}", "{{ Session::get('notification') }}");--}}
{{--                break;--}}

{{--            case 'warning':--}}
{{--                toastr.warning("{{ Session::get('message') }}", "{{ Session::get('notification') }}");--}}
{{--                break;--}}

{{--            case 'success':--}}
{{--                toastr.success("{{ Session::get('message') }}", "{{ Session::get('notification') }}");--}}
{{--                break;--}}

{{--            case 'error':--}}
{{--                toastr.error("{{ Session::get('message') }}", "{{ Session::get('notification') }}");--}}
{{--                break;--}}
{{--        }--}}
{{--        @endif--}}

{{--        function input_changed(input){--}}
{{--            let search = document.getElementById('kt_datatable_search_query_link');--}}
{{--            let link = search.href;--}}
{{--            link = link.split('=')[0];--}}
{{--            link += '=' + input.value;--}}
{{--            search.href = link;--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}

@if(!@isset($studentInfo1) )

        @if(!@isset($Pcinfo))
            <div>Invalid ID and Serial number</div>
        @else

            <div>Student information with PC information</div>
            {{$studentInfo->id}}." ".{{$studentInfo->first_name}}." ".{{$studentInfo->last_name}}." ".{{$studentInfo->student_id}}<br>
            {{$Pcinfo->serilNo}}." ".{{$Pcinfo->t_mark}}." ".{{$Pcinfo->color}}

        @endif
@else


    <div>Only Student information</div>
        {{$studentInfo1->id}}." ".{{$studentInfo1->first_name}}." ".{{$studentInfo1->last_name}}." ".{{$studentInfo1->student_id}}


@endif



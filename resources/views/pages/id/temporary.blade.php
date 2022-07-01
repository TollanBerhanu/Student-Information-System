 {{-- Extends layout --}}
 @extends('layout.default')

 {{-- Content --}}
 @section('content')
 
     {{-- Permanent ID --}}
     <form method="POST" style="text-align: right; margin-right: 50px;" enctype="multipart/form-data" action="{{ route("ID_TemporaryPrint") }}">
        @csrf
        <input type="text" style="display: none" name="selectedIDs" value="{{ $selectedIDsStr }}">
        <button type="submit" class="btn btn-primary font-weight-bolder">
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
            Generate PDF
        </button>
     </form>
        
     @include('pages.id.tempPdf')
 
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
 
 

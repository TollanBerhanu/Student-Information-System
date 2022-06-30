 {{-- Extends layout --}}
 @extends('layout.default')

 {{-- Content --}}
 @section('content')
 
     {{-- Permanent ID --}}
     
        @foreach($selectedStudents as $stud)
            {{ $stud[0]->first_name }} <br>
        @endforeach
 
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
 
 

{{-- Extends layout --}}
@extends('layout.empty')

{{-- Content --}}
@section('content')

<div class="content-header" style ="background-color:blue!important">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="card" >
              <div class="card-header" style="background-color:cyan!important">
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
  
        <form class="form-inline my-2 my-lg-0"style="margin-left: 20%!important" type="get" action="{{url('/gate/student/permitedStudent')}}">
          <input type="search" class="form-control mr-sm-2" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type=submit> <i class="fas fa-search fa-fw"></i></button>
          <a href="{{url('/')}}" style="margin-left:80%!important"><h1>Back</h1></a> 
        </form>
               
              </div>
    <div class="container-fluid">
        <!--begin::Form-->
    
            <div class="card-body">
            <div class="form-group">
         <div class="row">
         <a href="{{route('studentList.show',$studentInfo->id)}}">
               <img style="margin-left:50%!important" src="/{{$studentInfo['profile']}}"  width="400px" height="300px" alt=""></a> 
           <div class="clearfix"></div>
          </div>
         </div>
               
                <div class="form-group">
                <div class="form-group">  
        <div class="row">
            <h1 class="col-md-3" style="margin-left:15%!important">Id No: </h1>
            <div class="col-md-4"> <h1> {{$studentInfo->student_id}}</h> </div>
            <div class="clearfix"></div>
            </div>
            <div class="row">
            <h1 class="col-md-3" style="margin-left:15%!important">Serial Number: </h1>
            <div class="col-md-3"> <h1> {{$Pcinfo->serialNo}}</h> </div>
            <div class="clearfix"></div>
</div>
<div class="row">
            <h1 class="col-md-3" style="margin-left:15%!important">Trade Mark: </h1>
            <div class="col-md-3"> <h1> {{$Pcinfo->t_mark}}</h> </div>
            <div class="clearfix"></div>
</div>
                    
<div class="row">
            <h1 class="col-md-3" style="margin-left:15%!important">Color: </h1>
            <div class="col-md-3"> <h1> {{$Pcinfo->color}}</h> </div>
            <div class="clearfix"></div>
</div>
                        
                    
        
            </div>
</div>

    </div>

@endsection

{{-- Styles Section --}}
@section('styles')

@endsection

{{-- Scripts Section --}}
@section('scripts')
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

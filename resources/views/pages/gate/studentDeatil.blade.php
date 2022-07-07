{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')

<div class="row">
    <div class ="col-lg-12 margin-6"> 
                      <text input -->
                      
                      <div class="pull-right">
              <h1 style="margin-left:30%; color:blue!important"><u> Student's Detail</u></h1>
            </div>
            
<div class="form-group">
        <div class="row">
            <strong class="col-md-1" style="margin-left:15%!important">Id No: </strong>
            <div class="col-md-4"><input type="text" name="" class="form-control"  value="{{$student->student_id}}"> </div>
            <div class="clearfix"></div>
</div>
</div>    
       <div class="form-group">
         <div class="row">
           <strong class="col-md-1" style="margin-left:15%!important">Name:</strong>
          <div class="col-md-4"> <input type="text" name="" class="form-control"  value="{{$student->first_name}} {{$student->middle_name}} {{$student->last_Name}}" > 
            <div class="clearfix"></div>
          </div>
         </div>
       </div>
       <div class="form-group">
       <div class="row">
           <strong class="col-md-1" style="margin-left:15%!important">Sex:</strong>
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio"
                                       {{ old('sex') ? (old('sex') == "Male" ? 'checked': '' ) : ($student['sex'] == "Male" ? 'checked' : "")}} value="Male"
                                       name="sex"/>
                                <span></span>
                                Male
                            </label>
                            <label class="radio">
                                <input type="radio"
                                       {{ old('sex') ? (old('sex') == "Female" ? 'checked': '') : ($student['sex'] == "Female" ? 'checked' : "")}} value="Female"
                                       name="sex"/>
                                <span></span>
                                Female
                        </label>
                        </div>
                    </div>
                </div>
                </div>
</div>
       <div class="form-group">
         <div class="row">
           <strong class="col-md-1" style="margin-left:15%!important">Batch</strong>
          <div class="col-md-4"> <input type="text" name="" class="form-control"  value="{{$student->join_year}}"> 
            <div class="clearfix"></div>
          </div>
         </div>

       </div>
       <div class="form-group">
         <div class="row">
           <strong class="col-md-1" style="margin-left:15%!important">Program </strong>
           <div class="col-md-4"> <input type="text" name="" class="form-control"  value="{{$student->program->name}}"> 
           <div class="clearfix"></div>
          </div>
         </div>

       </div>
       <div class="form-group">
         <div class="row">
           <strong class="col-md-1" style="margin-left:15%!important">Department </strong>
           <div class="col-md-4"> <input type="text" name="" class="form-control"  value="{{$student->program->department->name}}"> 
           <div class="clearfix"></div>
          </div>
         </div>

       </div>
       <div class="form-group">
         <div class="row">
           <strong class="col-md-1" style="margin-left:15%!important">College </strong>
           <div class="col-md-4"> <input type="text" name="" class="form-control"  value="{{$student->program->department->faculty->college->name}}"> 
           <div class="clearfix"></div>
          </div>
         </div>

       </div>
       <div class="form-group">
         <div class="row">
           
           <img style="margin-left:15%!important"src="/{{$student['profile']}}"  width="400px" height="300px" alt="">
           
           <div class="clearfix"></div>
          </div>
         </div>

       </div>
      
<button type="submit" class="btn btn-info" style="margin-left:15%; font-weight:20px!important"> <a href={{url('/gate/student/student_pass')}} style="color:white!important">Back</a> </button>
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
    </script>
@endsection

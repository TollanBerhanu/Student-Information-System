

 {{-- Extends layout --}}
 @extends('layout.empty')

 

 <html>
   <body>
 @foreach($selectedStudents as $stud)
 <div class="card card-custom">
  <div style="align:left">
                    <label for="example-password-input" class="col-2 col-form-label"></label>
                    <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                        <div class="image-input-wrapper"
                        {{ $stud[0]->profile}}
                        </div>  
                    </div>
                </div>
  <div class="card card-custom">

        <!--begin::Form-->
        <form method="POST" enctype="multipart/form-data" action="{{ route('generateReport')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <strong class="col-2 col-form-label">First Name</strong>
                    <div class="col-10">
                    <strong>   {{$stud[0]->first_name." ". $stud[0]->middle_name." ".$stud[0]->last_name}}</strong>
                    </div>
                </div>
                <div class="form-group row">
                    <strong class="col-2 col-form-label">Date of Birth</strong>
                    <div class="col-9 col-form-label">
                  <strong>  {{$stud[0]->dob}}</strong>
                    </div>
                </div>
                <div class="form-group row">
                    <strong for="example-email-input" class="col-2 col-form-label">College</strong>
                    <div class="col-10">
                     <strong>   {{$stud[0]->program->department->faculty->college->name}}</strong>
                    </div>
                </div>
                <div class="form-group row">
                    <strong for="example-tel-input" class="col-2 col-form-label">Faculty</strong>
                    <div class="col-10">
                     <strong>  {{$stud[0]->program->department->faculty->name}}</strong>
                    </div>
                </div>
                <div class="form-group row">
                    <strong for="example-password-input" class="col-2 col-form-label">Department</strong>
                    <div class="col-10">
                        {{$stud[0]->program->department->name}}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="example-password-input" class="col-2 col-form-label">Program</label>
                    <div class="col-10">
                     <strong>   {{$stud[0]->program->name}}</strong>
                    </div>
            </div>
                <div class="form-group row">
                    <strong for="example-password-input" class="col-2 col-form-label">Batch</strong>
                    <div class="col-10">
                     <strong>   {{$stud[0]->join_year}}</strong>
                    </div>
                    </div>
                <div class="form-group row">
                    <strong for="example-password-input" class="col-2 col-form-label">Secondary School</strong>
                    <div class="col-10">
                    <strong>  Jimma Secondery School</strong>
                    </div>
                    <div class="form-group row">
                    <label class="col-3 col-form-label">Payment Method</label>
                    <div class="col-9 col-form-label">
                        <div class="radio-inline">
                            <label class="radio">
                                <input type="radio" />
                                <span></span>
                                Give Service
                            </label>
                            <label class="radio">
                              
                                <span></span>
                                from salary
                            </label>
                        </div>
                    </div>
                </div>
                    </div>
               
            
            </div>
           
        </form>
    </div>
    </div>
</body>
  <br>
</html>

        @endforeach

      
<style>
    .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 100px;
  height:100px;
}
</style>
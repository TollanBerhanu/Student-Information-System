
{{-- Extends layout --}}
@extends('layout.empty')

{{-- Content --}}
@section('content')


<div class="row">
<div class="col-lg-12 margin-6">
<div class="content-header">
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

    <div class="card">
              <div class="card-header">
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
  
        <form class="form-inline my-2 my-lg-0" method="get" action="{{url('/gate/student/permitedStudent')}}">
          <input type="search" style="margin-left: 20%!important" class="form-control mr-sm-2" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type=submit> Search</button>
          <a href="{{url('/')}}" style="float:right!important"><h1>Back</h1></a>  
        </form>
             </div>
        <h1 style="color:red; margin-left: 20%; !important">Invalid Id/ Your are not Student, Try Another Gate</h1>
        <div class="card-body">
            
             <table id="example1" class="table table-bordered table-striped">
               <tbody>
               <tr>
             <td><img src="{{asset ('uploads/profile/wrongicon.jpg')}}" width="400px" height="500px" alt=""></td>
             <td>
               <img src="{{asset ('uploads/students/' )}}" width="520px" height="500px" alt=""></a> 
             </td>
             <td><img src="{{asset ('uploads/profile/wrongicon.jpg')}}" width="400px" height="500px" alt=""></td>
                <td>
                </tr>   
                <td>    
             </form>
              </td>
               </tbody>
             </table>
           </div>
@endsection()


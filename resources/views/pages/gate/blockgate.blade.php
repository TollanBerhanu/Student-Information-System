
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
          <input type="search" class="form-control mr-sm-2"  style="margin-left: 20%!important" name="query" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type=submit> Search</button>
            </form>
               
              </div>
              
  
    <div class="card-body">
    
             <table id="example1" class="table table-bordered table-striped">
           
               <tbody>
               
               @foreach($block_gate as $a)
              
               <tr>
             <h1 style="color:red;margin-left: 20%!important">Alert : {{$a->alert}}</h1>
             <td><img src="{{asset ('uploads/profile/wrongicon.jpg')}}"  width="400px" height="520px" alt=""></td>
             <td>
             <a class="btn btn-info" href="">
               <img src="{{asset ('uploads/profile/')}}" width="600px" height="520px" alt=""></a> 
              
             </td>
             <td><img src="{{asset ('uploads/profile/wrongicon.jpg')}}" width="400px" height="520px" alt=""></td>
                <td>
                <form action="" method="POST">   
                
                </tr>
                 @csrf
                 @method('DELETE')      
<td>    

             </form>
</td>
            
           
         @endforeach
               </tbody>
            
             </table>
           </div>
          </div>
           </div>
         </div>

 @endsection 

